<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: seasons_chg_do.php
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
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$id = addslashes($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$division = addslashes($_POST['division']);
$ruleset = addslashes($_POST['ruleset']);
$ruleset_qualifying = addslashes($_POST['ruleset_qualifying']);
$team = $_POST['team'];
$maxteams = addslashes($_POST['maxteams']);
//$series_logo_simresults = addslashes($_POST['series_logo_simresults']);

$error = "";

if(empty($name)) $error .= "You must fill in a name\n";

if(!empty($error)) error($error);

$msg = "";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "SELECT * FROM season WHERE name = '$name' AND division = '$division' AND id != '$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Season with the same name and division does already exist\n");

$query = "UPDATE season SET name='$name', division='$division', ruleset='$ruleset', 
                ruleset_qualifying='$ruleset_qualifying', maxteams='$maxteams', 
                    series_logo_simresults='$series_logo_simresults' WHERE id='$id'";

$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

$query = "DELETE FROM season_team WHERE season='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

if(is_array($team)) {
	foreach($team as $t) {
		if(empty($t)) continue;
		$t = addslashes($t);
		$values .= "('$id', '$t'), ";
	}
	$values = substr($values, 0, -2); //laatste 2 tekens strippen

	if(!empty($values)) {
		$query = "INSERT INTO season_team (season, team) VALUES $values";
		$result = mysqli_query($link,$query);
		if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
	}
}

return_do("liga.php?page=seasons", "Season successfully modified . $msg");
?>
