<?php
include ("head.php");
include ("includes/locale/locale.inc");

?>

	<div class="container">
			<div class="row-fluid">
				<div class="col col-lg-12">
			<?php include("navi.php");?>			
   </div>
			</div>
	</div>

	<div class="container">

			<div class="row">
				<div class="col col-lg-8">

					<h1>Kontakt</h1>
					<h3 style="color: #FF6633;"><?php echo $_GET[msg];?></h3>
					<hr>
					<!--Start Contact form -->
					<form name="enq" method="post" action="email/"
						onsubmit="return validation();">
						<fieldset>
						
	<input type="text" name="name" id="name" value="" class="input-block-level" placeholder="Name" /> 
	<input	type="text" name="email" id="email" value=""	class="input-block-level" placeholder="Email" />
<textarea rows="15" name="message" id="message" class="input-block-level" placeholder="Comments"></textarea>
							<div class="actions">
							<input type="submit" value="Sende Deine Nachricht ab" name="submit" id="submitButton" class="btn btn-info pull-right"
									title="Sende Deine Nachricht ab!" />
							</div>

						</fieldset>
					</form>
					<!--End Contact form -->
				</div>

				<!--Edit Sidebar Content here-->
				<div class="col col-lg-4 sidebar">
					<div class="sidebox">
						<h3 class="sidebox-title">Kontakt Information</h3>
						<p>
						
						
						<address>
							<strong>E-Race Manager</strong><br /> <br /> <br /> <abbr
								title="Phone"></abbr>
						</address>
						<address>
							<strong>Email</strong><br /> <a
								href="mailto:hier@deine Mail einfügen.de">Deine Mail Adresse</a>
						</address>

						<!-- Start kontakt info -->
						<h4 class="sidebox-title">Kontakt informationen</h4>
						<ul>
							<li><a href="#">Fragen einfach an uns schreiben.</a></li>
							<li><a href="#">Vorschläge Ideen nehmen wir auch entgegen.</a></li>
							<li><a href="#">Kritik kannst Du auch loswerden.</a></li>
							<li><a href="#">Solltest Du auf diesen Seiten Probleme haben,</a></li>
							<li><a href="#">dann teile uns das per Mail hier mit.</a></li>
							<li><a href="#">Wir danken Dir für Deine Mail an uns.</a></li>
						</ul>
						<!-- End kontakt info -->

					</div>



				</div>
				<!--/End Sidebar Content-->


			</div>

			</div>
			
			
	
<div>
<?php include("footer.php");?></div>