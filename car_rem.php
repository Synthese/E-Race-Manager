<?php 
/*
 * car_rem.php  Version 1.11.0.0
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

$id = addslashes($_GET['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM cars WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Es gibt noch keine Fahrzeuge");
	return;
}
$item = mysqli_fetch_array($result);

?>
<div class="container">
<div class="card">
<div class="card-header"><b>Fahrzeug löschen</b></div>

<form action="car_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="120">Fahrzeug:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>Willst Du wirklich dieses Fahrzeug entfernen?</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="entfernen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>