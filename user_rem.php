<?php 
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: user_rem.php
 * | Version : 1.1.01.0
 * | Datum   : 20.05.2019
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
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Admin entfernen</b></div>

<?php
$id = addslashes($_GET['id']);
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("User / Admin gibt es nicht !");
	return;
}
$item = mysqli_fetch_array($result);
?>

<form action="user_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="entfernen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
		<input type="hidden" name="id" value="<?php echo $id?>">
	</td>
</tr>
</table>
</form>
</div>
</div>