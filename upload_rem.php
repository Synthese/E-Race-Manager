<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: upload_rem.php
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

if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return;
}

$id = intval($_GET['id']);
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM uploads WHERE id = '$id' LIMIT 1";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("File does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Datei löschen</b></div>

<form action="upload_rem_do.php" method="post">
<table class="table table-striped">
<tr>
    <td><strong>File name:</strong></td>
	<td><?php echo $item['file'] ?></td>
    <td><strong>File type:</strong></td>
    <td><?php echo $item['type'] ?></td>
    <td><strong>Size(KB):</strong></td>
    <td><?php echo $item['size'] ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="Löschen">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
		<input type="hidden" name="id" value="<?php echo $id?>">
	</td>
</tr>
</table>
</form>
</div>
</div>