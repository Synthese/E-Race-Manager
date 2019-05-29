<?php
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: users.php
 * | Version : 1.1.01.0
 * | Datum   : 20.05.2019
 * | Author  : Synthese -- erstmals von Paddock und Arv187
 * +-------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist streng verboten ohne
 * | schriftliche Genehmigung des ursprünglichen Autors.
 * |
 * +-------------------------------------------------------+
 */

if(!defined("CONFIG"))
    exit();
    if(!isset($login)) {
        show_error("Du hast keine Administratorrechte");
        return;
    }

    require_once ("functions.php"); // import mysql function
    $link =mysqlconnect(); // call mysql function to get the link to the database
    
    $query ="SELECT * FROM user ORDER BY name ASC";
    $result =mysqli_query($link, $query);
    if(!$result) {
        show_error("MySQL error: ".mysqli_error($link));
        return;
    }
    ?>
    <div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Admins</b></div>
	<div class="text-center">
	Admin Standard User und Password: admin/admin <strong>Dies bitte ändern !!</strong><br>
		<a href="liga.php?page=user_add" class="btn btn-success">Admin anlegen</a>
		</div><br>
<?php
if(mysqli_num_rows($result)==0) {
    show_msg("Keine Admins gefunden !");
    return;
}
?>
		<table class="table table-striped">
			<tr>
			 <td><b>Bearbeiten</td>
				<td><b>Löschen</td>
				<td><b>Name</td>
			</tr>
<?php
while($item =mysqli_fetch_array($result)) {
    ?>

<tr>
				<td><a href="?page=user_chg&amp;id=<?php echo $item['id']?>"><img
						src="images/page/edit16.png" alt="bearbeiten" title="bearbeiten"></a>
				</td>
				<td><a href="?page=user_rem&amp;id=<?php echo $item['id']?>"> <img
						src="images/page/delete16.png" alt="entfernen" title="entfernen"></a></td>
				<td><?php echo $item['name']; ?></td>
			</tr>
<?php

}
?>
</table>
</div>
	</div>