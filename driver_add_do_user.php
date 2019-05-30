<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: driver_add_do_user.php
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
define('USE_MYSQL', 1);
include 'functions.php';
include 'config.php';
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$name = htmlspecialchars($_POST['name']);
$error = "";

if(empty($name)) $error .= "You must fill in a name\n";

if(!empty($error)) error($error);

$msg = "";

$photo = htmlspecialchars($_POST['driver_photo']);

$query = "SELECT * FROM driver WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Driver name is already in use\n");

$query = "INSERT INTO driver (name, driver_photo) VALUES ('$name','$photo')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=show_drivers", "Driver succesfully added . $msg");
?>
