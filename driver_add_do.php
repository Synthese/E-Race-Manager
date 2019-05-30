<?php
/*
 * driver_add_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$name = htmlspecialchars($_POST['name']);
$country = htmlspecialchars($_POST['country']);
$plate = htmlspecialchars($_POST['plate']);
$error = "";

if(empty($name)) $error .= "You must fill in a name\n";
if(empty($country)) $error .= "You must define drivers nationality\n";
if(empty($plate)) $error .= "You must define drivers car-number\n";
if(!empty($error)) error($error);

$msg = "";

$photo = htmlspecialchars($_POST['driver_photo']);

$query = "SELECT * FROM driver WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Driver name is already in use\n");

$query = "INSERT INTO driver (name, plate, country, driver_photo) VALUES ('$name', '$plate', '$country','$photo')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=drivers", "Driver succesfully added . $msg");
?>
