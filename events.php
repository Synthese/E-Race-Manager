<?php 
/*
 * events.php  Version 1.11.0.0
 * date 07.05.19
 *
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

$event ="SELECT `id`, `name`, `image`, `groups`, `sign_up`, `game`,`platform`, `event_link` FROM events ORDER BY `id` ASC";
$result = mysqli_query($link,$event);

if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Event anlegen für main.php</b></div>
<a href="?page=event_add"><input type="button" class="btn btn-success" value="Event anlegen"/></a>

<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("Keine Events gefunden");
	return;
}
?>

<table class="table table-striped">
	<tr class="text-white bg-info">
		<td>Edit</td>
		<td>Name</td>
		<td>Bild</td>
		<td>Beitritt</td>
		<td>Gruppe</td>
		<td>Spiel</td>
		<td>Plattform</td>
		<td>Link Event</td>
	</tr>

	<?php
	while($item = mysqli_fetch_array($result)) {
		?>
		<tr>
			<td>
				<a href="?page=remove_event&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
   <!-- <a href="?page=event_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a> -->
			</td>
			<td><?php echo $item['name']?></td>
			<td><img src="<?php echo $item['image']?>" width="80px"></td>
			<td><?php echo $item['sign_up']?></td>
			<td><?php echo $item['groups']?></td>
			<td><img src="<?php echo $item['game']?>" width="50px"></td>
			<td><img src="<?php echo $item['platform'] ?>" width="20px"></td>
			<td><?php echo $item['event_link']?></td>
		</tr>
		<?php
	}
	?>
</table>
</div>
</div>