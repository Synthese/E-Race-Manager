<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: send_video_url.php
 * | Author: Synthese
 * | Datum : 22.05.2019
 * +--------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist strengstens verboten ohne
 * | schriftliche Genehmigung des Autors.
 * |
 * | Toni Vicente (arv187), Pablo Oña (inguni), 
 * | Stefan Meissner (stmeissner) sind ursprüngliche Autoren 
 * | von PREM Podium Rennen E Manager sowie Autor 
 * | Bert Hekman (DemonTPX) der ursprünglicher Autor von 
 * | Paddock 7.10beta war.
 * | 
 * +--------------------------------------------------------
 */
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 
?>

<!--ADD-->
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Videos</b></div>
<div class="card-body">
Hinzufügen von Videos für die Video Seite
<p>Gehen zu Youtube-Video und klicken auf die Share-Option. Danach gehst Du zur Option Einfügen und kopierst die Video-URL mit <strong>"einbetten"</strong> Parameter.<br />
Beispiel: https://www.youtube.com/<strong>embed</strong>/hier channelID Dies ist die URL, die in den Link eingefügt werden muss.<br /></p>
</div>
<form action="send_video_url_do.php" method="post">
<table>
<tr>
	<td width="120">Video Titel:</td>
	<td><input type="text" name="video_name" maxlength="30"></td>
</tr>
<tr>
	<td>Video url:</td>
	<td><input type="url" name="video_url" maxlength="200"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="Video hinzufügen">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>

<!--REMOVE-->

<?php
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$query = "SELECT id, video_name, video_url FROM video ORDER BY id ASC";
$result = mysqli_query($link,$query);

if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

if(mysqli_num_rows($result) == 0) {
	show_msg("No videos found\n");
	return;
}
?>

<table class="table table-striped">
	<tr class="text-white bg-info">
		<td>&nbsp;</td>
		<td>Video Name</td>
		<td align="center">Video url</td>
	</tr>

	<?php
	while($item = mysqli_fetch_array($result)) {
		?>
		<tr>
			<td>
				<a href="?page=send_video_url_rem&amp;id=<?php echo $item['id']?>"><img src="images/delete16.png" alt="rem"></a>
			</td>
			<td><?php echo $item['video_name']?></td>
			<td><?php echo $item['video_url']?></td>
		</tr>
		<?php
	}
	?>
</table>
</div>
</div>