<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: standings_add_do.php
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

$page = addslashes($_POST['page']);
$season = addslashes($_POST['season']);

$error = "";

if(empty($page)) $error .= "You must fill in a number";


if(!empty($error)) error($error);

$msg = "";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM standing_pages WHERE page = '$page'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "");
if(mysqli_num_rows($result) > 0) error("Standing with the same page does already exist");

$query = "INSERT INTO standing_pages (page, season) VALUES ('$page', '$season')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "");

return_do("liga.php?page=blocks", "Standing page succesfully added . $msg");
mysqli_free_result($result);
?>
