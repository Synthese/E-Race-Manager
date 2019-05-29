<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: transfer.php
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
    
    require_once("functions.php"); // import mysql function
    $link = mysqlconnect(); // call mysql function to get the link to the database
    
	if($_POST["abgeschickt"]) {
		$titel 	       = $_POST['titel'];
		$news_inhalt   = $_POST['news'];
		$news_kat      = $_POST['news_kat'];

		if(!is_numeric($news_kat)) {
			echo"<p class=\"alert alert-danger\">Tranfer Markt Kategorie Fehler.</p>";
		} else {
			mysqli_query("INSERT INTO transfer titel, inhalt, datum, user_id, kategorie VALUES ($titel, $news_inhalt, $user_id, $news_kat");
			echo "<p class=\"alert alert-success\">Tranfer Markt Anfrage erfolgreich veröffentlicht.</p>";
		}
	}
	if($_GET["action"]=="delete" && is_numeric($_GET["id"])) {
		$id = $_GET["id"];
		mysqli_query($link, "DELETE FROM transfer WHERE id='".mysqli_real_escape_string($id)."' ") or die(mysqli_error());
		echo"<p class=\"alert alert-success\">Transfer Markt Anfrage erfolgreich gelöscht.</p>";
	}

	if($_GET["action"]=="delete_kat" && is_numeric($_GET["id"])) {
		$id = $_GET["id"];
		mysqli_query($link, "DELETE FROM transfer_kategorie WHERE kategorie_id='".mysqli_real_escape_string($id)."' ") or die(mysqli_error());
		echo"<p class=\"alert alert-success\">Transfer Markt Kategorie erfolgreich gelöscht.</p>";
	}

	$new_kat = $_POST["new_kat"];
	if(isset($new_kat)) {
		$kategorie = $_POST["kategorie"];
		$kategorie = removeUnsafeAttributesAndGivenTags($kategorie);
		mysqli_query($link, "INSERT INTO transfer_kategorie (name) VALUES ('".mysqli_real_escape_string($kategorie)."')");
		echo"<p class=\"alert alert-success\">Transfer Markt Kategorie erfolgreich angelegt.</p>";
	}

	$bildabgesendet = $_POST["bildabgesendet"];
	if (isset($bildabgesendet)) {
		$k_id = $_POST["k_id"];
		$size = $_FILES['datei']['size'];
		$bildpfad = 'transfer_kat_pictures/'.$k_id.'.jpg' ;
		if ($size < $maxsize){
			if (($_FILES['datei']['type'] == "image/pjpeg") or ($_FILES['datei']['type'] == "image/jpeg") ){
				move_uploaded_file($_FILES['datei']['tmp_name'],"transfer_kat_pictures/".$k_id.'.jpg');
				chmod("$bildpfad",0677);
				$breite_hoehe = getimagesize ($bildpfad);
				echo "<p class=\"alert alert-danger\";margin-top:10px\">".$locale['bild_hochladen_erfolgreich']."!</p>";
			} else {
			    echo "<p class=\"alert alert-danger\";margin-top:10px\">".$locale['bildformat_falsch'].": ";
				echo $_FILES['datei']['type'];
				echo "</p>";
			}
		} else {
		    echo "<p class=\"alert alert-danger\";margin-top:10px\">".dateigroesse_falsch1." $size Byte - ".dateigroesse_falsch1."!";
		}
	}
