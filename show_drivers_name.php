<?php
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: show_drivers_name.php
 * | Version : 1.1.01.0
 * | Datum   : 05.05.2019
 * | Author  : Synthese -- erstmals von Paddock und Arv187
 * +-------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist streng verboten ohne
 * | schriftliche Genehmigung des ursprünglichen Autors.
 * |
 * +-------------------------------------------------------+
 */
if (!defined("CONFIG"))
    exit();

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$sql_drivers = "SELECT name, driver_photo,
    SUM(position_1_count) AS pos_1,
    SUM(position_2_count) AS pos_2,
    SUM(position_3_count) AS pos_3
FROM team_driver, team_driver_top3, driver
WHERE (team_driver.id = team_driver_top3.team_driver AND team_driver.driver = driver.id)
GROUP BY driver
ORDER BY driver.name;";
$exe_drivers = mysqli_query($link,$sql_drivers);
if (!$exe_drivers) {
    show_error("MySQL Error: " . mysqli_error($link) . "\n");
    return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Drivers by name</b></div>
<div class="container">
<div class="responsive">
<table class="table table-striped">
<tr class="text-white bg-info">
<td><h3>
			<button class="btn text-white bg-info border round-large">Name - 
			<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></button></td>
<td></td>
<td>
			<h3><javascript:void(0)" class="tablink" title="Sort by driver podiums">
			<a href="?page=show_drivers" target="_self">
			<button class="btn text-white bg-info border round-large hover-red">Podien - 
			<i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></button></a></h3></td>
<td></td>
<td></td>
<tr class="text-white bg-info">
<td></td>
<td><img src="images/cups/cup1st.png" alt="" width="80" height="80" /></td>
<td><img src="images/cups/cup2nd.png" alt="" width="80" height="80" /></td>
<td><img src="images/cups/cup3rd.png" alt="" width="80" height="80" /></td>
<td></td>
</tr>
<?php
while ($sitem = mysqli_fetch_array($exe_drivers)) {
	if ($sitem['driver_photo'] == '') { $url = 'images/driver/helm-7.png' ; 
	} else { $url = $sitem['driver_photo']; }
	?>
	<tr class="table table-hover text-center">
	<td><?php echo  $sitem['name'] ?></td>
	<td><?php echo  $sitem['pos_1'] ?></td>
	<td><?php echo  $sitem['pos_2'] ?></td>
	<td><?php echo  $sitem['pos_3'] ?></td>
	<td><a><img src="<?php echo $url;?>" width="60" height="60"/></a></td>
	</tr>
	<?php
}
mysqli_free_result($exe_drivers);
?>
</table>
</div>
</div>
</div>
</div>