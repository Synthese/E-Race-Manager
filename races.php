<?php 
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return;
} 

if(isset($_GET['season'])) $season = $_GET['season'];
else $season = 0;

$query_where = "WHERE r.season='$season'";
if(isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	$query_where .= " AND (r.name LIKE '%$filter%' OR r.track LIKE '%$filter%')";
}
$query = "SELECT r.*, d.name dname, rs.name rsname, qrs.name qrsname, COUNT(rd.team_driver) drivers FROM race r JOIN division d ON (d.id = r.division) JOIN point_ruleset rs ON (rs.id = r.ruleset) LEFT JOIN point_ruleset qrs ON (qrs.id = r.ruleset_qualifying) LEFT JOIN race_driver rd ON (r.id = rd.race) $query_where GROUP BY r.id ORDER BY r.date DESC";
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

$squery = "SELECT s.*, d.name dname, COUNT(r.id) racecount FROM season s JOIN division d ON (d.id = s.division) LEFT JOIN race r ON (r.season = s.id) GROUP BY s.id ORDER BY name ASC, dname ASC";
$sresult = mysqli_query($link,$squery);
if(!$sresult) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

$s2query = "SELECT COUNT(id) racecount FROM race WHERE season = 0";
$s2result = mysqli_query($link,$s2query);
if(!$s2result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

$s2item = mysqli_fetch_array($s2result);
$noseasonracecount = $s2item['racecount'];
?>
<div>&nbsp;</div>
<div class="container">
	<div class="card">
		<div class="card-header"><b>Rennen</b></div>
				<div><a class="btn btn-success" href="?page=race_add&amp;season=
                    <?php echo $season?>">Neues Rennen anlegen</a></div>	
<?php if($season == "0") { ?>

<table class="table table-striped">
<tr class="bg-info text-white">
	<td>Season</td>
	<td>Division</td>
	<td>Rennen</td>
</tr>
<?php
mysqli_data_seek($sresult, 0);

while($sitem = mysqli_fetch_array($sresult)) {
	?>
<tr>
	<td><a href="?page=races&amp;season=<?php echo $sitem['id']?>"><?php echo $sitem['name']?></a></td>
	<td><?php echo $sitem['dname']?></td>
	<td><?php echo $sitem['racecount']?></td>
</tr>

<?php
} ?>
</table>
</div>
<div>&nbsp;</div>
<div class="card">
 <div class="card-header"><b>Events</b></div>

<?php } ?>
<?php 
if(mysqli_num_rows($result) == 0) {
	show_msg("No races found\n");
	//return;
}

?>


<table class="table">
<tr class="bg-info text-white">
	<td>Bearbeiten</td>
	<td>Datum</td>
	<?php if ($season == 0) { ?>
	<td>Name<br>Strecke</td>
	<td>Division<br>Punktesatz</td>
	<td align="center">Fahrer</td>
	<td align="center">Runden</td>
	<td align="center">MaxFahrer</td>
	<?php } else { ?>
	<td>Name</td>
	<td>Strecke</td>
	<td align="center">Fahrer</td>
	<td align="center">Runden</td>
	<td align="center">MaxFahrer</td>
	<?php } ?>
</tr>

<?php

while($item = mysqli_fetch_array($result)) {
	$date = strtotime($item['date']);
?>
<tr>
	<td>
		<a href="blanc.php?page=race_results_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/properties16.png" alt="props"></a>
		<a href="?page=race_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a>
		<a href="?page=race_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
	</td>
	<td><?php echo date("d/m/y", $date)?></td>
	<?php if ($season == 0) { ?>
	<td><?php echo $item['name']?><br><?php echo $item['track']?></td>
	<td><?php echo $item['dname']?><br><?php echo $item['rsname']?><?php echo !empty($item['qrsname']) ? " / " . $item['qrsname'] : ""?></td>
	<td width="40" align="center"><?php echo $item['drivers']?></td>
	<td width="40" align="center"><?php echo $item['laps']?></td>
	<td width="40" align="center"><?php echo $item['maxplayers']?></td>
	<?php } else { ?>
	<td><?php echo $item['name']?></td>
	<td><?php echo $item['track']?></td>
	<td align="center"><?php echo $item['drivers']?></td>
	<td align="center"><?php echo $item['laps']?></td>
	<td align="center"><?php echo $item['maxplayers']?></td>
	<?php } ?>
</tr>
<?php

}
?>
</table>
</div>

</div>
