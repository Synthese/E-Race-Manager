<?php
/*
 * event_add_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database


$name = htmlspecialchars($_POST['name']);
$image = htmlspecialchars($_POST['image']);
$game = htmlspecialchars($_POST['game']);
$sign_up = htmlspecialchars($_POST['sign_up']);
$groups = htmlspecialchars($_POST['groups']);
$platform = htmlspecialchars($_POST['platform']);
$error = "";

if(empty($name)) $error .= "You must fill in a name\n";
if(empty($image)) $error .= "You must define drivers nationality\n";
if(empty($sign_up)) $error .= "You must define drivers car-number\n";
if(!empty($error)) error($error);

$msg = "";


$query = "SELECT * FROM events WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Event ist schon vorhanden");

$query = "INSERT INTO events (name, image, sign_up, groups, game, platform) 
    VALUES ('$name', '$image', '$sign_up', '$groups', '$game', '$platform')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=events", "Event hinzugefügt . $msg");
?>
