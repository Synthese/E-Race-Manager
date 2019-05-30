<?php
/*
 * division_add_do.php  Version 1.11.0.0
 * date 07.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$name = htmlspecialchars($_POST['name']);
$type = htmlspecialchars($_POST['type']);

$error = "";

if(empty($name)) $error .= "You must fill in a name\n";
if(empty($type)) $error .= "You must fill in a type\n";

if(!empty($error)) error($error);

$msg = "";

mysqlconnect();
$query = "SELECT * FROM division WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Division name is already in use\n");

$query = "INSERT INTO division (name, type) VALUES ('$name', '$type')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=divisions", "Division successfully added . $msg");
?>
