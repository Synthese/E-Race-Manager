<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: teams.php
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

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT t.*, COUNT(td.driver) drivercount FROM team t LEFT JOIN team_driver td ON (t.id = td.team) $query_where GROUP BY t.id ORDER BY t.name ASC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Teams</b></div>
<div class="col-md-4">
<a href="?page=team_add" class="btn btn-success">Team hinzufügen</a>
</div>
<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("No teams found\n");
	return;
}
?>

<table class="table table-striped table-hover text-center">
<tr class="text-white bg-info">
	<td>Bearbeiten</td>
	<td>Name</td>
	<td>Fahrer im Team</td>
</tr>

<?php
while($item = mysqli_fetch_array($result)) {
?>
<tr>
	<td>
		<a href="?page=team_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a>
		<a href="?page=team_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
	</td>
	<td><?php echo $item['name']?></td>
	<td align="center"><?php echo $item['drivercount']?></td>
</tr>
<?php
}
?>
</table>
</div>
</div>