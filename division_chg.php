<?php 
if(!defined("CONFIG")) 
	exit(); 

if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

$id = addslashes($_GET['id']);
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "SELECT * FROM division WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Division does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Division aktualisieren</b></div>

<form action="division_chg_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="120">Name: </td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>Type:</td>
	<td><input class="form-control" type="text" id="type" name="type" 
												value="<?php echo $item['type']?>">
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="Aktualisieren">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>