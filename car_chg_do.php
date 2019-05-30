<?php
/*
 * car_chg_do.php  Version 1.11.0.0
 * date 07.05.19
 * 
 *
 */
require_once("session_start.php");

if(!isset($login)) error("Du hast keine Administratorrechte");
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$id = addslashes($_POST['id']);
$sim = mysqli_real_escape_string($link,$_POST['sim']);
$brand = mysqli_real_escape_string($link,$_POST['brand']);
$name = mysqli_real_escape_string($link,$_POST['name']);
$code = mysqli_real_escape_string($link,$_POST['code']);
$badge = mysqli_real_escape_string($link,$_POST['badge']);
$horsepower = mysqli_real_escape_string($link,$_POST['horsepower']);
$torque = mysqli_real_escape_string($link,$_POST['torque']);
$weight = mysqli_real_escape_string($link,$_POST['weight']);
$description = mysqli_real_escape_string($link,$_POST['description']);

$query = "UPDATE cars SET sim='$sim', brand='$brand', name='$name', code='$code', badge='$badge',
                          horsepower='$horsepower', torque='$torque', weight='$weight', description='$description' WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=cars", "Fahrzeug aktualisiert");
?>
