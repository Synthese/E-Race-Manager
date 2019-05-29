<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: seasons_add.php
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
$diquery = "SELECT * FROM division ORDER BY name ASC";
$diresult = mysqli_query($link,$diquery);
if(!$diresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($diresult) == 0) {
	show_error("There are no divisions.\n<a href=\"?page=division_add\">Add one</a> first.\n");
	return;
}

$rsquery = "SELECT * FROM point_ruleset ORDER BY name ASC";
$rsresult = mysqli_query($link,$rsquery);
if(!$rsresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($rsresult) == 0) {
	show_error("There are no rulesets.\n<a href=\"?page=point_add\">Add one</a> first.\n");
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Neue Season anlegen</b></div>

<form action="season_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" maxlength="20"></td>
</tr>
<tr>
	<td>Division:</td>
	<td>
	<select name="division">
	<?php while($diitem = mysqli_fetch_array($diresult)) { ?>
		<option value="<?php echo $diitem['id']?>"><?php echo $diitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Punktesatz:</td>
	<td>
	<select name="ruleset">
	<?php while($rsitem = mysqli_fetch_array($rsresult)) { ?>
		<option value="<?php echo $rsitem['id']?>"><?php echo $rsitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Punktesatz Qualifying:</td>
	<td>
	<select name="ruleset_qualifying">
	<option value="0">&nbsp;</option>
	<?php mysqli_data_seek($rsresult, 0); ?>
	<?php while($rsitem = mysqli_fetch_array($rsresult)) { ?>
		<option value="<?php echo $rsitem['id']?>"><?php echo $rsitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Max Teams:</td>
	<td><input type="text" name="maxteams" maxlength="3" size="2" value="10"></td>
</tr>
<!-- <tr>
	<td>Series logo for Simresults:</td>
	<td><input type="url" name="series_logo_simresults" maxlength="200"></td>
</tr> -->
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="hinzufügen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>