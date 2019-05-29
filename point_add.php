<?php 
/*
 * point_add.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return;
} 
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Punkteset hinzufügen</b></div>

<form action="point_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" maxlength="30"></td>
</tr>
<tr>
	<td>Rennen:</td>
	<td>
		<table>
		<tr>
			<td width="22" align="right">1:</td>
			<td><input type="text" name="rp1" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">2:</td>
			<td><input type="text" name="rp2" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">3:</td>
			<td><input type="text" name="rp3" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">4:</td>
			<td><input type="text" name="rp4" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">5:</td>
			<td><input type="text" name="rp5" size="3" value="0" maxlength="3"></td>
		</tr>
		<tr>
			<td width="22" align="right">6:</td>
			<td><input type="text" name="rp6" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">7:</td>
			<td><input type="text" name="rp7" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">8:</td>
			<td><input type="text" name="rp8" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">9:</td>
			<td><input type="text" name="rp9" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">10:</td>
			<td><input type="text" name="rp10" size="3" value="0" maxlength="3"></td>
		</tr>
		<tr>
			<td width="22" align="right">11:</td>
			<td><input type="text" name="rp11" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">12:</td>
			<td><input type="text" name="rp12" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">13:</td>
			<td><input type="text" name="rp13" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">14:</td>
			<td><input type="text" name="rp14" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">15:</td>
			<td><input type="text" name="rp15" size="3" value="0" maxlength="3"></td>
		</tr>
		<tr>
			<td width="22" align="right">16:</td>
			<td><input type="text" name="rp16" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">17:</td>
			<td><input type="text" name="rp17" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">18:</td>
			<td><input type="text" name="rp18" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">19:</td>
			<td><input type="text" name="rp19" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">20:</td>
			<td><input type="text" name="rp20" size="3" value="0" maxlength="3"></td>
		</tr>
		<tr>
			<td width="22" align="right">21:</td>
			<td><input type="text" name="rp21" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">22:</td>
			<td><input type="text" name="rp22" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">23:</td>
			<td><input type="text" name="rp23" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">24:</td>
			<td><input type="text" name="rp24" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">25:</td>
			<td><input type="text" name="rp25" size="3" value="0" maxlength="3"></td>
		</tr>
		<tr>
			<td width="22" align="right">26:</td>
			<td><input type="text" name="rp26" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">27:</td>
			<td><input type="text" name="rp27" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">28:</td>
			<td><input type="text" name="rp28" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">29:</td>
			<td><input type="text" name="rp29" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">30:</td>
			<td><input type="text" name="rp30" size="3" value="0" maxlength="3"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>Qualifying:</td>
	<td>
		<table border="0">
		<tr>
			<td width="22" align="right">1:</td>
			<td><input type="text" name="qp1" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">2:</td>
			<td><input type="text" name="qp2" size="3" value="0" maxlength="3"></td>
			<td width="22" align="right">3:</td>
			<td><input type="text" name="qp3" size="3" value="0" maxlength="3"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>Schnellste Runde:</td>
	<td><input type="text" name="fl" size="3" value="0" maxlength="3"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="hinzufügen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>