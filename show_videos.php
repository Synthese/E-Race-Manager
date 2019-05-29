<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: show_videos.php
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
require_once ("functions.php"); // import mysql function
$link =mysqlconnect(); // call mysql function to get the link to the database

    $video ="SELECT `id`, `video_name`, `video_url` FROM video ORDER BY `id` DESC";
    $result =mysqli_query($link, $video);
    if(!$result) {
        show_error("MySQL Error: ".mysqli_error($link)."\n");
        return;
}
   

?>

<div class="container">
<h3>Video Gallery</h3>
    <div class="col col-lg-12">
	<div class="row">					
<?php
 while($sitem =mysqli_fetch_array($result)) {
        $url =$sitem['video_url'];
?>
		   <div class="col col-lg-3">
		   <div class="card">
						<div class="youtube video flex-video">
               <iframe id="ytplayer" type="text/html" width="300" height="240"
	                     src="<?php echo $url; ?>" frameborder="0" allowfullscreen></iframe>
								</div>
							<div>
							<p><b><?php echo $sitem['video_name'] ?></b></p>
					</div>
		</div>	
 </div>
<?php
}
?>
 </div>	
	</div>	
</div>