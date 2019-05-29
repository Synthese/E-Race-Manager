<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: user_chg_do.php
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

$id = addslashes($_POST['id']);
$newpass = $_POST['passreset'] == "1" ? true : false;
$passgen = $_POST['passreset'] == "2" ? true : false;
if($newpass) {
	$pass1 = addslashes($_POST['pass1']);
	$pass2 = addslashes($_POST['pass2']);
}
$pass1 = addslashes($_POST['pass1']);
$pass2 = addslashes($_POST['pass2']);

$error = "";

if(!$newpass && !$passgen) $error .= "Nothing to be changed\n";
if($newpass) {
	if(empty($pass1)) {
		$error .= "You must fill in a password\n";
	} else {
		if($pass1 !== $pass2) $error .= "Password do not match\n";
		else $passwd = sha1($pass1);
	}
}
if($passgen) {
	$pass1 = generate_password();
	$msg .= "Password generated: $pass1\n";
	$passwd = sha1($pass1);
}

if(!empty($error)) error($error);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "UPDATE user SET ";
if(isset($passwd)) $query .= " passwd='$passwd'";
$query .= "WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=users", "User succesfully modified . $msg");
?>
