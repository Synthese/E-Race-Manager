<?php 
/*
 * -------------------------------------------------------+
 * | PHP- E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: add_news.php
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
 * |datei muss an die neue News Datei angepast werden!!!
 * +--------------------------------------------------------
 */

if(!defined("CONFIG")) 
	exit();
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return;
}
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

if (isset($_POST['news'])) {
    $title = mysqli_real_escape_string($link,$_POST['title']);
    $news = mysqli_real_escape_string($link,$_POST['news']);
    $day = date('Y-m-d H:i:s');
    mysqli_query($link,"INSERT INTO main_news (title, news, day) VALUES ('$title', '$news', '$day')");
}

if (empty($title))
    $error .= "You must fill in a title\n";
$exe_news = mysqli_query($link,"SELECT news FROM main_news ORDER BY day DESC");
list($news) = mysqli_fetch_array($exe_news);
mysqli_free_result($exe_news);
$news = htmlspecialchars($news);
?>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>News hinzufügen</b></div>
<form method="post" action="index.php?page=add_news">
<table border="0">
<tr>
	<td width="120">Titel:</td>
	<td><input type="text" name="title" maxlength="30"></td>
</tr>
</table>
    <textarea id="tinyeditor" name="news" cols="50" rows="15"><?php echo $news; ?></textarea>
    <input type="submit" class="btn btn-success" value="Speichern" />
</form>
</div>
</div>