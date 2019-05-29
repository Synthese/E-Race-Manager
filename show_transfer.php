<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: show_transfer.php
 * | Author: Synthese
 * | Datum : 22.05.2019
 * +--------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist strengstens verboten ohne
 * | schriftliche Genehmigung des Autors.
 * |
 * | 
 * | 
 * +--------------------------------------------------------
 */
if(!defined("CONFIG"))
    exit();

     require_once("functions.php"); // import mysql function
     $link = mysqlconnect(); // call mysql function to get the link to the database
     ?>
<div class="container">     
		<div class="card">
				<div class="card-header text-center">
								<h3>Transfer Markt</h3>
								</div>
		</div>
</div>
		<div>&nbsp;</div>
<div class="container">  		
<?php     
    // Transfers anzeigen
    $result = mysqli_query($link,"SELECT * FROM transfer ORDER BY datum DESC");
    if (mysqli_num_rows($result) == 0) {
        echo "<div class=\"alert alert-info\">Keine Transfer Markt Angebote vorhanden.</div>";
    }
    
    $result = mysqli_query($link,"SELECT *, DATE_FORMAT(datum, '%d.%m.%Y %H:%i Uhr') 
            AS datum FROM rc_user_table AS u LEFT JOIN transfer AS n ON n.user_id=u.user_id 
                WHERE id!='' ORDER BY datum ASC");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $titel = $row["titel"];
        $inhalt = $row["inhalt"];
        $user_id = $row["user_id"];
        $username = $row["username"];
        $kategorie = $row["kategorie"];
        $datum = $row["datum"];
        
        $pfad = 'images/' . 'transfer_kat_pictures/' . $kategorie . '.jpg';
        if (file_exists($pfad)) {
            $pfad = 'images/' . 'transfer_kat_pictures/' . $kategorie . '.jpg';
        } else {
            $pfad = 'images/' . 'transfer_kat_pictures/transfer.png';
        }
  ?>
   
       <div class="card"><!-- Transfer_titel -->
       			<div class="card-header text-primary"><img width="30px" src="<?php echo $pfad ?>">
       			<b><?php echo stripslashes($titel) ?>
       			<div class="text-right text-primary"><?php echo $datum ?></b></div>
       		</div>
       		<div class="card-body"><b>
            <?php echo stripslashes($inhalt) ?></b>
         </div>
         <div>
            <div class="card-footer">Autor: 
														<a href="liga.php?page=showuser&user_id=$user_id"><?php echo $username ?></a>
												</div>
									</div>
      </div>
      <div>&nbsp;</div>
<?php 
  }
?>                                
</div>