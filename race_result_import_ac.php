<?php 
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; } 

function searcharray($value, $key, $array) {
   foreach ($array as $k => $val) {
       if ($val[$key] == $value) {
           return $k;
       }
   }
   return null;
}

if(isset($_GET['id']))
	$id = addslashes($_GET['id']);
elseif(isset($_POST['id']))
	$id = addslashes($_POST['id']);

if(isset($_POST['json'])) {
	$upload = false;
	switch($_FILES['racefile']['error']) {
	case UPLOAD_ERR_OK:
		$upload = true;
		break;
	case UPLOAD_ERR_NO_FILE:
		$error .= "No file selected for uploading\n";
		break;
	case UPLOAD_ERR_INI_SIZE:
		$error .= "JSON file too big\n";
		break;
	case UPLOAD_ERR_PARTIAL:
		$error .= "Upload of the JSON file was not completed\n";
		break;
	case UPLOAD_NO_TMP_DIR:
		$error .= "Server error: missing tmp-directory\n";
		break;
	case UPLOAD_ERR_CANT_WRITE:
		$error .= "Server error: cannot write file\n";
		break;
	}

	if($upload) {
		$driver = array();
		$elem = null;

		# Parser functions
		function startElement($parser, $name, $attrs) {
			global $driver;
			global $elem;

			if($name == "DRIVER") $driver[] = array();
			$elem = $name;
		}

		function endElement($parser, $name) {
			global $elem;
			$elem = null;
		}

		function textData($parser, $text) {
			global $driver;
			global $elem;

			if(count($driver) == 0)
				return;
			$elems = array("NAME", "TEAMNAME", "GRIDPOS", "POSITION", "BESTLAPTIME", "FINISHTIME", "LAPS");

			if(in_array($elem, $elems)) {
				$driver[count($driver) - 1][strtolower($elem)] = $text;
			}
		}
		# Get the Qualy JSON file
		$qualyfile = file_get_contents($_FILES['qualyfile']['tmp_name']);
		$qualyjson = json_decode($qualyfile, true);

		foreach($qualyjson["Result"] as $key => $row) {
			$gridpos[$key] = $key + 1;
			$arr_qualy_result[] = array(
				'DriverId' => $row['CarId'],
				'BestLap' => $row['BestLap'],
				'GridPos' => $key + 1
			  );
					}

		# Parse the Race JSON file
		$racefile = file_get_contents($_FILES['racefile']['tmp_name']);
		$racejson = json_decode($racefile, true);
		$bestlap = false;

		foreach($racejson["Cars"] as $key => $row) {
			$arr_race_cars[$row['CarId']] = array(
				'DriverName' => $row['Driver']['Name'],
				'DriverTeam' => $row['Driver']['Team'],
				'DriverModel' => $row['Model'],
				'DriverBallastKG' => $row['BallastKG'],
				'DriverRestrictor' => $row['Restrictor']
			);
		}

		foreach($racejson["Result"] as $key => $row) {
			$position[$key] = $key + 1;
			$arr_race_result[] = array(
				'DriverId' => $row['CarId'],
				'BestLap' => $row['BestLap'],
				'TotalTime' => $row['TotalTime'],
				'Position' => $key + 1
			);

			if ($row['BestLap'] < $bestlap || !$bestlap) {
				$bestlap = $row['BestLap'];
				$bestlap_driver = $row['CarId'];
			}

		}

		foreach($racejson["Laps"] as $key => $row) {
			$arr_race_laps[$row['CarId']][] = array(
				'Timestamp' => $row['Timestamp'],
				'LapTime' => $row['LapTime'],
				'Sectors' => $row['Sectors']
			);
		}
	}
}
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT r.*, d.name dname, rs.name rsname, s.name sname
					FROM race r
					JOIN division d ON (d.id = r.division)
					JOIN point_ruleset rs ON (rs.id = r.ruleset)
					JOIN season s ON (s.id = r.season)
					WHERE r.id='$id' ORDER BY r.date DESC";

$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Race does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

$date = strtotime($item['date']);

