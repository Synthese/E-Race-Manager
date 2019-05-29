<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: show_rules_edit.php
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

$query = "SELECT id, name, rules FROM rules_table ORDER BY id ASC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
?>
<div class="container">
<div class="card">
<div class="card-header">
<h3>Regeln</h3>
</div>
<a href="?page=add_rules">
<input type="button" class="btn btn-success" value="Add rules"/></a>


<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("No Regulations found\n");
	return;
}
?>
<table class="table table-striped table-hover">
	<tr class="text-white bg-secondary">
		<td>Bearbeiten</td>
		<td align="center">Id</td>
		<td align="center">Name</td>
	</tr>
	<?php
	while($item = mysqli_fetch_array($result)) {
		?>
		<tr>
			<td>
			   <a href="?page=edit_rules_mods&amp;id=<?php echo $item['id']?>"><img src="images/edit16.png" alt="chg"></a>
         <a href="?page=remove_rules&amp;id=<?php echo $item['id']?>"><img src="images/delete16.png" alt="rem"></a>
			</td>
			<td><?php echo $item['id']?></td>
			<td><?php echo $item['name']?></td>
		</tr>
		<?php
	}
	?>
</table>
</div>
</div>