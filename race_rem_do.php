<?php
/*
 * race_rem_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$id = addslashes($_POST['id']);
$season = addslashes($_POST['season']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "DELETE FROM race WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

$query = "DELETE FROM race_driver WHERE race='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=races&season=$season", "Race succesfully deleted . $msg");
?>
