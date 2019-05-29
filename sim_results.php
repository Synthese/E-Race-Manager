<?php 
if (!defined("CONFIG"))
    exit();


if ($simresultID = intval($_GET['sres']))
	$sim_results = "SELECT simresults_url FROM sim_results WHERE `id` = '$simresultID' LIMIT 1";
else
	$sim_results = "SELECT `sim_results`.`id`, `sim_results`.`race_name` , `season`.`name` 
AS season_name, `sim_results`.`simresults_url` FROM sim_results LEFT JOIN season 
ON `sim_results`.`season` = `season`.`id` ORDER BY `season`.`name`, `sim_results`.`id` 
ASC LIMIT 0 , 30";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$result = mysqli_query($link,$sim_results);
if (!$result) {
    show_error("MySQL Error: " . mysqli_error($link) . "\n");
    return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header bg-info text-white">Simresults</div>
<?php
if ($simresultID) {
	$sitem = mysqli_fetch_array($result);
	?>

	<h3><a href="?page=sim_results">&#8606; Go back</a></h3>
	<iframe src="<?php echo $sitem['simresults_url'];?>" width="100%" height="600px"></iframe>

	<?php
	return;
}
?>

	<table class="table table-striped table-hover">
		<tr class="bg-success text-white">
			<td><b>Name</b></td>
			<td><b>Season</strong></b></td>
			<td><b>Simresults_URL</b></td>
		</tr>
		<?php
		while ($sitem = mysqli_fetch_array($result)) {
			?>
			<tr>
				<td><?php echo  $sitem['race_name'] ?></td>
				<td><?php echo  $sitem['season_name'] ?></td>
				<td><a href="?page=sim_results&sres=<?php echo $sitem['id'];?>">simresults</a></td>
			</tr>
			<?php
		}
		?>
	</table>
</div>
</div>