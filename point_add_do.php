<?php
/*
 * point_add_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$name = htmlspecialchars($_POST['name']);
$rp1 = $_POST['rp1'];
$rp2 = $_POST['rp2'];
$rp3 = $_POST['rp3'];
$rp4 = $_POST['rp4'];
$rp5 = $_POST['rp5'];
$rp6 = $_POST['rp6'];
$rp7 = $_POST['rp7'];
$rp8 = $_POST['rp8'];
$rp9 = $_POST['rp9'];
$rp10 = $_POST['rp10'];
$rp11 = $_POST['rp11'];
$rp12 = $_POST['rp12'];
$rp13 = $_POST['rp13'];
$rp14 = $_POST['rp14'];
$rp15 = $_POST['rp15'];
$rp16 = $_POST['rp16'];
$rp17 = $_POST['rp17'];
$rp18 = $_POST['rp18'];
$rp19 = $_POST['rp19'];
$rp20 = $_POST['rp20'];
$rp21 = $_POST['rp21'];
$rp22 = $_POST['rp22'];
$rp23 = $_POST['rp23'];
$rp24 = $_POST['rp24'];
$rp25 = $_POST['rp25'];
$rp26 = $_POST['rp26'];
$rp27 = $_POST['rp27'];
$rp28 = $_POST['rp28'];
$rp29 = $_POST['rp29'];
$rp30 = $_POST['rp30'];
$qp1 = $_POST['qp1'];
$qp2 = $_POST['qp2'];
$qp3 = $_POST['qp3'];
$fl = $_POST['fl'];

$error = "";

if(empty($name)) $error .= "You must fill in a name\n";

if(!empty($error)) error($error);

$msg = "";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM point_ruleset WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Ruleset name is already in use\n");

$query = "INSERT INTO point_ruleset VALUES (null, '$name', '$rp1', '$rp2', '$rp3', '$rp4', '$rp5', '$rp6', '$rp7', '$rp8', '$rp9', '$rp10', '$rp11', '$rp12', '$rp13', '$rp14', '$rp15', '$rp16', '$rp17', '$rp18', '$rp19', '$rp20', '$rp21', '$rp22', '$rp23', '$rp24', '$rp25', '$rp26', '$rp27', '$rp28', '$rp29', '$rp30', '$qp1', '$qp2', '$qp3', '$fl')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("blanc.php?page=points", "Punktesatz erfolgreich eingetragen . $msg");
?>
