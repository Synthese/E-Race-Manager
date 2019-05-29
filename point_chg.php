<?php 
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

$id = addslashes($_GET['id']);

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$query = "SELECT * FROM point_ruleset WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) {
	show_error("MySQL error: " . mysqli_error($link) . "\n");
	return;
}
if(mysqli_num_rows($result) == 0){
	show_error("Ruleset does not exist\n");
	return;
}
$item = mysqli_fetch_array($result);

?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Punktesatz aktualisieren</b></div>

<form action="point_chg_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name :</td>
	<td><?php echo $item['name']?></td>
</tr>
<tr>
	<td>Rennen:</td>
	<td>
		<table class="table table-striped">
		<tr>
			<td align="right">1:</td>
			<td><input type="text" name="rp1" value="<?php echo $item['rp1']?>" size="3" maxlength="3"></td>
			<td align="right">2:</td>
			<td><input type="text" name="rp2" value="<?php echo $item['rp2']?>" size="3" maxlength="3"></td>
			<td align="right">3:</td>
			<td><input type="text" name="rp3" value="<?php echo $item['rp3']?>" size="3" maxlength="3"></td>
			<td align="right">4:</td>
			<td><input type="text" name="rp4" value="<?php echo $item['rp4']?>" size="3" maxlength="3"></td>
			<td align="right">5:</td>
			<td><input type="text" name="rp5" value="<?php echo $item['rp5']?>" size="3" maxlength="3"></td>
		</tr>
		<tr>
			<td align="right">6:</td>
			<td><input type="text" name="rp6" value="<?php echo $item['rp6']?>" size="3" maxlength="3"></td>
			<td align="right">7:</td>
			<td><input type="text" name="rp7" value="<?php echo $item['rp7']?>" size="3" maxlength="3"></td>
			<td align="right">8:</td>
			<td><input type="text" name="rp8" value="<?php echo $item['rp8']?>" size="3" maxlength="3"></td>
			<td align="right">9:</td>
			<td><input type="text" name="rp9" value="<?php echo $item['rp9']?>" size="3" maxlength="3"></td>
			<td align="right">10:</td>
			<td><input type="text" name="rp10" value="<?php echo $item['rp10']?>" size="3" maxlength="3"></td>
		</tr>
		<tr>
			<td align="right">11:</td>
			<td><input type="text" name="rp11" value="<?php echo $item['rp11']?>" size="3" maxlength="3"></td>
			<td align="right">12:</td>
			<td><input type="text" name="rp12" value="<?php echo $item['rp12']?>" size="3" maxlength="3"></td>
			<td align="right">13:</td>
			<td><input type="text" name="rp13" value="<?php echo $item['rp13']?>" size="3" maxlength="3"></td>
			<td align="right">14:</td>
			<td><input type="text" name="rp14" value="<?php echo $item['rp14']?>" size="3" maxlength="3"></td>
			<td align="right">15:</td>
			<td><input type="text" name="rp15" value="<?php echo $item['rp15']?>" size="3" maxlength="3"></td>
		</tr>
		<tr>
			<td align="right">16:</td>
			<td><input type="text" name="rp16" value="<?php echo $item['rp16']?>" size="3" maxlength="3"></td>
			<td align="right">17:</td>
			<td><input type="text" name="rp17" value="<?php echo $item['rp17']?>" size="3" maxlength="3"></td>
			<td align="right">18:</td>
			<td><input type="text" name="rp18" value="<?php echo $item['rp18']?>" size="3" maxlength="3"></td>
			<td align="right">19:</td>
			<td><input type="text" name="rp19" value="<?php echo $item['rp19']?>" size="3" maxlength="3"></td>
			<td align="right">20:</td>
			<td><input type="text" name="rp20" value="<?php echo $item['rp20']?>" size="3" maxlength="3"></td>
		</tr>
		<tr>
			<td align="right">21:</td>
			<td><input type="text" name="rp21" value="<?php echo $item['rp21']?>" size="3" maxlength="3"></td>
			<td align="right">22:</td>
			<td><input type="text" name="rp22" value="<?php echo $item['rp22']?>" size="3" maxlength="3"></td>
			<td align="right">23:</td>
			<td><input type="text" name="rp23" value="<?php echo $item['rp23']?>" size="3" maxlength="3"></td>
			<td align="right">24:</td>
			<td><input type="text" name="rp24" value="<?php echo $item['rp24']?>" size="3" maxlength="3"></td>
			<td align="right">25:</td>
			<td><input type="text" name="rp25" value="<?php echo $item['rp25']?>" size="3" maxlength="3"></td>
		</tr>
		<tr>
			<td align="right">26:</td>
			<td><input type="text" name="rp26" value="<?php echo $item['rp26']?>" size="3" maxlength="3"></td>
			<td align="right">27:</td>
			<td><input type="text" name="rp27" value="<?php echo $item['rp27']?>" size="3" maxlength="3"></td>
			<td align="right">28:</td>
			<td><input type="text" name="rp28" value="<?php echo $item['rp28']?>" size="3" maxlength="3"></td>
			<td align="right">29:</td>
			<td><input type="text" name="rp29" value="<?php echo $item['rp29']?>" size="3" maxlength="3"></td>
			<td align="right">30:</td>
			<td><input type="text" name="rp30" value="<?php echo $item['rp30']?>" size="3" maxlength="3"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>Qualifying:</td>
	<td>
		<table border="0">
		<tr>
			<td align="right">1:</td>
			<td><input type="text" name="qp1" value="<?php echo $item['qp1']?>" size="3" maxlength="3"></td>
			<td align="right">2:</td>
			<td><input type="text" name="qp2" value="<?php echo $item['qp2']?>" size="3" maxlength="3"></td>
			<td align="right">3:</td>
			<td><input type="text" name="qp3" value="<?php echo $item['qp3']?>" size="3" maxlength="3"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>Schnellste Runde:</td>
	<td><input type="text" name="fl" value="<?php echo $item['fl']?>" size="3" maxlength="3"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<b>Bitte beachten</b>, dass durch das Ändern eines Regelsatzes alle damit zusammenhängenden 
		Ergebnisse betroffen sind.<br>
		<br>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<input type="submit" class="btn btn-success" value="Aktualisieren">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>
<br>
<br>
<br>