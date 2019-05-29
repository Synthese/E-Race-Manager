<?php 

if(!defined("CONFIG")) 
	exit();

require_once("results_functions.php");

define("SHOW_POINTS", 0);
define("SHOW_INCREMENTAL", 1);
define("SHOW_POSITIONS", 2);

$season = $_GET['season'];
$show = isset($_GET['show']) ? $_GET['show'] : 0;
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

// Get season information
$query = "SELECT s.*, d.name dname, COUNT(r.id) racecount
					FROM season s
					JOIN division d ON (s.division = d.id)
					LEFT JOIN race r ON (r.season = s.id)
					WHERE s.id=$season GROUP BY s.id";

$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL Error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("Season does not exist\n");
	return;
}

$item = mysqli_fetch_array($result);

// Get the rulesets
$rsquery = "SELECT * FROM point_ruleset";
$rsresult = mysqli_query($link,$rsquery);
if(!$rsresult) {
	show_error("MySQL Error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($rsresult) == 0) {
	show_error("Ruleset does not exist\n");
	return;
}
while($rsitem = mysqli_fetch_array($rsresult)) {
    
	$ruleset[$rsitem['id']] = $rsitem;
    $ruleset[$rsitem['name']] = $rsitem;
    }

// Get all teams and driver for this season
$drquery = "SELECT d.id did, d.name dname, d.country dcountry, t.id tid, t.name tname, c.*
	    	FROM season_team st
            JOIN team t ON (st.team = t.id)
            JOIN team_driver td ON (td.team = t.id)
            JOIN driver d ON (d.id = td.driver)
            LEFT JOIN race_driver rd ON (rd.team_driver = td.id)
	          LEFT JOIN cars c ON (c.code = rd.cartype)
            WHERE st.season = $season
            ORDER BY t.name ASC, d.name ASC";

$drresult = mysqli_query($link,$drquery);
if(!$drresult) {
	show_error(mysqli_error($link) . "MySQL Error: " . "\n");
	return;
}

$team = array();
$driver = array();
while($dritem = mysqli_fetch_array($drresult)) {
	if(!isset($team[$dritem['tid']])) {
		$team[$dritem['tid']]['name'] = $dritem['tname'];
		$team[$dritem['tid']]['points'] = 0;
		$team[$dritem['tid']]['pointsrace'] = array();
		$team[$dritem['tid']]['pointsraceinc'] = array();
		$team[$dritem['tid']]['provisionals'] = array();
	}
	$driver[$dritem['did']]['name'] = $dritem['dname'];
	$driver[$dritem['did']]['team'] = $dritem['tname'];
	$driver[$dritem['did']]['dcountry'] = $dritem['dcountry'];
	$driver[$dritem['did']]['points'] = 0;
	$driver[$dritem['did']]['pointsrace'] = array();
	$driver[$dritem['did']]['pointsraceinc'] = array();
	$driver[$dritem['did']]['provisionals'] = array();
}

$rquery = "SELECT r.id race, r.name rname, r.track rtrack, r.ruleset, r.ruleset_qualifying, 
td.driver, td.team, rd.fastest_lap, rd.grid, rd.status
				FROM race r
				JOIN race_driver rd ON (rd.race = r.id)
				JOIN team_driver td ON (td.id = rd.team_driver)
				WHERE r.season=$season AND r.progress = 2 AND (rd.status = 0 OR rd.status = 1)
				ORDER BY r.date ASC, rd.position ASC";

$rresult = mysqli_query($link,$rquery);
if(!$rresult) {
	show_error("MySQL Error: " . mysqli_error($link) . "\n");
	return;
}

$show_qualifypoint = ($ruleset_qualifying != 0);

$last_race = 0;
$race = 0;
$races = array();
/* Creates an array of all drivers and team, and their race information (points, positions) */
while($ritem = mysqli_fetch_array($rresult)) {
	if($last_race != $ritem['race']) {
		$position = 0;
		$race++;
		$races[$race]['id'] = $ritem['race'];
		$races[$race]['name'] = $ritem['rname'];
		$races[$race]['track'] = $ritem['rtrack'];
		$last_race = $ritem['race'];
	}

	if($ritem['status'] == 0) { // if status = OK (IE not DNF)
		// Assign points and position to driver for the race
		$position++;
		$driver[$ritem['driver']]['points'] += points_total($position, $ritem['grid'], 
		$ritem['fastest_lap'], $ruleset[$ritem['ruleset']]);
		$driver[$ritem['driver']]['pointsrace'][$race] = points_total($position, $ritem['grid'], 
		$ritem['fastest_lap'], $ruleset[$ritem['ruleset']]);
		$driver[$ritem['driver']]['position'][$race] = $position;

		// Assign points for the team
		$team[$ritem['team']]['points'] += $driver[$ritem['driver']]['pointsrace'][$race];
		$team[$ritem['team']]['pointsrace'][$race] += $driver[$ritem['driver']]['pointsrace'][$race];
		$team[$ritem['team']]['pointsraceinc'][$race] = $team[$ritem['team']]['points'];
	}

	if($ritem['ruleset_qualifying'] != 0) {
		// Qualifying points if set
		$show_qualifypoint = true;
		$driver[$ritem['driver']]['pointsqualifying'] += points_race($ritem['grid'], 
		$ruleset[$ritem['ruleset_qualifying']]);
		$driver[$ritem['driver']]['pointsqualifyingrace'][$race] = points_race($ritem['grid'], 
		$ruleset[$ritem['ruleset_qualifying']]);
		$driver[$ritem['driver']]['pointsqualifyingraceinc'][$race] = 
		$driver[$ritem['driver']]['pointsqualifying'];
	}

}
// calculate provisionals (hardcoded to the two lowest results) in 
// case of more than two races completed
if (count($races) > 2) {

	foreach($driver as $id => $ditem) {

		// array for races in which the driver started
		$points = $ditem['pointsrace'];
		// array for all races including DNS
		$tempPoints = array();

		for($x = 1; $x <= $race; $x++) {
			if (empty($ditem['pointsrace'][$x])) {
				// driver did not take part in the race
				$tempPoints[$x] = 0;
			} else {
				// driver did take part, copy points
				$tempPoints[$x] = $points[$x];
			}
		}

		// sort points in descending order
		arsort($tempPoints);
		// get last element in Array
		$last = end($tempPoints);
		// get key of last element
		$lastKey = key($tempPoints);
		// get last second element in Array
		$secondlast = prev($tempPoints);
		// get key of second last element
		$secondlastKey = key($tempPoints);
		// keep the keys and values for the results that were removed, need to mark 
		// those in the results table
		$provisionals = array(
			$lastKey => $last,
			$secondlastKey => $secondlast
		);
		// add it to driver
		$ditem['provisionals'] = $provisionals;
		// set lowest two results to zero
		$ditem['pointsrace'][$lastKey] = 0;
		$ditem['pointsrace'][$secondlastKey] = 0;
		// recalculate points total
		$ditem['points'] = $ditem['points'] - $last - $secondlast;
		// update information on drivers array
		$driver[$id]= $ditem;
	}

	// recalculate team points taking provisionals into account
	// go through all the teams
	foreach($team as $id => $titem) {

		// collect provisionals of each team
		$teamProvisionalPoints = 0;
		// go through all the drivers
		foreach($driver as $did => $ditem) {

			// collect provisionals of each team driver
			$driverProvisionalPoints = 0;
			// get all drivers of a team
			if ($ditem['team']==$titem['name']) {
				// go through all races
				for($x = 1; $x <= $race; $x++) {
					// assign provisional points for the team
					if (array_key_exists($x, $ditem['provisionals'])) {

						// get provisional points of this driver
						$driverProvisionalPoints = $ditem['provisionals'][$x];
						// add those to the provisional points of the team
						$teamProvisionalPoints += $driverProvisionalPoints;
						// take other team driver into account
						if (array_key_exists($x, $titem)) {

							$titem['provisionals'][$x] = $titem['provisionals'][$x] + $driverProvisionalPoints;

						} else {

							$titem['provisionals'][$x] = $driverProvisionalPoints;

						}
					}
				}
			}
		}
		// Assign total points for the team
		$titem['points'] = $titem['points'] - $teamProvisionalPoints;
		$team[$id]= $titem;
	}
}

// sort drivers and teams by points
usort($driver, "point_sort");
usort($team, "point_sort");
?>
<div>&nbsp;</div>
<div class="container-fluid">
	<div class="card">
		<div class="card-header"><b>Season Ergebnisse</b></div>
		<div class="responsive">
			<table class="table table-striped">
				<tr>
					<td width="20%">Name:</td>
					<td width="30%"><?php echo $item['name']?></td>
					<td width="20%">Rennen:</td>
					<td width="30%"><?php echo $item['racecount']?></td>
				</tr>
				<tr>
					<td width="20%">Division:</td>
					<td width="30%"><?php echo $item['dname']?></td>
					<td width="20%">Punktesatz:</td>
					<td width="30%"><?php echo $ruleset['name'];?>
					<?php if(isset($ruleset_qualifying)) echo " (qual: " . $ruleset_qualifying['name'] . ")" ?>
	</td>
				</tr>
				<tr class="bg-warning text-white">
					<td colspan="4" class="text-center"><a
						href="?page=result_season&amp;season=<?php echo $season?>&amp;show=
		<?php echo SHOW_POINTS?>">Punkte pro Rennen</a> | <a
						href="?page=result_season&amp;season=<?php echo $season?>&amp;show=
		<?php echo SHOW_INCREMENTAL?>">Punkte aufsteigend</a> | <a
						href="?page=result_season&amp;season=<?php echo $season?>&amp;show=
		<?php echo SHOW_POSITIONS?>">Positionen</a></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="card">
		<div class="card-header"><b>Fahrer</b>
			<p>&nbsp;(Rote Ergebnisse sind Provisorien, 2 sind angegeben)</p>
		</div>
		<div class="responsive">
			<table class="table table-striped text-center">
				<tr>
					<td style="vertical-align: bottom" align="center">Pos</td>
					<td style="vertical-align: bottom" align="center">Fahrer</td>
					<td style="vertical-align: bottom; text-align: center"
						align="center">Auto</td>
					<td style="vertical-align: bottom; text-align: center"
						align="center">Nr.</td>
					<td style="vertical-align: bottom; text-align: center"
						align="center">Land.</td>
					<td style="vertical-align: bottom" align="center">Team</td>
<?php for($x = 1; $x <= $race; $x++) { ?>
	<td width="1" align="center"><void (0)" class="tablink"
							title="Click to more details">
						<div class="w3-topbar w3-bottombar w3-hover-border-green">
							<a
								href="blanc.php?page=result_race&amp;race=<?php echo $races[$x]['id']?>">
					<img src="img_season_race.php?text=<?php echo urlencode($races[$x]['name'])?>
					&amp;text2=<?php echo urlencode($races[$x]['track'])?>" alt="<?php echo $x?>"></a>
  </td>
<?php } ?>
	<td style="width:50px;vertical-align:bottom;background-color:transparent;
	               text-align:right;">Punkte
	</td>
</tr>
<?php

$pos = 0;
$platestyle = "style=\"background-color:rgba(5, 5, 5, 0.8);width: 2.3em;border-radius:5px;
color:white;background-clip:content-box;vertical-align:middle;font-family: 'arial', Fallback,
 sans-serif;text-align:center;padding:1px;\"";
foreach($driver as $id => $ditem) {
  $dname = $ditem['name'];
    $badgequery = "SELECT s.id season_id, rd.race race_id, d.name dname, rd.dplate dplate, 
td.id td_id, td.team team, c.id carid, rd.cartype, c.badge badge, rd.ballast, rd.restrictor
                      FROM race_driver rd
                      JOIN cars c on (c.code = rd.cartype)
                      JOIN team_driver td on (td.id = rd.team_driver)
                      JOIN driver d on (d.id = td.driver)
                      JOIN race r on (r.id = rd.race)
                      JOIN season s on (r.season = s.id)
                      WHERE s.id = '$season' AND d.name = '$dname'
                      ORDER BY rd.race DESC, '$dname' ASC";
    $badge = mysqli_fetch_assoc(mysqli_query($link, $badgequery))['badge'];
		$dplate = mysqli_fetch_assoc(mysqli_query($link, $badgequery))['dplate'];
   ?>
<tr style="vertical-align:center";>
	<td><?php echo ++$pos?>&nbsp;</td> 
	<td><?php echo $ditem['name']?></td>
  <td style="text-align:center"><img src="images/badges/<?php echo $badge?>"</td>
	<td <?php echo $platestyle?>><?php echo $dplate ?></td>
  <td style="text-align:center"><img src="images/flags/<?php echo $ditem['dcountry']?>.png"></td>

    <td align="center"><?=$ditem['team']?></td>
<?php
$total = 0;
for($x = 1; $x <= $race; $x++) {
	switch($show) {
	case SHOW_POINTS:
		$data = !empty($ditem['pointsrace'][$x]) ? $ditem['pointsrace'][$x] : "-";
		$provisionals = $ditem['provisionals'];
		if (array_key_exists($x, $provisionals)) {
			// mark provisional in reddish color
			 $color = "style=\"background-color:rgba(255, 99, 71, 0.5); border-radius:5px;
			 					 color:white; background-clip: content-box; text-align:center; padding:1px\"";
			 // show original points but do not take them into account
			 $data = $provisionals[$x];
		} else {
			// do not mark valuable results in a different color
			$color = "style=\"background-color:transparent; padding:1px; text-align: center; color:black\"";
		}
		break;
	case SHOW_INCREMENTAL:
		$provisionals = $ditem['provisionals'];
		if (array_key_exists($x, $provisionals)) {
			// mark provisional in reddish color
			$color = "style=\"background-color:rgba(255, 99, 71, 0.5); border-radius:5px;
								color:white; background-clip: content-box; text-align:center; padding:1px\"";
			 // show original points but do not take them into account
			 $data = $provisionals[$x];
		} else {
			// do not mark valuable results in a different color
			$color = "style=\"background-color:transparent; padding: 1px; text-align: center; color:black\"";
			// take points into account
			$total += $ditem['pointsrace'][$x];
			$data = $total;
		}
		break;
	case SHOW_POSITIONS:
		$data = !empty($ditem['position'][$x]) ? $ditem['position'][$x] : "-";
		$provisionals = $ditem['provisionals'];
		if (array_key_exists($x, $provisionals)) {
			// mark provisional in reddish color
			$color = "style=\"background-color:rgba(255, 99, 71, 0.5); border-radius:5px;
								color:white; background-clip: content-box; text-align:center; padding:1px\"";
		} else {
			// do not mark valuable results in a different color
			$color = "style=\"background-color:transparent; padding: 1px; text-align: center; color:black\"";
		}
		break;
	}
	?>
	<td width="1" <?php echo $color?>><?php echo $data?></td>
<?php } ?>
	<td style="background-color:transparent; text-align: right; color:black; font-weight: bold;">
	<?php echo !empty($ditem['points']) ? $ditem['points'] : "0" ?>
</td>
</tr>
<?php

} ?>
</table>
</div>
</div>
</div>

<div class="container-fluid">
<div class="card">
<div class="card-header"><b>Teams</b>
<p>&nbsp;(Rote Ergebnisse mit Provisorien der Teamfahrer)</p>
</div>
<div class="responsive">
<table class="table table-striped table-hover">
<tr>
	<td style="vertical-align:bottom">Pos</td>
	<td style="vertical-align:bottom">Team</td>
<?php for($x = 1; $x <= $race; $x++) { ?>
	<td width="1" align="right"><void(0)" class="tablink" title="Click to more details">
	  <div class="w3-topbar w3-bottombar w3-hover-border-blue">
	  <a href="?page=result_race&amp;race=<?php echo $races[$x]['id']?>">
	  <img src="img_season_race.php?text=<?php echo urlencode($races[$x]['name'])?>&amp;
	  text2=<?php echo urlencode($races[$x]['track'])?>" alt="<?php echo $x?>"></a>
	</td>
<?php } ?>
	<td style="width:50px;vertical-align:bottom;background-color:transparent;
	       text-align:right;">Punkte
	</td>
</tr>
<?php

$pos = 0;
foreach($team as $id => $titem) {
?>

<tr>
	<td width="1" align="right"><?php echo ++$pos?>&nbsp;</td>
	<td><?php echo $titem['name']?></td>
<?php
$total = 0;
for($x = 1; $x <= $race; $x++) {
	switch($show) {
	case SHOW_POINTS:
	case SHOW_POSITIONS:
		// show dash when DNS
		$data = !empty($titem['pointsrace'][$x]) ? $titem['pointsrace'][$x] : "-";
		// mark provisional results
		$provisionals = $titem['provisionals'];
		if (array_key_exists($x, $provisionals)) {
			// mark provisional in reddish color
			$color = "style=\"background-color:rgba(255, 99, 71, 0.5); border-radius:5px;
								color:white; background-clip: content-box; text-align:center; padding:1px\"";
		} else {
			// do not mark valuable results in a different color
			$color = "style=\"background-color:transparent; padding: 1px; text-align: center; color:black\"";
		}
		break;
	case SHOW_INCREMENTAL:
		$provisionals = $titem['provisionals'];
		if (array_key_exists($x, $provisionals)) {
			// mark provisional in reddish color
			$color = "style=\"background-color:rgba(255, 99, 71, 0.5); border-radius:5px;
								color:white; background-clip: content-box; text-align:center; padding:1px\"";
			 // show original points but do not take them into account
			 $data = !empty($titem['pointsrace'][$x]) ? $titem['pointsrace'][$x] : "-";
			 //$data = $titem['pointsrace'][$x];
		} else {
			// do not mark valuable results in a different color
			$color = "style=\"background-color:transparent; padding: 1px; text-align: center; color:black\"";
			// take points into account
			$total += $titem['pointsrace'][$x];
			$data = $total;
		}
		break;
	}
	?>
	<td width="1" <?php echo $color?>><?php echo $data?></td>
<?php } ?>
	<td style="background-color:transparent; text-align: right; color:black; font-weight: bold;">
					<?php echo !empty($titem['points']) ? $titem['points'] : "0" ?>
	</td>
</tr>
<?php

} ?>
</table>
</div>
</div>
</div>
<?php if($show_qualifypoint) {
	usort($driver, 'point_sort_qual');
	?>
	
<div class="container-fluid">
<div class="card">
<div class="card-header"><b>Fahrer Qualifying</b></div>
<div class="responsive">
<table class="table table-striped table-hover text-center">
<tr>
	<td style="vertical-align:bottom" align="center">Pos</td>
	<td style="vertical-align:bottom" align="center">Fahrer</td>
	<td style="vertical-align:bottom" align="center">Team</td>
<?php for($x = 1; $x <= $race; $x++) { ?>
	<td width="1" align="right"><javascript:void(0)" class="tablink" title="Click to more details">
	<div class="w3-topbar w3-bottombar w3-hover-border-blue">
	<a href="?page=result_race&amp;race=<?php echo $races[$x]['id']?>">
	<img src="img_season_race.php?text=<?php echo urlencode($races[$x]['name'])?>&amp;text2=<?php 
	echo urlencode($races[$x]['track'])?>" alt="<?php echo $x?>"></a>
	</td>
<?php } ?>
	<td style="vertical-align:bottom" align="center" width="1" align="right">Punkte</td>
</tr>
<?php

$pos = 0;
foreach($driver as $id => $ditem) {
?>

<tr>
	<td width="1" align="right"><?php echo ++$pos?>&nbsp;</td>
	<td><?php echo $ditem['name']?></td>
	<td><?php echo $ditem['team']?></td>
<?php for($x = 1; $x <= $race; $x++) { ?>
	<td style="background-color:transparent; text-align: right; color:black;">
	<?php echo !empty($ditem['pointsqualifyingrace'][$x]) ? $ditem['pointsqualifyingrace'][$x] : "-"?>
	</td>
<?php } ?>
	<td style="background-color:transparent; text-align: right; color:black; font-weight: bold;">
	<?php echo !empty($ditem['pointsqualifying']) ? $ditem['pointsqualifying'] : "0" ?>
	</td>
</tr>



<?php

} ?>
</table>
</div>
</div>
</div>
<?php } ?>
<br>