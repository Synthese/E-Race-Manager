<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: show_teams.php
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
if (!defined("CONFIG"))  
	exit();
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$sql_drivers = "SELECT driver.id as driverID, driver.name as driverName, team.team as teamID 
            FROM driver LEFT JOIN team_driver as team ON team.driver = driver.id 
                ORDER BY driver.id LIMIT 0, 30";
$exe_drivers = mysqli_query($link,$sql_drivers);
if (!$exe_drivers) {
    show_error("MySQL Error: " . mysqli_error($link) . "\n");
    return;
}
while ($drivers = mysqli_fetch_array($exe_drivers)) {
	$driver[$drivers['teamID']][$drivers['driverID']] = $drivers['driverName'];
}
mysqli_free_result($exe_drivers);
if (!isset($driver)) {
    show_error("Drivers has been not found.");
    return;
}
$teams = "SELECT `team`.`id`, `team`.`name` , `team`.`logo` FROM team ORDER BY `team`.`name` ASC";
$result = mysqli_query($link,$teams);
if (!$result) {
    show_error("MySQL Error: " . mysqli_error($link) . "\n");
    return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Team Übersicht</b></div>

<table class="table table-striped text-center">
	<tr class="text-white bg-info">
		<td>Team Name</h4></td>
		<td>Fahrer</h4></td>
		<td>Team Logo</h4></td>
	</tr>

	<?php
	
	while ($sitem = mysqli_fetch_array($result)) {
	 if ($sitem['logo'] == '') { $url = 'images/team_logos/standard.jpg' ; 
	 } else { $url = $sitem['logo']; }
	?>
	<tr>
	<td><?php echo  $sitem['name'] ?></td><!--team name-->
	<td><!--driver name-->
		<?php
			
		if (is_array($driver[$sitem['id']])) {
			foreach ($driver[$sitem['id']] as $driverID => $driverName) {
				echo "<li>".$driverName."</li>";
			}
		}
		?>
	</td><!--driver name-->
	<td><a href="<?php echo  $url ?>" onclick="FensterOeffnen(this.href); return false"><img src="<?php echo $url;?>" width="250" height="150" class="thumbnail"/></a></td><!--url logo-->
	</tr>
	<?php
	}
	mysqli_free_result($result);
	?>
</table>
</div>
</div>
