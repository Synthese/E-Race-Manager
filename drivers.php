<?php 
/*
 * drivers.php  Version 1.11.0.0
 * date 08.05.19
 * 
 * 
 */
if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
}
$query_where ="";
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT d.*, COUNT(td.id) teamcount FROM driver d LEFT JOIN team_driver td ON (td.driver = d.id) $query_where GROUP BY d.id ORDER BY name ASC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Fahrer Übersicht</b></div>
<div><a href="liga.php?page=driver_add" class="btn btn-success">Fahrer hinzufügen</a></div>

<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("Keine Fahrer gefunden");
	return;
}
?>

<table class="table table-striped">
<tr class="text-white bg-info text-center">
	<td>Bearbeiten</td>
	<td>Name</td>
	<td>Startnummer</td>
	<td>Land</td>
	<td>Mitglied in Teams</td>
</tr>

<?php

while($item = mysqli_fetch_array($result)) {

?>
<tr class="text-center">
	<td>
		<a href="?page=driver_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a>
		<a href="?page=driver_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
	</td>
	<td><?php echo $item['name']?></td>
	<td><?php echo $item['plate']?></td>
	<td><img src="images/flags/<?php echo $item['country']?>.png"</td>
	<td><?php echo $item['teamcount']?></td>
</tr>
<?php

}
?>
</table>
</div>
</div>