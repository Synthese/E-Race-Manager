<?php
/*
 * race_chg_do.php  Version 1.11.0.0
 * date 05.05.19
 * 
 *
 */
require_once("session_start.php");
if(!isset($login)) error("Du hast keine Administratorrechte");

$id = addslashes($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$track = htmlspecialchars($_POST['track']);
$laps = addslashes($_POST['laps']);
$season = addslashes($_POST['season']);
$diff_ruleset = isset($_POST['diff_ruleset']);
$division = addslashes($_POST['division']);
$ruleset = addslashes($_POST['ruleset']);
$ruleset_qualifying = addslashes($_POST['ruleset_qualifying']);
$date = mktime($_POST['hour'], $_POST['minute'], 0, $_POST['month'], $_POST['day'], $_POST['year']);
$date = date("Y-m-d H:i:s",$date);
$maxplayers = addslashes($_POST['maxplayers']);
$imagelink = htmlspecialchars($_POST['imagelink']);
$forumlink = htmlspecialchars($_POST['forumlink']);
$simresults = htmlspecialchars($_POST['simresults']);
$replay = htmlspecialchars($_POST['replay']);

$error = "";

if(empty($name)) $error .= "You must fill in a name\n";
if(empty($track)) $error .= "You must fill in a track\n";
if(empty($laps)) $error .= "You must fill in the number of laps\n";
if(empty($maxplayers)) $error .= "You must fill in the number of max players\n";
//if(empty($imagelink)) $error .= "You must fill in a image_url\n";

if(!empty($error)) error($error);

$msg = "";

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

// Take division and ruleset from season
if($season != 0) {
	$query = "SELECT division, ruleset, ruleset_qualifying FROM season s WHERE id='$season'";
	$result = mysqli_query($link,$query);
	if(!$result) error("MySQL error: " . mysqli_error($link) . "\n");
	if(mysqli_num_rows($result) == 0) error("Season does not exist\n");

	$item = mysqli_fetch_array($result);

	$division = $item['division'];
	if(!$diff_ruleset) {
		$ruleset = $item['ruleset'];
		$ruleset_qualifying = $item['ruleset_qualifying'];
	}
}

$query = "UPDATE race SET name='$name', track='$track', laps='$laps', season='$season', division='$division',
													ruleset='$ruleset', ruleset_qualifying='$ruleset_qualifying', date='$date',
													maxplayers='$maxplayers', imagelink='$imagelink', forumlink='$forumlink',
													simresults='$simresults', replay='$replay'
													WHERE id='$id'";
$result = mysqli_query($link,$query);
if(!$result) error("MySQL Error: " . mysqli_error($link) . "\n");

return_do("liga.php?page=races&season=$season", "Race succesfully modified . $msg");
?>