?>
<div>&nbsp;</div>
//+++++++++++++++++++++++++++++++++++++++++++
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		Transfer Markt Anfrage erstellen
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
	  <form action="liga.php?page=transfer" method="post">
			<table class="table table-striped">
				<tr>
					<td>Transfer Markt Kategorie</td>
					<td>
						<select name="news_kat">
						<?php
						$query = "SELECT * FROM transfer_kategorie ORDER BY name";
						$sql = mysqli_query($link, $query);
						while ($row = mysqli_fetch_assoc($sql)) {
							$name = $row['name'];
							$kategorie_id = $row['kategorie_id'];
							echo"<option value=\"$kategorie_id\">$name</option>";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Titel</td>
					<td><input name="titel"></td>
				</tr>
				<tr>
					<td>Text</td>
					<td>
						<textarea name="news" rows="10" cols="40"></textarea>
 					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="abgeschickt" class="btn btn-success" value="Transfer Markt Anfrage veröffentlichen" /></td>
				</tr>
			</table>
			</form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		Transfer Markt Anfrage löschen
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
	  <table class="table table-striped">
				<tr>
					<th>Titel</th>
					<th>Inhalt</th>
					<th>User</th>
					<th>Datum</th>
					<th>Löschen</th>
				</tr>
				<?php
				$result = mysqli_query($link, "SELECT * FROM transfer ORDER BY datum DESC");
				while ($row = mysqli_fetch_assoc($result)) {
					$id 	 = $row["id"];
					$titel	 = $row["titel"];
					$inhalt  = $row["inhalt"];
					$user_id = $row["user_id"];
					$datum   = $row["datum"];
					echo"<tr><td>$titel</td><td>$inhalt</td><td>$user_id</td><td>$datum</td><td><a href=\"?action=delete&id=$id\">entfernen</a></td></tr>";
				}
				?>
			</table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		Transfer Markt Kategorie anlegen
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
	  <form style="margin-top:10px" action="transfer.php" method="post" id="form">
			<table class="table table-striped">
				<tr>
					<td>Kategoriename</td>
					<td><input name="kategorie" style="width:100%" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="new_kat" class=\"alert alert-danger\" value="Transfer Markt Kategorie anlegen" /></td>
				</tr>
			</table>
			</form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingfor">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
		Transfer Markt Kategorie löschen
        </button>
      </h5>
    </div>
    <div id="collapsefor" class="collapse" aria-labelledby="headingfor" data-parent="#accordionExample">
      <div class="card-body">
	  <table class="table table-striped">
				<tr>
					<th>Tranfer Markt Kategorie</th>
					<th>Löschen</th>
				</tr>
				<?php
				$result = mysqli_query($link, "SELECT * FROM transfer_kategorie WHERE name != 'keine' ORDER BY kategorie_id DESC");
				while ($row = mysqli_fetch_assoc($result)) {
					$name 	 = $row["name"];
					$id	 	 = $row["kategorie_id"];
					echo"<tr><td>$name</td><td><a href=\"?action=delete_kat&id=$id\">entfernen</a></td></tr>";
				}
				?>
			</table>
      </div>
    </div>
  </div> 
  <div class="card">
    <div class="card-header" id="headingfive">
      <h5 class="mb-0">
	  <?php $transfer_kat_bild_upload = $_POST["transfer_kat_bild_upload"]; ?>
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
		Transfer Markt Kategorie Bild hochladen
        </button>
      </h5>
    </div>
    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
      <div class="card-body">
	  <?php
			if(isset($transfer_kat_bild_upload)){
			    echo"selected='true'";
			}
			
			if (isset($transfer_kat_bild_upload)) {
				$kategorie_id = $_POST["kategorie"];
				?>

				<p><?php echo $locale['bild_auswaehlen']; ?></p>
				<form action="transfer.php" enctype="multipart/form-data" method="post">
				<input type="file" name="datei">
				<input type="hidden" value="<?php echo"$kategorie_id"; ?>" name="k_id">
				<input type="submit" name="bildabgesendet" class=\"alert alert-danger\" value="<hochladen">
				</form>
				<?php
			}
			?>
			<p>Wähle eine Transfer Markt Kategorie zu der Du ein Bild hochladen möchtest.</p>
			<form style="margin-top: 10px;" action="transfer.php" method="post">
				<select name="kategorie">
				<?php
				
				$trans_kat = mysql_query($link, "SELECT * FROM transfer_kategorie WHERE name != 'keine' ORDER BY name DESC");
				while ($row = mysqli_fetch_assoc($trans_kat)) {
					$kategorie_id = $row['kategorie_id'];
					$name = $row['name'];
					echo"<option value=\"$kategorie_id\">$name</option>";
				}
			
				?>
				</select><br/>
				<input type="submit" name="transfer_kat_bild_upload" class="btn btn-success" value="hochladen">
			</form>



      </div>
    </div>
  </div>

</div>



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
<div class="container">
 <div class="card">
		<div class="card-header"><b>Transfer Markt Anfrage erstellen</b></div>
			<form action="?page=transfer" method="post">
			<table class="table table-striped">
				<tr>
					<td>Transfer Markt Kategorie</td>
					<td>
						<select name="news_kat">
						<?php
						$query = "SELECT * FROM transfer_kategorie ORDER BY name";
						$sql = mysqli_query($link, $query);
						while ($row = mysqli_fetch_assoc($sql)) {
							$name = $row['name'];
							$kategorie_id = $row['kategorie_id'];
							echo"<option value=\"$kategorie_id\">$name</option>";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Titel</td>
					<td><input name="titel"></td>
				</tr>
				<tr>
					<td>Text</td>
					<td>
						<textarea name="news" rows="10" cols="40"></textarea>
 					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="abgeschickt" class="btn btn-success" value="Transfer Markt Anfrage veröffentlichen" /></td>
				</tr>
			</table>
			</form>
		</div>

<div>&nbsp;</div>
	


<div class="card">
		<div class="card-header">Transfer Markt Anfrage löschen</div>
			<table class="table table-striped">
				<tr>
					<th>Titel</th>
					<th>Inhalt</th>
					<th>User</th>
					<th>Datum</th>
					<th>Löschen</th>
				</tr>
				<?php
				$result = mysqli_query($link, "SELECT * FROM $transfer ORDER BY datum DESC");
				while ($row = mysqli_fetch_assoc($result)) {
					$id 	 = $row["id"];
					$titel	 = $row["titel"];
					$inhalt  = $row["inhalt"];
					$user_id = $row["user_id"];
					$datum   = $row["datum"];
					echo"<tr><td>$titel</td><td>$inhalt</td><td>$user_id</td><td>$datum</td><td><a href=\"?action=delete&id=$id\">entfernen</a></td></tr>";
				}
				?>
			</table>
		


		<div class="card-header">Transfer Markt Kategorie anlegen</div>
			<form style="margin-top:10px" action="transfer.php" method="post" id="form">
			<table class="table table-striped">
				<tr>
					<td>Kategoriename</td>
					<td><input name="kategorie" style="width:100%" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="new_kat" class=\"alert alert-danger\" value="Transfer Markt Kategorie anlegen" /></td>
				</tr>
			</table>
			</form>
	

  <div class="card">
		 <div class="card-header">Transfer Markt Kategorie löschen</div>
		 	<table class="table table-striped">
				<tr>
					<th>Tranfer Markt Kategorie</th>
					<th>Löschen</th>
				</tr>
				<?php
				$result = mysqli_query($link, "SELECT * FROM $transfer_kategorie WHERE name != 'keine' ORDER BY kategorie_id DESC");
				while ($row = mysqli_fetch_assoc($result)) {
					$name 	 = $row["name"];
					$id	 	 = $row["kategorie_id"];
					echo"<tr><td>$name</td><td><a href=\"?action=delete_kat&id=$id\">entfernen</a></td></tr>";
				}
				?>
			</table>
  </div>
  	
<div>&nbsp;</div>
	
		<div class="card">
		<div class="card-header">Transfer Markt Kategorie Bild hochladen</div>	
		<?php $transfer_kat_bild_upload = $_POST["transfer_kat_bild_upload"]; ?>
			<?php
			if(isset($transfer_kat_bild_upload)){
			    echo"selected='true'";
			}
			
			if (isset($transfer_kat_bild_upload)) {
				$kategorie_id = $_POST["kategorie"];
				?>

				<p><?php echo $locale['bild_auswaehlen']; ?></p>
				<form action="transfer.php" enctype="multipart/form-data" method="post">
				<input type="file" name="datei">
				<input type="hidden" value="<?php echo"$kategorie_id"; ?>" name="k_id">
				<input type="submit" name="bildabgesendet" class=\"alert alert-danger\" value="<hochladen">
				</form>
				<?php
			}
			?>
			<p>Wähle eine Transfer Markt Kategorie zu der Du ein Bild hochladen möchtest.</p>
			<form style="margin-top: 10px;" action="transfer.php" method="post">
				<select name="kategorie">
				<?php
				
				$sql = mysql_query($link, "SELECT * FROM 'transfer_kategorie' WHERE name != 'keine' ORDER BY name DESC");
				while ($row = mysqli_fetch_assoc($sql)) {
					$kategorie_id = $row['kategorie_id'];
					$name = $row['name'];
					echo"<option value=\"$kategorie_id\">$name</option>";
				}
			
				?>
				</select><br/>
				<input type="submit" name="transfer_kat_bild_upload" class="btn btn-success" value="hochladen">
			</form>
</div>
</div>
</div>
