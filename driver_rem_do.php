<?php
/*
 * driver_rem_do.php  Version 1.11.0.0
 * date 08.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$id = addslashes($_POST['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

// Check if teams are related to the driver
$tquery = "SELECT t.name FROM team_driver td JOIN team t ON (td.team = t.id) WHERE driver='$id'";
$tresult = mysqli_query($link,$tquery);
if(!$tresult) {
	error("MySQL error: " . mysqli_error($link) . "\n");
}
if(mysqli_num_rows($tresult) > 0) {
	$teams = "";
	while($t = mysqli_fetch_array($tresult)) {
		$teams .= "&bull; " . $t['name'] . "\n";
	}
	error("Der Fahrer kann nicht gelöscht werden, da er noch in folgenden Teams ist:" . $teams);
}

$query = "DELETE FROM driver WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=drivers", "Fahrer wurde entfernt . $msg");
?>
