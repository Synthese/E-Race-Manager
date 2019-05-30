<?php 
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: add_rules.php
 * | Version : 1.1.05.0
 * | Datum   : 07.05.2019
 * | Author  : Synthese -- erstmals von Paddock und Arv187
 * +-------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist streng verboten ohne
 * | schriftliche Genehmigung des ursprünglichen Autors.
 * |
 * +-------------------------------------------------------+
 */

if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
}
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
if (isset($_POST['rules'])) {
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $rules = mysqli_real_escape_string($link,$_POST['rules']);
    mysqli_query($link,"INSERT INTO rules_table (name, rules) VALUES ('$name', '$rules')");
}
$exe_rules = mysqli_query($link,"SELECT rules FROM rules_table ORDER BY id ASC");
list($rules) = mysqli_fetch_array($exe_rules);
mysqli_free_result($exe_rules);
$news = htmlspecialchars($rules);
?>

<form method="post" action="index.php?page=add_rules">
<table cellpadding="8" border="0">
<tr>
	<td width="100">rules name:</td>
	<td><input type="text" name="name" maxlength="20"></td>
  <td width="300">rules dummytext (Dies kann später editiert werden):</td>
  <td><input type="text" name="rules" maxlength="50"></td>
  <td><input type="submit" value="Save"</td>
</tr>
</table>
</form>
