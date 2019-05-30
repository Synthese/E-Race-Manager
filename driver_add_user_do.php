<?php
/*
 * driver_add_user_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
define('USE_MYSQL', 1);
include 'functions.php';
include 'config.php';

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$name = htmlspecialchars($_POST['name']);
$country = htmlspecialchars($_POST['country']);
$photo = htmlspecialchars($_POST['driver_photo']);
$plate = htmlspecialchars($_POST['plate']);

$error = "";


if(empty($name)) $error .= "You must fill in a name";

if(!empty($error)) error($error);

$msg = "";



$query = "SELECT * FROM driver WHERE name = '$name'";
$result = mysqli_query($link, $query);

if(!$result) error("MySQL Error: " . mysqli_error($link) . " ");
if(mysqli_num_rows($result) > 0) error("Driver name is already in use ");

//$query = "INSERT INTO driver (`name`, `plate`, `driver_photo` ) VALUES ('$name', '$plate', '$photo')";
$query = "INSERT INTO driver (name, plate, country, 1st, 2nd, 3rd, driver_photo) VALUES ('$name', '$plate', '$country','0','0','0','$photo')";

$result = mysqli_query($link, $query);
if(!$result) error("MySQL Error: " . mysqli_error($link) );

return_do("liga.php?page=show_drivers", "Driver succesfully added . $msg");
?>
