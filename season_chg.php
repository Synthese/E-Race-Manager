<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: seasons_chg.php
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

$query = "SELECT * FROM season WHERE id='$id'";
$result = mysqli_query($link, $query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Season does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

$diquery = "SELECT * FROM division ORDER BY name ASC";
$diresult = mysqli_query($link, $diquery);
if(!$diresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}

$rsquery = "SELECT * FROM point_ruleset ORDER BY name ASC";
$rsresult = mysqli_query($link, $rsquery);
if(!$rsresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($rsresult) == 0) {
	show_error("There are no rulesets.\n<a href=\"?page=point_add\">Add one</a> first.\n");
	return;
}

$tquery = "SELECT * FROM team ORDER BY name ASC";
$tresult = mysqli_query($link,$tquery);
if(!$tresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($tresult) == 0) {
	show_error("There are no teams.\n<a href=\"?page=team_add\">Add one</a> first.\n");
	return;
}

$team = array();
while($titem = mysqli_fetch_array($tresult)) {
	$team[$titem['id']] = $titem['name'];
}

function show_team_combo($tid = 0) {
	global $team;

	echo "<select name=\"team[]\">\n";
	echo "<option value=\"\">&nbsp;</option>\n";
	foreach($team as $id => $tname) {
		echo "<option value=\"$id\"";
		if($tid == $id) echo " selected";
		echo ">$tname</option>\n";
	}
	echo "</select>\n";
}

$stquery = "SELECT * FROM season_team WHERE season='$id'";
$stresult = mysqli_query($link,$stquery);
if(!$stresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Season aktualisieren</b></div>

<form action="season_chg_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="">Name:</td>
	<td><input type="text" name="name" value="<?php echo $item['name']?>" maxlength="20"></td>
</tr>
<tr>
	<td>Division:</td>
	<td>
	<select name="division">
	<?php while($diitem = mysqli_fetch_array($diresult)) { ?>
		<option value="<?php echo $diitem['id']?>"<?php echo ($diitem['id'] == $item['division']) ? " selected" : ""?>><?php echo $diitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Punktesatz:</td>
	<td>
	<select name="ruleset">
	<?php while($rsitem = mysqli_fetch_array($rsresult)) { ?>
		<option value="<?php echo $rsitem['id']?>"<?php echo ($rsitem['id'] == $item['ruleset']) ? " selected" : ""?>><?php echo $rsitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Punktesatz Qualifying:</td>
	<td>
	<select name="ruleset_qualifying">
	<?php mysqli_data_seek($rsresult, 0); ?>
	<option value="0">&nbsp;</option>
	<?php while($rsitem = mysqli_fetch_array($rsresult)) { ?>
		<option value="<?php echo $rsitem['id']?>"<?php echo ($rsitem['id'] == $item['ruleset_qualifying']) ? " selected" : ""?>><?php echo $rsitem['name']?></option>
	<?php } ?>
	</select>
	</td>
</tr>
<tr>
	<td>Max-Teams:</td>
	<td><input type="text" name="maxteams" maxlength="3" size="2" value="<?php echo $item['maxteams']?>"></td>
</tr>
<tr>
	<td>Teams:</td>
	<td>
		<?php
		for($x = 0; $x < $item['maxteams']; $x++) {
			if($stitem = mysqli_fetch_array($stresult))
				show_team_combo($stitem['team']);
			else
				show_team_combo();
			echo "<br>\n";
		}
		?>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="Aktualisieren">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>