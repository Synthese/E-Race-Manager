<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: car_add_do.php
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

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$sim = mysqli_real_escape_string($link,$_POST['sim']);
$brand = mysqli_real_escape_string($link,$_POST['brand']);
$name = mysqli_real_escape_string($link,$_POST['name']);
$code = mysqli_real_escape_string($link,$_POST['code']);
$badge = mysqli_real_escape_string($link,$_POST['badge']);
$horsepower = mysqli_real_escape_string($link,$_POST['horsepower']);
$torque = mysqli_real_escape_string($link,$_POST['torque']);
$weight = mysqli_real_escape_string($link,$_POST['weight']);
$description = mysqli_real_escape_string($link,$_POST['description']);
$error = "";

if(empty($sim)) $error .= "You must fill in the used sim";
if(empty($brand)) $error .= "You must fill in the car-brand";
if(empty($name)) $error .= "You must fill in the car-model";
if(empty($code)) $error .= "You must fill in the simcode of the car-model";
if(empty($badge)) $error .= "You must fill in the name of the badge";
if(empty($horsepower)) $error .= "You must fill in the BHP of the car";
if(empty($torque)) $error .= "You must fill in the torque of the car";
if(empty($weight)) $error .= "You must fill in the weight of the car";
if(empty($description)) $error .= "You must fill in a description of the car";

$msg = "";

$query = "SELECT * FROM cars WHERE code = '$code'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Car is already in Database");

$query = "INSERT INTO cars (sim, brand, name, code, badge, horsepower, torque, weight, description)
          VALUES ('$sim', '$brand', '$name','$code','$badge','$horsepower','$torque','$weight','$description')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
return_do("liga.php?page=cars", "Car successfully added . $msg");
?>
