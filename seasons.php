<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: seasons.php
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
$query = "SELECT s.*, d.name dname, rs.name rsname, qrs.name qrsname, COUNT(st.team) teamcount
					FROM season s
					JOIN division d ON (s.division = d.id)
					JOIN point_ruleset rs ON (rs.id = s.ruleset)
					LEFT JOIN point_ruleset qrs ON (qrs.id = s.ruleset_qualifying)
					LEFT JOIN season_team st ON (st.season = s.id)
					/*$query_where*/GROUP BY s.id ORDER BY s.name ASC, d.name ASC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Seasons</b></div>
<!--  <div align="right">
<form action="." method="GET">
<input type="hidden" name="page" value="seasons">Suche nach einer Season
<input type="text" class="search" name="filter" value="<?php //echo $_GET['filter']?>">
</form>
</div> -->
<div class="col col-md-3">
<a href="liga.php?page=season_add" class="btn btn-success">Neue Season anlegen</a></div>
<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("No seasons found\n");
	return;
}
?>
<table class="table table-striped">
<tr class="bg-secondary text-white">
	<td>Bearbeiten</td>
	<td>Season</td>
	<td>Division</td>
	<td>Punktesatz</td>
	<!-- <td>Series Logo for Simresults link</td> -->
	<td>Punktesatz Qualy</td>
	<td class="text-center">Teams</td>
</tr>

<?php

while($item = mysqli_fetch_array($result)) {
?>
<tr>
	<td>
		<a href="?page=season_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="Edit"></a>
		<a href="?page=season_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="delete"></a>
	</td>
	<td><?php echo $item['name']?></td>
	<td><?php echo $item['dname']?></td>
	<td><?php echo $item['rsname']?></td>
	<!-- <td><?php echo $item['series_logo_simresults']?></td> -->
	<td><?php echo $item['qrsname']?></td>
	<td width="65" align="center"><?php echo $item['teamcount']?> / <?php echo $item['maxteams']?></td>
</tr>
<?php

}
?>
</table>
</div>
</div>