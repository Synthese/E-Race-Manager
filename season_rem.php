<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: seasons_rem.php
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

$id = addslashes($_GET['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT s.*, d.name dname, rs.name rsname, qrs.name qrsname FROM season s JOIN division d ON (s.division = d.id) JOIN point_ruleset rs ON (rs.id = s.ruleset) LEFT JOIN point_ruleset qrs ON (qrs.id = s.ruleset_qualifying) WHERE s.id='$id'";
$result = mysqli_query($link, $query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Season does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

$stquery = "SELECT t.name FROM season_team st JOIN team t ON (t.id = st.team) WHERE season='$id'";
$stresult = mysqli_query($link, $stquery);
if(!$stresult) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Season entfernen</b></div>

<form action="season_rem_do.php" method="post">
<table class="table table-striped">
<tr>
	<td width="200">Name:</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>Division:</td>
	<td><?php echo $item['dname']?></td>
</tr>
<tr>
	<td>Punktesatz:</td>
	<td><?php echo $item['rsname']?></td>
</tr>
<tr>
	<td>Punktesatz Qualifying:</td>
	<td><?php echo $item['qrsname']?></td>
</tr>
<tr>
	<td>Teams:</td>
	<td>
	<?php while($stitem = mysqli_fetch_array($stresult)) { ?>
		&bull; <?php echo $stitem['name']?><br>
	<?php } ?>
	</td>
</tr>
<tr>
	<td class="alert-danger">&nbsp;</td>
	<td class="alert-danger"><b>Willst Du wirklich diese Season löschen?</b></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="Löschen">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>