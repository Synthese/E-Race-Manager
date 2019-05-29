<?php 
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: show_circuits.php
 * | Version : 1.1.01.0
 * | Datum   : 07.05.2019
 * | Author  : Synthese -- erstmals von Paddock und Arv187
 * +-------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist streng verboten ohne
 * | schriftliche Genehmigung des ursprünglichen Autors.
 * |
 * +-------------------------------------------------------+
 */
if (!defined("CONFIG")) exit();
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$circuits = "SELECT race.track, race.name, race.division, race.date, race.imagelink, race.maxplayers, race.season, division.name AS division_name
    	FROM race LEFT JOIN division on division.id=race.division WHERE race.date>=CURDATE() ORDER BY race.date ASC, race.division ASC";
$result = mysqli_query($link,$circuits);
if (!$result) {
    show_error("MySQL Error: " . mysqli_error($link) . "\n");
    return;
}
?>


<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header">
<h3>Veranstaltungen</h3>
</div>

<table class="table table-striped text-center">
    <tr class="text-white bg-info ">
    	<td>Name</td>
    	<td>Strecke</td>
    	<td>Division</td>
        <td>Datum</td>
        <td width="50px">Image</td>
    </tr>

<?PHP while ($sitem = mysqli_fetch_array($result)) { ?>

    <tr>
        <td><?php echo  $sitem['name'] ?></td>
        <td><?php echo  $sitem['track'] ?></td>
        <td><?php echo  $sitem['division_name'] ?></td>
        <td><?php echo  date('d.m.Y -- H:i:s', strtotime($sitem['date'])) ?></td>
        <td><a href="<?php echo  $sitem['imagelink'] ?>" onclick="FensterOeffnen(this.href); return false">
        <img width="100px" height="60px" src="<?php echo  $sitem['imagelink']; ?>"/></a></td>
    </tr>

<?PHP } ?>
</table>
</div>
</div>