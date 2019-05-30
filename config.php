<?php
# DO NOT REMOVE THIS LINE, IT WILL BREAK THE APPLICATION:
define("CONFIG", true);
# -------------------------------------------------------

# Organisation title. This is the linked title that will appear on top of the page.
$config['org'] = "E-Race-Manager";

# Organisation link. This will be where the link points to.
$config['org_link'] = "http://webseite.de";

# MySQL server configuration
$config['mysql']['host'] = "localhost";
$config['mysql']['user'] = "*****";
$config['mysql']['pass'] = "*****";
$config['mysql']['db'] = "deineDatenbank";
$config['mysql']['port'] = "3306";

//Dieser Bereich ist noch nicht aktive gesetzt und wird noch geändert
$praefix ="rc_";                                // Tabellen Präfix für weitere Installationen
$einstellungen =    $praefix."einstellungen";       // Tabelle für Einstellungen
$news = $praefix."news"; // Tabelle für News
$news_kategorie =   $praefix."news_kategorie"; // Tabelle für News-Kategorie
$transfer = $praefix."transfer"; // Tabelle Transfer
$transfer_kategorie =   $praefix."transfer_kategorie"; // Tabelle Transfer Kategorie


?>
