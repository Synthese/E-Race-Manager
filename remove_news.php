<?php 
if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
}

$id = intval($_GET['id']);
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
/* change character set to utf8 */
$link->set_charset("utf8");

$query = "SELECT * FROM rc_news WHERE id = '$id' LIMIT 1";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("news does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);
?>
<div>&nbsp;</div>
<div class="container"></div>
<div class="card"></div>
<div class="card-header"><b>News entfernen</b></div>

<form action="remove_news_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Titel:</td>
	<td><?php echo $item['titel']?></td>
    <td>Datum:</td>
	<td><?php echo $item['datum']?></td>
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
