<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: send_video_url_do.php
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
require_once ("session_start.php");
if (!isset($login))
    error("Du hast keine Administratorrechte");

$video_name = htmlspecialchars($_POST['video_name']);
$video_url = htmlspecialchars($_POST['video_url']);


$error = "";

if (empty($video_name))
    $error .= "You must fill in a video_name\n";
if (empty($video_url))
    $error .= "You must fill in a video_url\n";


if (!empty($error))
    error($error);

$msg = "";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "INSERT INTO video (video_name, video_url) VALUES ('$video_name', '$video_url')";
$result = mysqli_query($link,$query);
if (!$result)
    error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=show_videos", "video_url successfully added . $msg");
?>
