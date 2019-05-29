<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: menurechts.php
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
include ("includes/locale/menu.inc");
require_once ("functions.php"); // import mysql function
$link =mysqlconnect(); // call mysql function to get the link to the database

$circuits ="SELECT race.track, race.date, race.division, division.name AS division_name
	FROM race LEFT JOIN division on division.id=race.division
	WHERE race.date>=CURDATE()
	ORDER BY race.date ASC LIMIT 3";
$result =mysqli_query($link, $circuits);
if(!$result) {
    show_error("MySQL Error: ".mysqli_error($link)."\n");
    return;
}
?>
<div>&nbsp;</div>
	<div class="container">
			<div class="card-header text-center"><b>Next Events</b></div>
				<div class="card">
					<table class="table table-hover">
						<tr class="bg-success text-white">
							<td>Datum</td>
							<td>Strecke</td>
							<td>Division</td>
						</tr>
<?php
	while($sitem =mysqli_fetch_array($result)) {
?>
						<tr>
							<td><?php echo date('d.m.y - H:i', strtotime($sitem['date'] ));?></td>
							<td><?php echo  $sitem['track'] ?></td>
							<td><?php echo  $sitem['division_name'] ?></td>
						</tr>
<?php
}
?>
					</table>
				</div>	
<?php
require_once ("results_functions.php");

$query ="SELECT r.*, s.name sname, d.name dname FROM race_driver rd, race r LEFT JOIN 
season s ON (s.id = r.season) JOIN division d ON (d.id = r.division) WHERE ((r.id =rd.race) 
AND (r.progress = 2) AND (rd.status =0)) ORDER BY r.date DESC, rd.position ASC LIMIT 1";
$result =mysqli_query($link, $query);
if(!$result) {
    show_error("MySQL Error: ".mysqli_error($link)."\n");
    return;
}
/*
if(mysqli_num_rows($result)==0) {
show_error("Es haben noch keine Rennen stattgefunden");
    //return;
}
*/
$item =mysqli_fetch_array($result);
$last =($item['id']);
$dquery ="SELECT rd.*, d.name dname, t.name tname FROM race_driver rd JOIN team_driver td 
ON (td.id = rd.team_driver) JOIN team t ON (t.id = td.team) JOIN driver d ON (d.id = td.driver) 
JOIN race r ON (rd.race = r.id) WHERE rd.race='$last' AND (rd.status = 0) ORDER BY rd.position 
ASC LIMIT 4";// Anzeige der kommenden Events hier einstellen Std.4
$dresult =mysqli_query($link, $dquery);
if(!$dresult) {
    show_error("MySQL Error: ".mysqli_error($link)."\n");
    return;
}
mysqli_free_result($result);
?>
<div>&nbsp;</div>
	<div class="card-header text-center"><b>Letztes Rennen</b></div>
	<div class="card text-center">
		<table class="table table-striped">
		<tr>

			<td>Division: <?php echo $item['dname']?></td>
			<td>Track: <?php echo $item['track']?></td>
			</tr>
		</table>
		<table class="table table-striped">
			<tr class="bg-success text-white">
				<td>Pos</td>
				<td>Driver</td>
				<td>Team</td>
			</tr>
					<?php while($ditem = mysqli_fetch_array($dresult)) {    ?>
			<tr>
				<td><?php echo $ditem['position']?></td>
				<td><?php echo $ditem['dname']?></td>
				<td><?php echo $ditem['tname']?></td>
			</tr>
					<?php     } mysqli_free_result($dresult);    ?>
								<?php 
		if($ditem ==0) 
show_error("Es haben noch keine Rennen stattgefunden"); // Prüfen ob Anzeige korrekt ist wenn rennen eingetragen sind.
?>
		</table>
	</div>

	<div>&nbsp;</div>
	<div class="card">
		<div class="card-header text-center"><b>Streaming</b></div>
			<div class="responsive">hier streambox noch einfügen</div>
		</div>

	<div>&nbsp;</div>
		<div class="card">
			<div class="card-header text-center"><b>Werbepartner</b></div>
	<?php
require_once ("functions.php"); // import mysql function
$link =mysqlconnect(); // call mysql function to get the link to the database
$sql ="SELECT * FROM $einstellungen WHERE id=1";
$result =mysqli_query($link, $sql);
while($row =mysqli_fetch_assoc($result)) {
    $adsense_rechts =$row['adsense_rechts'];
}
echo "$adsense_rechts";
?>
	
	</div>
	<div>&nbsp;</div>

</div>