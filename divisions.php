<?php 
/*
 * divisions.php  Version 1.11.0.0
 * date 07.05.19
 * 
 *
 */

if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

$query = "SELECT * FROM division ORDER BY name ASC";
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Übersicht Divisions</b></div>

<div class="col col-md-3">
<a href="liga.php?page=division_add" class="btn btn-success">Division hinzufügen</a></div>
<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("Keine Divisions gefunden");
	return;
}
?>

<table class="table table-striped table-hover">
<tr class="text-white bg-info">
 <td>Bearbeiten</td>
	<td>Division</td>
	<td>Typ</td>
</tr>

<?php
while($item = mysqli_fetch_array($result)) {
?>
<tr>
	<td>
		<a href="?page=division_chg&amp;id=<?php echo $item['id']?>">
		<img src="images/page/edit16.png" alt="Editieren" title="Editieren"></a>
		<a href="?page=division_rem&amp;id=<?php echo $item['id']?>">
		<img src="images/page/delete16.png" alt="Entfernen" title="Entfernen"></a>
	</td>
	<td><?php echo $item['name']?></td>
	<td><?php echo $item['type']?></td>
</tr>
<?php

}
?>
</table>
</div>
</div>