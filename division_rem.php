<?php 
/*
 * division_rem.php  Version 1.11.0.0
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

$squery = "SELECT s.name FROM division d JOIN season s ON (s.division = d.id) WHERE s.division='$id'";
$sresult = mysqli_query($link,$squery);
if(!$sresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($sresult) > 0) {
	$seasons = "";
	while($s = mysqli_fetch_array($sresult)) {
		$seasons .= "&bull; " . $s['name'] . "\n";
	}
	show_error("<i class=\"alert alert-danger\">Division kann nicht gelöscht werden, da sie sich auf die folgende (n) Saison (en) bezieht:" .'</i><br><br>'. $seasons);
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Division entfernen</b></div>

<form action="division_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>Type:</td>
	<td><?php echo $item['type']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><b>Bist Du sicher das Du die Division entfernen willst?</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="Entfernen">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>