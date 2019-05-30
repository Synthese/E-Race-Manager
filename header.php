<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: header.php
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
 * | Datei wird entfernt und im Footer eingebaut
 * +--------------------------------------------------------
 */


?>
<br />
<?php if(!defined("CONFIG")) exit() ?>
<br /><br /><h3><a href="<?php echo $config['org_link']?>"><?php echo $config['org']?></a></h3><?php echo TITLE ?>&nbsp;<?php echo VERSION?>
<?php if(isset($login)) { ?>&nbsp;
Logged in as <?php echo $username?><br>
<?php } ?>