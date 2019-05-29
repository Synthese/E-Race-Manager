<?php 
/*
 * main_news.php  Version 1.11.0.0
 * date 07.05.19
 * Datei wird geändert bzw. entfallen mit dem neuen News bereich
 * Admin bereich
 */
if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
/* change character set to utf8 */
$link->set_charset("utf8");

$query = "SELECT id, titel, datum FROM rc_news ORDER BY id DESC";
$result = mysqli_query($link,$query);

if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Add news to show in main page</b></div>
<a href="?page=add_news"><input type="button" class="btn btn-success" value="Add news"/></a>

<h1>News</h1>


<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("No news found\n");
	return;
}
?>

<table class="table table-striped">
	<tr class="text-white bg-info">
		<td>Edit</td>
		<td>Datum</td>
		<td align="center">Title</td>
	</tr>

	<?php
	while($item = mysqli_fetch_array($result)) {
		?>
		<tr>
			<td>
				<a href="?page=remove_news&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
    <a href="?page=edit_news&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a>
			</td>
			<td><?php echo $item['datum']?></td>
			<td><?php echo $item['titel']?></td>
		</tr>
		<?php
	}
	?>
</table>
</div>
</div>