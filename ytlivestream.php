<?php
/*
 * +-------------------------------------------------------+
 * | E - Race - Manager
 * | PHP-Liga Management System
 * | Copyright (C) Synthese
 * | https://www.e-race-manager.all-webservice.de/
 * +-------------------------------------------------------+
 * | Filename: ytlivestream.php
 * | Version : 1.1.04.1
 * | Datum   : 20.08.2019
 * | Author  : Synthese 
 * +-------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist streng verboten ohne
 * | schriftliche Genehmigung des ursprünglichen Autors.
 * |
 * +-------------------------------------------------------+
 */

include ("theme/head.php");
?>
<div class="container">
    <div class="row">
      <div class="col col-lg-12">
			<?php include 'theme/navi.php';?>
      </div>
    </div>
</div>
<div class="container-fluid">
    <div class="text-center">
	<!--Edit Sidebar Content here-->
       <div class="col col-lg-12">
		<h3>Youtube Livestream</h3>
		<p>Abonniere unseren Kanal</p>
		<br />
      </div>
<!--Edit Main Content Area here-->
     <div class="col col-lg-12">
  <iframe width="1280" height="720" 
	  src="http://www.youtube.com/embed/live_stream?channel=Deine ID" frameborder="0" allowfullscreen></iframe>
    </div>
<!--/End Main Content Area here-->
       </div>
    </div>
<div><?php include 'theme/footer.php';?></div>
