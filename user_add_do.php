<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: user_add_do.php
 * | Author: Synthese
 * | Datum : 22.05.2019
 * +--------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist strengstens verboten ohne
 * | schriftliche Genehmigung des Autors.
 * |
 * | Toni Vicente (arv187), Pablo Oña (inguni), 
 * | Stefan Meissner (stmeissner) sind ursprüngliche Autoren 
 * | von PREM Podium Rennen E Manager sowie Autor 
 * | Bert Hekman (DemonTPX) der ursprünglicher Autor von 
 * | Paddock 7.10beta war.
 * | 
 * +--------------------------------------------------------
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$name = strtolower(addslashes($_POST['name']));
$passgen = $_POST['passgen'] == "1" ? true : false;
if(!$passgen) {
	$pass1 = addslashes($_POST['pass1']);
	$pass2 = addslashes($_POST['pass2']);
}

$error = "";

if(empty($name)) $error .= "You must fill in a name\n";
if(!$passgen) {
	if(empty($pass1)) $error .= "You must fill in a password\n";
	if($pass1 !== $pass2) $error .= "Password do not match\n";
}

if(!empty($error)) error($error);

$msg = "";

if($passgen) {
	$pass1 = generate_password();
	$msg .= "Password generated: $pass1\n";
	$passwd = sha1($pass1);
} else {
	$passwd = sha1($pass1);
}

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "SELECT * FROM user WHERE name = '$name'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");
if(mysqli_num_rows($result) > 0) error("Username is already in use\n");

$query = "INSERT INTO user (name, passwd) VALUES ('$name', '$passwd')";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=users", "User succesfully added . $msg");
?>
