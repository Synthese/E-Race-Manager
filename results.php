<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: results.php
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
require_once ("functions.php");
$link =mysqlconnect();
if($link==null) {
    show_error("Database Error\n");
}else {
    $squery ="SELECT s.id, s.name, d.name dname, COUNT(r.id) racecount FROM season s JOIN division d ON (d.id = s.division) LEFT JOIN race r ON (r.season = s.id) GROUP BY s.id ORDER BY name ASC, dname ASC";
    $sresult =mysqli_query($link, $squery);
    if(!$sresult) {
        show_error("MySQL Error: ".mysqli_error($link)."\n");
        return;
    }
    $rquery ="SELECT r.id, r.name, r.track, r.date, d.name dname, rs.name rsname, qrs.name qrsname 
            FROM race r JOIN division d ON (r.division = d.id) JOIN point_ruleset rs 
            ON (r.ruleset = rs.id) LEFT JOIN point_ruleset qrs ON (r.ruleset_qualifying = qrs.id) 
            WHERE r.season='0' ORDER BY r.date ASC";
    $rresult =mysqli_query($link, $rquery);
    if(!$rresult) {
        show_error("MySQL Error: ".mysqli_error()."\n");
        return;
    }
}
?>
<div>&nbsp;</div>
<div class="container">
	<div class="card">
		<div class="card-header">
			<b>Ergebnisse</b>
		</div>
		<div class="responsive">
			<table class="table table-striped table-hover">
				<tr class="text-white bg-info">
					<td>Season</td>
					<td>Division / Gruppe / Klasse</td>
					<td>Rennen / Anzahl</td>
				</tr>
<?php
while($sitem =mysqli_fetch_array($sresult)) {
    ?>

<tr>
					<td><a
						href="blanc.php?page=result_season&amp;season=<?php echo $sitem['id']?>"><?php echo $sitem['name']?></a>
					</td>
					<td><?php echo $sitem['dname']?></td>
					<td><?php echo $sitem['racecount']?></td>
				</tr>
<?php
}
?>
</table>
		</div>
	</div>
</div>
<div>&nbsp;</div>
<div class="container">
	<div class="card">
		<div class="card-header"><b>Events</b></div>
		<div class="responsive">
			<table class="table table-striped table-hover">
				<tr class="text-white bg-info">
					<td>Name</td>
					<td>Strecke</td>
					<td>Datum</td>
					<td>Division</td>
					<td>Punktesatz</td>
				</tr>
<?php
while($ritem =mysqli_fetch_array($rresult)) {
    $date =strtotime($ritem['date']);
    ?>

<tr>
					<td><a
						href="liga.php?page=result_race&amp;race=<?php echo $ritem['id']?>"><?php echo $ritem['name']?>
	</a></td>
					<td><?php echo $ritem['track']?></td>
					<td><?php echo date("d M Y", $date)?></td>
					<td><?php echo $ritem['dname']?></td>
					<td>
	<?php echo $ritem['rsname']?>
	<?php echo isset($ritem['qrsname']) ? " / " . $ritem['qrsname'] : ""?>
	</td>
				</tr>
<?php
}
?>
</table>
		</div>
	</div>
</div>
