<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: user_add.php
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
if(!isset($login)) {
    show_error("Du hast keine Administratorrechte");
        return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Admin anlegen</b></div>
<form action="user_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" maxlength="20"></td>
</tr>
<tr>
	<td width="250">Generiere Passwort?</td>
	<td>
		<input type="radio" name="passgen" value="1" id="passgenyes" onclick="showOptions(2);"> <label for="passgenyes">Ja</label><br>
		<input type="radio" name="passgen" value="0" id="passgenno" onclick="showOptions(1);" checked> <label for="passgenno">Nein</label>
	</td>
</tr>
<tr id="createpass1">
	<td>Neues Kennwort:</td>
	<td><input type="password" name="pass1"></td>
</tr>
<tr id="createpass2">
	<td>Passwort bestätigen:</td>
	<td><input type="password" name="pass2"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
    <input type="submit" class="btn btn-success" value="Admin anlegen">
	<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>
<script type="text/javascript" language="javascript" src="functions.js"></script>
<!--  
<script type="text/javascript" language="javascript">

function showOptions(op) {
	switch(op) {
		case 1:
			ele("createpass1").style.display = "table-row";
			ele("createpass2").style.display = "table-row";
			break;
		case 2:
			ele("createpass1").style.display = "none";
			ele("createpass2").style.display = "none";
			break;
	}
}
showOptions(1);

</script>
-->