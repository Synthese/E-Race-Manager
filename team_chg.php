<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: team_chg.php
 * | Author: Synthese
 * | Datum : 22.05.2019
 * +--------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist strengstens verboten ohne
 * | schriftliche Genehmigung des Autors.
 * |
 * | Toni Vicente (arv187), Pablo Oña (inguni), 
 * | Stefan Meissner (stmeissner) sind ursprüngliche Autoren 
 * | von PREM Podium Rennen E Manager sowie Autor 
 * | Bert Hekman (DemonTPX) der ursprünglicher Autor von 
 * | Paddock 7.10beta war.
 * | 
 * +--------------------------------------------------------
 */
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

$id = addslashes($_GET['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM team WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Team existiert keines");
	return;
}
$item = mysqli_fetch_array($result);

$dquery = "SELECT td.id, d.id did, d.name, COUNT(rd.race) rcount 
            FROM team_driver td JOIN driver d ON (td.driver = d.id) LEFT JOIN race_driver rd 
            ON (td.id = rd.team_driver) WHERE td.team = '$id' GROUP BY td.id ORDER BY name ASC";
$dresult = mysqli_query($link,$dquery);
if(!$dresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}

$drivercount = mysqli_num_rows($dresult);

// Potential new drivers
$ndquery = "SELECT * FROM driver ORDER BY name ASC";
$ndresult = mysqli_query($link,$ndquery);
if(!$ndresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}

$drivers = array();
while($nditem = mysqli_fetch_array($ndresult)) {
	$drivers[$nditem['id']] = $nditem['name'];
}

function show_driver_combo($did = 0, $enabled = true) {
	global $drivers;

	echo "<select name=\"driver[]\"" . ($enabled ? "" : " disabled") . ">\n";
	echo "<option value=\"\">&nbsp;</option>\n";
	foreach($drivers as $id => $driver) {
		echo "<option value=\"$id\"";
		if($id == $did) echo " selected";
		echo ">" . $driver;
		echo "</option>\n";
	}
	echo "</select>\n";
	if(!$enabled)
		echo "<input type=\"hidden\" name=\"preserve[]\" value=\"$did\">";
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Team aktualisieren</b></div>
<div>Bilder liegen im Ordner images/team_logos/bild name.endung, diese separat hochladen.<br>
					Format 250px x 150px vorliegen.</div>

<form action="team_chg_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" value="<?php echo $item['name']?>" maxlength="30"></td>
    <td>Logo:</td>
	<td><input type="link" name="logo" value="<?php echo $item['logo']?>" maxlength="200"></td>
</tr>
<tr>
	<td>Fahrer (<?php echo $drivercount?>):</td>
	<td>
	<?php
	for($x = 0; $x < 5; $x++) {
		if($ditem = mysqli_fetch_array($dresult)) {
			show_driver_combo($ditem['did'], ($ditem['rcount'] == 0));
			if($ditem['rcount'] > 0) {
				echo "<img src=\"images/page/info16.png\" title=\"dies kann nicht geändert werden, da sich dieser Fahrer auf bezieht " . $ditem['rcount'] . " race(s) \" onclick=\"alert('dies kann nicht geändert werden, da sich dieser Fahrer auf bezieht " . $ditem['rcount'] . " race(s)');\" alt=\"\">";
			}
		} else {
			show_driver_combo();
		}
		echo "<br>\n";
	}
	?>
	<?php while($ditem = mysqli_fetch_array($dresult)) { ?>
		<a href="?page=team_driver_rem&amp;id=<?php echo $ditem['id']?>"><img src="images/page/delete16.png" alt="delete"></a> <?php echo $ditem['name']?><br>
	<?php } ?>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td colspan="4">
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="aktualisieren">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>