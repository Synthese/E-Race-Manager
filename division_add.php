<?php 
/*
 * division_add.php  Version 1.11.0.0
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
<div class="card-header"><b>Neue Division anlegen!</b></div>
<form action="division_add_do.php" method="post">
<table class="table table-striped">
<tr>
	<td>Name:</td>
	<td><input type="text" name="name" maxlength="20"></td>
</tr>
<tr>
	<td>Typ:</td>
	<td><input type="text" name="type" maxlength="20"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="Neue Division anlegen">
		<input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>


</div>
</div>