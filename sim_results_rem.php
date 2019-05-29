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
$query = "SELECT * FROM sim_results WHERE id = '$id' LIMIT 1";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
if(mysqli_num_rows($result) == 0) {
	show_error("Sim_results does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);
?>
<h1>Delete Sim results entry</h1>

<form action="?page=sim_results_rem_do" method="post">
<table border="0">
<tr>
	<td>Race name:</td>
	<td><?php echo $item['race_name']?></td>
    <td>Season:</td>
	<td><?php echo $item['season']?></td>
    <td>Url:</td>
    <td><?php echo $item['simresults_url']?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="button submit" value="Delete">
		<input type="button" class="button cancel" value="Cancel" onclick="history.go(-1);">
		<input type="hidden" name="id" value="<?php echo $id?>">
	</td>
</tr>
</table>
</form>
