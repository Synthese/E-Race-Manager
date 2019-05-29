<?php 
if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM point_ruleset $query_where ORDER BY name ASC";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

?>
<div>&nbsp;</div>
<div class="container-fluid">
<div class="card">
<div class="card-header"><b>Punkte Sätze Übersicht</b></div>

<a href="liga.php?page=point_add" class="btn btn-success">Einen neuen PunkteSatz hinzufügen</a>
<?php
if(mysqli_num_rows($result) == 0) {
	show_msg("No rulesets found\n");
	return;
}
?>

<table class="table table-striped">
<tr class="text-white bg-secondary">
	<td>Bearbeiten</td>
	<td>Punktesatz</td>
	<td align="center">1</td>
	<td align="center">2</td>
	<td align="center">3</td>
	<td align="center">4</td>
	<td align="center">5</td>
	<td align="center">6</td>
	<td align="center">7</td>
	<td align="center">8</td>
	<td align="center">9</td>
	<td align="center">10</td>
	<td align="center">11</td>
	<td align="center">12</td>
	<td align="center">13</td>
	<td align="center">14</td>
	<td align="center">15</td>
	<td align="center">16</td>
	<td align="center">17</td>
	<td align="center">18</td>
	<td align="center">19</td>
	<td align="center">20</td>
	<td align="center">21</td>
	<td align="center">22</td>
	<td align="center">23</td>
	<td align="center">24</td>
	<td align="center">25</td>
	<td align="center">26</td>
	<td align="center">27</td>
	<td align="center">28</td>
	<td align="center">29</td>
	<td align="center">30</td>
	<td align="center">q1</td>
	<td align="center">q2</td>
	<td align="center">q3</td>
	<td align="center">fl</td>
</tr>

<?php
while($item = mysqli_fetch_array($result)) {
?>
<tr>
	<td>
		<a href="?page=point_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="chg"></a>
		<a href="?page=point_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="rem"></a>
	</td>
	<td><?php echo $item['name']?></td>
	<td align="center"><?php echo $item['rp1']?></td>
	<td align="center"><?php echo $item['rp2']?></td>
	<td align="center"><?php echo $item['rp3']?></td>
	<td align="center"><?php echo $item['rp4']?></td>
	<td align="center"><?php echo $item['rp5']?></td>
	<td align="center"><?php echo $item['rp6']?></td>
	<td align="center"><?php echo $item['rp7']?></td>
	<td align="center"><?php echo $item['rp8']?></td>
	<td align="center"><?php echo $item['rp9']?></td>
	<td align="center"><?php echo $item['rp10']?></td>
	<td align="center"><?php echo $item['rp11']?></td>
	<td align="center"><?php echo $item['rp12']?></td>
	<td align="center"><?php echo $item['rp13']?></td>
	<td align="center"><?php echo $item['rp14']?></td>
	<td align="center"><?php echo $item['rp15']?></td>
	<td align="center"><?php echo $item['rp16']?></td>
	<td align="center"><?php echo $item['rp17']?></td>
	<td align="center"><?php echo $item['rp18']?></td>
	<td align="center"><?php echo $item['rp19']?></td>
	<td align="center"><?php echo $item['rp20']?></td>
	<td align="center"><?php echo $item['rp21']?></td>
	<td align="center"><?php echo $item['rp22']?></td>
	<td align="center"><?php echo $item['rp23']?></td>
	<td align="center"><?php echo $item['rp24']?></td>
	<td align="center"><?php echo $item['rp25']?></td>
	<td align="center"><?php echo $item['rp26']?></td>
	<td align="center"><?php echo $item['rp27']?></td>
	<td align="center"><?php echo $item['rp28']?></td>
	<td align="center"><?php echo $item['rp29']?></td>
	<td align="center"><?php echo $item['rp30']?></td>
	<td align="center"><?php echo $item['qp1']?></td>
	<td align="center"><?php echo $item['qp2']?></td>
	<td align="center"><?php echo $item['qp3']?></td>
	<td align="center"><?php echo $item['fl']?></td>
</tr>
<?php
}
?>
</table>
</div>
</div>
<br><br>
