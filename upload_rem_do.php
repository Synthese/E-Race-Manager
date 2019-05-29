<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: upload_rem_do.php
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

$id = intval($_POST['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$sql_fileInfo = "SELECT `file` FROM uploads WHERE id='$id' LIMIT 1";
$exe_fileInfo = mysqli_query($link,$sql_fileInfo);
$fileInfo = mysqli_fetch_array($exe_fileInfo);
mysqli_free_result($exe_fileInfo);

$result = mysqli_query($link,"DELETE FROM uploads WHERE id='$id' LIMIT 1");
unlink("uploads/".$fileInfo['file']);

if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=upload", "File succesfully removed");

?>
