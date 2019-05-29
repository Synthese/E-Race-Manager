<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: upload.php
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
<div class="card-header"><b>Uploads</b></div>
<p>Die Upload-Dateien befinden sich in dem Ordner ../uploads/ Dateiname<br />
</p>

<form action="liga.php?page=upload" method="post" enctype="multipart/form-data">
<input type="file" name="file" class="btn btn-light">
<button type="submit" name="btn-upload"class="btn btn-light">Datei hochladen</button>
</form>


    <?php
 if(isset($_GET['success']))
 {
  ?>
        <label>Datei erfolgreich hochgeladen...  </label>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <label>Problem beim Hochladen der Datei !</label>
        <?php
 }
 else
 {
  ?>
        <label><b>Es können nur (PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)hochgeladen werden.</b></label>
        <?php
 }
 ?>


<!--php upload code-->
<?php
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
if(isset($_POST['btn-upload']))
{
 $file = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 $target_file = $folder . $_FILES["file"]["name"];
if (file_exists($target_file))
{
echo "SORRY, Datei ist schon vorhanden.";
return;
}
 // new file size in KB
 $new_size = $file_size/5000;
 // new file size in KB

 // make file name in lower case
 $new_file_name = strtolower($file);
 // make file name in lower case

 $final_file=str_replace(' ','-',$new_file_name);

 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
  $sql="INSERT INTO uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  mysqli_query($link,$sql);
  ?>
  <script>
  alert('erfolgreich hochgeladen');
        window.location.href='?page=upload';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('Fehler beim Hochladen der Datei');
        window.location.href='?page=upload';
        </script>
  <?php
 }
}
?>

<!--Display files from MySql-->

<table class="table table-striped text-center">
<tr>
    <th colspan="5">Uploads</th>
</tr>
   <tr>
    <td>Löschen</td>
    <td>Datei Name</td>
    <td>Datei Type</td>
    <td>Datei Größe in(kb)</td>
    <td>Ansehen</td>
   </tr>
    <?php
 $sql="SELECT * FROM uploads";
 $result_set=mysqli_query($link,$sql);
 while($row=mysqli_fetch_array($result_set))
 {
  ?>
        <tr>
        <td><a href="?page=upload_rem&amp;id=<?php echo $row['id']?>"><img src="images/page/delete16.png" alt="rem"></a></td>
        <td><?php echo $row['file'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['size'] ?>kb</td>
        <td><a href="uploads/<?php echo $row['file'] ?>" onclick="FensterOeffnen(this.href); return false">
        <img src="images/page/ansehen16.png" alt="rem"></a></a></td>
        </tr>
        <?php
 }
 ?>
    </table>
</div>
</div>
