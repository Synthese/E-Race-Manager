<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: driver_rem.php
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
$query = "SELECT * FROM driver WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Fahrer nicht vorhanden");
	return;
}
$item = mysqli_fetch_array($result);

$tquery = "SELECT t.name FROM team_driver td JOIN team t ON (td.team = t.id) WHERE driver='$id'";
$tresult = mysqli_query($link,$tquery);
if(!$tresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($tresult) > 0) {
	$teams = "";
	while($t = mysqli_fetch_array($tresult)) {
		$teams .= "&bull; " . $t['name'] . "\n";
	}
	show_error("Der Fahrer kann nicht gelöscht werden, da er noch in folgenden Teams ist:" . $teams);
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Fahrer entfernen</b></div>

<form action="driver_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="120">Name:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><b>Diesen Fahrer entfernen?</b></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="entfernen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>