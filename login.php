<?php 
if(!defined("CONFIG")) 
	exit();

if(!defined("USE_MYSQL") || !defined("USE_LOGIN")) {
	show_error("Login is disabled\n");
	return;
}
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header text-center"><?php echo TITLE?></div>
<div class="row">
<div class="col col-lg-4">&nbsp;</div>
<div class="col col-lg-4">
<div id="login" class="text-center"><h4>&nbsp;Log In</h4>
<?php echo SUBTITLE?><div class="small">Version <?php echo VERSION?><br></div>
<br>
<?php mysql_login::print_login_form() ?>
<br>
</div>
</div>
<div class="col col-lg-4">&nbsp;</div>
</div>
</div>
</div>