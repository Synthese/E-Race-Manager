<?php 
/* remove_event.php
 * 
 * 
 * 
 */
if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
}
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$id = intval($_GET['id']);
$query = "SELECT * FROM events WHERE id = '$id' LIMIT 1";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("Event does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Event entfernen</b></div>

<form action="remove_event_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Title:</td>
	<td><?php echo $item['name']?></td>
    <td>Bild:</td>
	<td><?php echo $item['image']?></td>
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