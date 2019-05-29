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
$query = "SELECT r.*, s.name sname, d.name dname, rs.name rsname FROM race r JOIN division d ON (d.id = r.division) JOIN point_ruleset rs ON (rs.id = r.ruleset) LEFT JOIN season s ON (s.id = r.season) WHERE r.id='$id' ORDER BY r.date DESC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Race does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

$date = strtotime($item['date']);
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Rennen entfernen</b></div>

<form action="race_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="120">Name:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>Track:</td>
	<td><?php echo $item['track']?></td>
</tr>
<tr>
	<td>Imagelink:</td>
	<td><?php echo $item['imagelink']?></td>
</tr>
<tr>
	<td>Laps:</td>
	<td><?php echo $item['laps']?></td>
</tr>
<?php if($item['season'] != 0) { ?>
<tr>
	<td>Season:</td>
	<td><?php echo $item['sname']?></td>
</tr>
<?php } else { ?>
<tr>
	<td>Division:</td>
	<td><?php echo $item['dname']?></td>
</tr>
<tr>
	<td>Ruleset:</td>
	<td><?php echo $item['rsname']?></td>
</tr>
<?php } ?>
<tr>
	<td>Date:</td>
	<td><?php echo date("d-m-Y", $date)?></td>
</tr>
<tr>
	<td>Time:</td>
	<td><?php echo date("H:i", $date)?></td>
</tr>
<tr>
	<td>Max players:</td>
	<td><?php echo $item['maxplayers']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>Are you sure you want to delete this race?</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="hidden" name="season" value="<?php echo $item['season']?>">
		<input type="submit" class="btn btn-success" value="entfernen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>