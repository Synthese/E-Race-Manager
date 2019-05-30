<?php
/*
 * division_chg_do.php  Version 1.11.0.0
 * date 05.05.19
 *
 *
 */
require_once("session_start.php");

if(!isset($login)) error("Du hast keine Administratorrechte");

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$id = addslashes($_POST['id']);
$type = htmlspecialchars($_POST['type']);

mysqlconnect();
$query = "UPDATE division SET type='$type' WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=divisions", "Division succesfully modified . $msg");
?>
