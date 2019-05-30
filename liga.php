<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: liga.php
 * | Author: Synthese
 * | Datum : 22.05.2019
 * +--------------------------------------------------------+
 * | Entfernung von diesem
 * | Copyright-Header ist strengstens verboten ohne
 * | schriftliche Genehmigung des Autors.
 * |
 * |  
 * +--------------------------------------------------------
 */
include("head.php");
include("navi.php");
?>
<div class="container-fluid">
	
	<div class="row">

	<!--Edit Sidebar Content here-->
	<div class="col col-lg-3">
	<?php include("menulinks.php");?>
		</div>
		<!--/End Sidebar Content -->

		<!--Edit Main Content Area here-->
		<div class="col col-lg-6">
					<?php include ("msg.php"); ?>
					<?php include ("$page.php"); ?>
		</div>

			<!--Edit Sidebar Content here-->
			<div class="col col-lg-3">
			<?php include("menurechts.php"); ?> 
				</div>
				<!--/End Sidebar Content -->
				<!--/End Main Content Area here-->
		</div>
</div>

<?php include("footer.php");  ?>
				