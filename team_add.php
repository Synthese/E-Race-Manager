<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: team_add.php
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

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
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

function show_driver_combo() {
	global $drivers;

	echo "<select name=\"driver[]\">\n";
	echo "<option value=\"\">&nbsp;</option>\n";
	foreach($drivers as $id => $driver) {
		echo "<option value=\"$id\">$driver</option>";
	}
	echo "</select>\n";
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Team anlegen</b></div>

<form action="team_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" maxlength="30"></td>
</tr>
<tr>
	<td>Fahrer:</td>
	<td>
		<?php for($x = 0; $x < 5; $x++) {
		show_driver_combo();
		echo "<br>\n";
		} ?>
	</td>
</tr>
<tr>
    <td>Logo link in images/driver: 250x150px </td>
	<td><input type="link" name="logo" value="<?php echo $nditem['logo']?>" maxlength="200"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="anlegen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>