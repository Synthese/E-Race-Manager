<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: show_rules.php
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

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$exe_rules = mysqli_query($link,"SELECT rules FROM rules_table WHERE id = $_GET[id] LIMIT 1");
list($rules) = mysqli_fetch_array($exe_rules);
mysqli_free_result($exe_rules);
if (!$rules) {
    show_error("There\'s no rules at the moment.");
    return;
}
echo $rules;
?>
