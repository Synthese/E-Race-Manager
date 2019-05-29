<?php 
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 

$season = $_GET['season'];

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
$squery = "SELECT s.*, d.name dname FROM season s JOIN division d ON (d.id = s.division)";
$sresult = mysqli_query($link,$squery);
if(!$sresult) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

$dquery = "SELECT * FROM division";
$dresult = mysqli_query($link, $dquery);
if(!$dresult) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}

$rquery = "SELECT id, name FROM point_ruleset";
$rresult = mysqli_query($link,$rquery);
if(!$rresult) {
	show_error("MySQL error: " . mysqli_error($link));
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Neues Rennen anlegen</b></div>

<form action="race_add_do.php" method="post">
<table class="table table-striped">
	<tr>
		<td>Name:</td>
		<td><input type="text" name="name" value="<?php echo $item['name']?>" maxlength="30"></td>
	</tr>
	<tr>
		<td>Strecke:</td>
		<td><input type="text" name="track" value="<?php echo $item['track']?>" maxlength="30"></td>
	</tr>
	<tr>
	<td>Bild Link:</td>
		<td><input type="link" name="imagelink" value="<?php echo $item['imagelink']?>" size=50px maxlength="100"></td>
	</tr>
	<tr>
	  <td>Forum Link:</td>
		<td><input type="url" name="forumlink" value="<?php echo $item['forumlink']?>" size=50px maxlength="100"></td>
	</tr>
<!-- <tr>
	<td>Simresults Link:</td>
		<td><input type="url" name="simresults" value="<?php echo $item['simresults']?>" size=100% maxlength="200"></td>
	</tr> -->
	<tr>
	<td>Wiederholung:</td>
		<td><select name="replay">
				<optgroup label="(replays in /replays/)">
				
				</optgroup>
				<option value="" selected="selected">keine</option>
		<?php
				 foreach(glob(dirname(__FILE__) . '/replays/*') as $filename){
				 $filename = basename($filename);
				 echo "<option value='" . $filename . "'>".$filename."</option>";
			}
	?></td>
	</tr>
	<tr>
		<td>Runden:</td>
		<td><input type="text" name="laps" value="<?php echo $item['laps']?>" maxlength="3" size="3"></td>
	</tr>
<tr>
	<td>Season:</td>
	<td>
		<select id="season" name="season" onchange="showOptions();">
		<option value="0">--NO SEASON--</option>
		<?php while($sitem = mysqli_fetch_array($sresult)) { ?>
			<option value="<?php echo $sitem['id']?>"<?php echo $season == $sitem['id'] ?> " selected=\"1\"" : ""?>><?php echo $sitem['name']?> (<?php echo $sitem['dname']?>)</option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr id="division">
	<td>Division:</td>
	<td>
		<select id="division" name="division" onchange="void(0);">
		<option value="0">keine Division</option>
		<?php while($ditem = mysqli_fetch_array($dresult)) { ?>
			<option value="<?php echo $ditem['id']?>"><?php echo $ditem['name']?></option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr id="diff_ruleset">
	<td>Unterschiedliche Punktesätze:</td>
	<td><input id="chk_diff_ruleset" name="diff_ruleset" type="checkbox" onchange="showOptions();"/></td>
</tr>
<!-- 
<tr id="division">
	<td>Division:</td>
	<td>
		<select name="division" onchange="void(0);">
		<?php while($ditem = mysqli_fetch_array($dresult)) { ?>
			<option value="<?php echo $ditem['id']?>"><?php echo $ditem['name']?></option>
		<?php } ?>
		</select>
	</td>
</tr> -->
<tr id="ruleset">
	<td>Punktesatz:</td>
	<td>
		<select name="ruleset" onchange="void(0);">
		<?php while($ritem = mysqli_fetch_array($rresult)) { ?>
			<option value="<?php echo $ritem['id']?>"><?php echo $ritem['name']?></option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr id="ruleset_qualifying">
	<td>Punktesatz Qualifying:</td>
	<td>
		<select name="ruleset_qualifying" onchange="void(0);">
		<?php mysqli_data_seek($rresult, 0); ?>
		<option value="">&nbsp;</option>
		<?php while($ritem = mysqli_fetch_array($rresult)) { ?>
			<option value="<?php echo $ritem['id']?>"><?php echo $ritem['name']?></option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr>
	<td>Datum:</td>
	<td>
		<select name="day">
		<?php for($x = 1; $x <= 31; $x++) { ?>
			<option<?php echo date("j") == $x ? " selected" : ""?>><?php echo sprintf("%02d", $x)?></option>
		<?php } ?>
		</select>
		<select name="month">
		<?php $months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"); ?>
		<?php for($x = 1; $x <= 12; $x++) { ?>
			<option<?php echo date("n") == $x ? " selected" : ""?> value="<?php echo $x?>"><?php echo $months[$x]?></option>
		<?php } ?>
		</select>
		<select name="year">
		<?php for($x = 2018; $x <= 2050; $x++) { ?>
			<option<?php echo date("Y") == $x ? " selected" : ""?>><?php echo sprintf("%04d", $x)?></option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr>
	<td>Time:</td>
	<td>
		<select name="hour">
		<?php for($x = 0; $x <= 23; $x++) { ?>
			<option<?php echo $x == "12" ? " selected" : ""?>><?php echo sprintf("%02d", $x)?></option>
		<?php } ?>
		</select> :
		<select name="minute">
		<?php for($x = 0; $x <= 59; $x = $x + 5) { ?>
			<option><?php echo sprintf("%02d", $x)?></option>
		<?php } ?>
		</select>
	</td>
</tr>
<tr>
	<td>Max players:</td>
	<td><input type="text" name="maxplayers" maxlength="3" size="3" value="20"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="erstellen">
		<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>
<script type="text/javascript" language="javascript" src="functions.js"></script>
<script type="text/javascript" language="javascript">
<!--
function showOptions() {
	var season = ele("season").value;
	var chk_diff_ruleset = ele("chk_diff_ruleset").checked;

	if(season === 0) {
		ele("diff_ruleset").style.display = "none";
		ele("division").style.display = "table-row";
		ele("ruleset").style.display = "table-row";
		ele("ruleset_qualifying").style.display = "table-row";
	}
	else {
		ele("diff_ruleset").style.display = "table-row";
		ele("division").style.display = "none";
		if(chk_diff_ruleset) {
			ele("ruleset").style.display = "table-row";
			ele("ruleset_qualifying").style.display = "table-row";
		} else {
			ele("ruleset").style.display = "none";
			ele("ruleset_qualifying").style.display = "none";
		}
	}
}
showOptions();
// -->
</script>
