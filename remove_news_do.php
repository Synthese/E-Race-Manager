<?php
/*
 * Datei muss bearbeitet werden da anderes news System kommt.
 * admin
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$id = intval($_POST['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "DELETE FROM rc_news WHERE id='$id' LIMIT 1";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=main_news", "News erfolgreich entfernt");
?>
