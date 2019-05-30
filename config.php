<?php
# DO NOT REMOVE THIS LINE, IT WILL BREAK THE APPLICATION:
define("CONFIG", true);
# -------------------------------------------------------

# Organisation title. This is the linked title that will appear on top of the page.
$config['org'] = "E-Race-Liga";

# Organisation link. This will be where the link points to.
$config['org_link'] = "http://webseite.de";

# MySQL server configuration
$config['mysql']['host'] = "localhost";
$config['mysql']['user'] = "root";
$config['mysql']['pass'] = "root";
$config['mysql']['db'] = "testliga";
$config['mysql']['port'] = "3306";


$praefix ="rc_";                                // Tabellen Pr�fix f�r weitere Installationen
$einstellungen =    $praefix."einstellungen";       // Tabelle f�r Einstellungen
$ligen =    $praefix."ligen";                       // Tabelle f�r alle ligen
$matches =  $praefix."matches";                   // Tabelle f�r die gespielten Spiele
$qualifying =   $praefix."qualifying";             // Tabelle f�r die Qualifyings
$rennen =   $praefix."rennen";                     // Tabelle f�r die Rennen
$rennergebnisse =   $praefix."rennergebnisse";     // Tabelle f�r die Rennergebnisse
$shoutbox = $praefix."shoutbox";                 // Tabelle f�r die Shoutbox
$spiele =   $praefix."spiele";                     // Tabelle f�r unterst�tze Spiele
$teams =    $praefix."teams";                       // Tabelle f�r Teams
$teams_ligen =  $praefix."teams_ligen";           // Tabelle f�r alle zugeordneten Teams einer Liga
$teams_user =   $praefix."teams_user";             // Tabelle team_user
$usergroup =    $praefix."usergroup";               // Tabelle f�r die Gruppen Rechte
$user_table =   $praefix."user_table";             // Tabelle f�r User
$pn =   $praefix."pn";                             // Tabelle f�r das interne Nachrichtensystem
$lang = $praefix.'lang';                         // Tabelle f�r Sprachen
$kommentare =   $praefix."kommentare";             // Tabelle f�r Kommenatre
$match_screenshots =    $praefix."match_screenshots"; // Tabelle f�r Match Screenshots
$shoutbox = $praefix."shoutbox"; // Tabelle f�r die Shoutbox
$news = $praefix."news"; // Tabelle f�r News
$news_kategorie =   $praefix."news_kategorie"; // Tabelle f�r News-Kategorie
$transfer = $praefix."transfer"; // Tabelle Transfer
$transfer_kategorie =   $praefix."transfer_kategorie"; // Tabelle Transfer Kategorie

define ("BASEDIR", '/');
define ("ADMIN", BASEDIR . "admin/" );
define("Liga_ROOT_DIR", dirname(__DIR__).'/');
?>
