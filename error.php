<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: error.php
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

	$error = stripslashes(urldecode($error));
$enter_regex = "/(<br\s*\/?>|\n|\r\n)/mi";

$enter_count = preg_match_all($enter_regex, $error, $m);

$error = preg_replace($enter_regex, "<br>\n", $error);

for($x = $enter_count; $x < 3; $x++) {
	$error .= "<br>\n";	
}
?>
<div id="error"><?php echo $error?></div>