?>
<h1>Import Assetto Corsa JSON</h1>
<h3> Attention: You have to save all drivers to the DB, even those which didn´t start the race!</h3>
<table border="0" width="100%">
<tr>
	<td width="120">Name:</td>
	<td><?php echo $item['name']?></td>
	<td>Laps:</td>
	<td><?php echo $item['laps']?></td>
</tr>
<tr>
	<td>Track:</td>
	<td><?php echo $item['track']?></td>
	<?php if($item['season'] == 0) { ?>
	<td>Division/Ruleset:</td>
	<td><?php echo $item['dname']?> / <?php echo $item['rsname']?></td>
	<?php } else { ?>
	<td>Season / Division:</td>
	<td><?php echo $item['sname']?> / <?php echo $item['dname']?></td>
	<?php } ?>
</tr>
<tr>
	<td>Date/Time:</td>
	<td>
		<?php echo date("j F Y, H:i", $date)?>
	</td>
	<td>Max players:</td>
	<td><?php echo $item['maxplayers']?></td>
</tr>
</table>
<?php if(!$upload) { ?>
<br/>
<form action=".?page=race_result_import_ac" method="post" enctype="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="2">
<tr>
	<td>QUALIFY JSON file:</td>
	<td><input type="file" name="qualyfile"/></td>
</tr>
<tr>
	<td>RACE JSON file:</td>
	<td><input type="file" name="racefile"/></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="button submit" value="Upload"/>
		<input type="hidden" name="id" value="<?php echo $id?>"/>
		<input type="hidden" name="json" value="1"/>
	</td>
</tr>
</table>
</form>
<?php } else { ?>
<?php require_once("results_functions.php"); ?>
<?php
if($item['season'] == 0)
	$dquery = "SELECT td.id, t.name team, d.name driver, d.plate dplate
						 FROM team_driver td
						 JOIN team t ON (t.id = td.team)
						 JOIN driver d ON (d.id = td.driver)";
else
	$dquery = "SELECT td.id, t.name team, d.name driver, d.plate dplate
						 FROM season_team st
						 JOIN team t ON (t.id = st.team)
						 JOIN team_driver td ON (td.team = t.id)
						 JOIN driver d ON (d.id = td.driver)
						 WHERE st.season='{$item['season']}'";

$dresult = mysqli_query($link,$dquery);
if(!$dresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($dresult) == 0){
	show_error("No drivers exist in teams or no teams are in this season\n");
	return;
}

$drivers = array();
while($ditem = mysqli_fetch_array($dresult)) {
	$drivers[$ditem['id']]['name'] = $ditem['driver'];
	$drivers[$ditem['id']]['team'] = $ditem['team'];
}

function show_driver_combo($dname = '') {
	global $drivers;

	$dname = strtolower($dname);
	echo "<select name=\"driver[]\">\n";
	echo "<option value=\"\">&nbsp;</option>\n";
	foreach($drivers as $id => $driver) {
		$comp_dname = strtolower($driver['name']);
		echo "<option value=\"$id\"";
		if($comp_dname == $dname) echo " selected";
		echo ">" . $driver['name'] . " (" . $driver['team'] . ")";
		echo "</option>\n";
	}
	echo "</select>\n";
}

?>

<form action="race_results_chg_do.php" method="post">
		<table class="w3-table-all">
		<tr class="w3-dark-grey">
			<td>Driver (Team)</td>
			<td align="center">Car #</td>
			<td align="center">Car Type</td>
			<td align="center">Ballast</td>
			<td align="center">Restrictor</td>
			<td align="center">Grid</td>
			<td align="center">Pos</td>
			<td align="center">Laps</td>
			<td>Time</td>
			<td align="center"><span class="abbr" title="Fastest Lap">FL</span></td>
			<td align="center">Status</td>
		</tr>
		<?php $style = "odd"; ?>
		<?php for($x = 0; $x < $item['maxplayers']; $x++) {
			if($x < count($arr_race_result)) {
				$did = $arr_race_result[$x]['DriverId'];
				$ditem = $arr_race_cars[$did];
				$drivername = $ditem['DriverName'] . " (" . $ditem['DriverTeam'] . ")";
				$driver_name = $ditem['DriverName'];
				$driver_cartype = $ditem['DriverModel'];
				$driver_ballast = $ditem['DriverBallastKG'];
				$driver_restrictor = $ditem['DriverRestrictor'];
				$dplatequery = "SELECT plate FROM driver where name = '$driver_name'";
				$dplate = mysqli_fetch_assoc(mysqli_query($link,$dplatequery))['plate'];
        if (isset($arr_qualy_result))
          {
            $grid = array_search($did, array_column($arr_qualy_result,'DriverId'));
            $grid = $grid +1;
          }
          else
            {
              $grid = "";
            }
				$position = $arr_race_result[$x]['Position'];
				if($position == 0) $position = "";
				if (isset($arr_race_laps[$did])) $laps = count($arr_race_laps[$did]); else $laps = 0;
				if($laps == 0) $laps = "";
				$time = $arr_race_result[$x]['TotalTime'] * 10;
				$fl = $arr_race_result[$x]['BestLap'];
				$status = 0;

				$hour = floor($time / 36000000);
				$time = $time % 36000000;
				$minute = floor($time / 600000);
				$time = $time % 600000;
				$second = floor($time / 10000);
				$ms = round(($time % 10000) / 10);

				if ($time == 0)
					$status = 3;

			} else {
				$drivername = "";
				$ditem['DriverName'] = "";
				$dplate = "";
				$grid = "";
				$position = "";
				$laps = "";
				$hour = "";
				$minute = "";
				$second = "";
				$ms = "";
				$fl = 0;
				$status = 3;
			}
			?>


			<tr class="w3-hover-green" style="vertical-align: middle;">
				<td><?php echo $drivername . (!empty($drivername) ? "<br/>" : "")?><?php show_driver_combo($ditem['DriverName']); ?></td>
				<td align="center"><input type="text" name="dplate[]" value="<?php echo $dplate?>" size="2" maxlength="3"></td>
				<td align="center"><input type="text" name="cartype[]" value="<?php echo $driver_cartype?>" size="20" maxlength="50"></td>
				<td align="center"><input type="number" name="ballast[]" style="width: 4em" value="<?php echo $driver_ballast?>" min="0" max="200" step="5"></td>
				<td align="center"><input type="number" name="restrictor[]" style="width: 4em" value="<?php echo $driver_restrictor?>" min="0" max="100" step="5"></td>
				<td align="center"><input type="text" name="grid[]" value="<?php echo $grid?>" size="1" maxlength="2"></td>
				<td align="center"><input type="text" name="pos[]" value="<?php echo $position?>" size="1" maxlength="2"></td>
				<td align="center"><input type="text" name="laps[]" value="<?php echo $laps?>" size="1" maxlength="3"></td>
				<td>
					<input type="text" name="hour[]" value="<?php echo $hour?>" style="text-align:right;" size="1" maxlength="2">h
					<input type="text" name="minute[]" value="<?php echo $minute?>" style="text-align:right;" size="1" maxlength="2">m
					<input type="text" name="second[]" value="<?php echo $second?>" style="text-align:right;" size="1" maxlength="2">s
					<input type="text" name="ms[]" value="<?php echo $ms?>" size="2" maxlength="3">
				</td>
				<td align="center"><input type="checkbox" name="fl[<?php echo $x?>]"<?php echo $bestlap_driver==$did?" checked":""?>></td>
				<td align="center">
					<select name="status[]">
						<?php foreach($race_status_s as $i => $s) { ?>
						<option value="<?php echo $i?>"<?php echo $i == $status ? " selected" : ""?>><?php echo $s?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		<?php	$style = $style == "odd" ? "even" : "odd"; ?>
		<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td colspan="6">
					<input type="hidden" name="id" value="<?php echo $id?>">
					<input type="hidden" name="season" value="<?php echo $item['season']?>">
					<input type="submit" class="button submit" value="Save results"/>
					<input type="button" class="button cancel" value="Cancel" onclick="history.go(-1);"/>
				</td>
			</tr>
		</table>
</form>
<?php } ?>
