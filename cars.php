<?php
/*
 * cars.php  Version 1.11.0.0
 * date 07.05.19
 * 
 *
 */
if(!defined("CONFIG"))
    exit();
if(!isset($login)) {
    show_error("Du hast keine Administratorrechte");
    return;
}
require_once ("functions.php"); // import mysql function
$link =mysqlconnect(); // call mysql function to get the link to the database
$query ="SELECT * FROM cars";
$cars =mysqli_query($link, $query);
if(!$cars) {
    show_error("MySQL error: ".mysqli_error($link));
    return;
}
?>
<div>&nbsp;</div>
<div class="container">
	<div class="card">
	 <div class="card-header"><b>Fahrzeug Übersicht</b></div>
		<div class="col-lg-5">
			<a href="liga.php?page=car_add"	class="btn btn-success">Fahrzeug manuell hinzufügen</a>
		</div>
<?php
if(mysqli_num_rows($cars)==0) {
    show_msg("Keine Fahrzeuge gefunden");
    return;
}
?>


		<table class="table table-striped">
			<tr class="text-white bg-info">
				<th>
				Edit</th>
				<th>Sim</th>
				<th style="white-space: nowrap">Marke</th>
				<th style="white-space: nowrap">Name</th>
				<th style="white-space: nowrap">SimCode</th>
				<th style="text-align: center">Logo</th>
				<!-- <th>Leistung</th> 
				<th>Drehmoment</th> 
				<th>Gewicht</th> -->
				<th>Beschreibung</th>
			</tr>
<?php
while($item =mysqli_fetch_array($cars)) {
    ?>
<tr>
				<td><a href="?page=car_chg&amp;id=<?php echo $item['id']?>"><img
						src="images/page/edit16.png" alt="chg"></a>
				<a href="?page=car_rem&amp;id=<?php echo $item['id']?>"><img
						src="images/page/delete16.png" alt="rem"></a></td>
				<td><?php echo $item['sim']?></td>
				<td style="white-space: nowrap";><?php echo $item['brand']?></td>
				<td style="white-space: nowrap";><?php echo $item['name']?></td>
				<td style="white-space: nowrap";><?php echo $item['code']?></td>
				<td style="text-align: center"><img
					src="images/badges/<?php echo $item['badge']?>" height="22"
					alt="<?php echo $item['brand']?>"></td>

				<td style="white-space: normal"><?php echo $item['description']?></td>
			</tr>
<?php } ?>
</table>
	</div>
</div>