<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: blocks.php
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
require_once("session_start.php");
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
?>

<!--Standing_block_pages-->
<?php
    $sql_sp_list = "SELECT sp.*, s.name FROM standing_pages sp JOIN season s 
                ON (sp.season = s.id) ORDER BY sp.page ASC";
    $result_sp_list = mysqli_query($link,$sql_sp_list);
    if(!$result_sp_list) {
    	show_error("MySQL error: " . mysqli_error($link));
    	return;
    }

?>
<div>&nbsp;</div>
<div class="container">
  <div class="card">
   <div class="card-header"><b>Standing Seiten</b></div>
   <div class="col-md-4">
      <a href="liga.php?page=standings_add" class="btn btn-success">Standing Seite hinzufügen</a>
   </div>
<?php
    if(mysqli_num_rows($result_sp_list) == 0) {
    	show_msg("Keine Standing Seiten gefunden");
    	return;
    
    }
?>
<table class="table table-striped">
    <tr class="text-white bg-info">
    	<td>Bearbeiten</td>
        <td>Seite</td>
    	<td>Season</td>
    </tr>

<?php

    while($item = mysqli_fetch_array($result_sp_list)) {
?>

    <tr>
    	<td>
    		<a href="?page=standings_chg&amp;id=<?php echo $item['id']?>"><img src="images/page/edit16.png" alt="Editieren"></a>
    		<a href="?page=standings_rem&amp;id=<?php echo $item['id']?>"><img src="images/page/delete16.png" alt="Löschen"></a>
    	</td>
    	<td><?php echo $item['page']?></td>
    	<td><?php echo $item['name']?></td>
    </tr>
    <?php
    }
    mysqli_free_result($result_sp_list)
    ?>
</table>
</div>
</div>