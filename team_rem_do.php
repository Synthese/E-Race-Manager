<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: team_rem_do.php
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

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

// Check if drivers are related to the team
/** @noinspection SpellCheckingInspection */
$dquery = "SELECT d.name FROM team_driver td JOIN driver d ON (td.driver = d.id) WHERE team='$id'";
$dresult = mysqli_query($link,$dquery);
if(!$dresult) {
	error("MySQL error: " . mysqli_error($link) . "\n");
}
if(mysqli_num_rows($dresult) > 0) {
	$drivers = "";
	while($d = mysqli_fetch_array($dresult)) {
		$drivers .= "&bull; " . $d['name'] . "\n";
	}
	error("Team cannot be deleted because it is related to the following driver(s):\n" . $drivers);
}

$query = "DELETE FROM team WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=teams", "Team successfully deleted . $msg");
?>
