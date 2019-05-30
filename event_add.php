<?php
/*
 * event_add.php  Version 1.11.0.0
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



?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Event eintragen</b>  0 für geschlossen 1 für offen bei Beitritt</div>
<form action="event_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Event Name:</td>
	<td><input type="text" name="name" maxlength="20"></td>
</tr>
<tr>
	<td>Bild:</td>
	<td><input type="link" name="image" maxlength="30">&nbsp;Pfad zum Bild</td>
</tr>
<tr>
	<td>Beitritt:</td>
	<td><input type="text" name="sign_up" maxlength="20"> im Moment eingeben<b> Beitritt offen</b> oder geschlossen</td>
</tr>
<tr>
	<td>Gruppe:</td>
	<td><input type="text" name="groups" maxlength="20">Fzg. Klasse</td>
</tr>
<tr>
	<td>Game:</td>
	<td><input type="text" name="game" maxlength="30">im Moment nur GTS&nbsp;Pfad zum Bild</td>
</tr>
<tr>
	<td>Plattform:</td>
	<td><input type="text" name="platform" maxlength="50">&nbsp;Pfad zum Bild</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
    <input type="submit" class="btn btn-success" value="Event anlegen">
	<input type="button" class="btn btn-danger" value="abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>