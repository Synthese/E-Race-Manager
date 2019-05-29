<?php
/**
 * session_start.php - Starts the session and sets constants
 * 
 * @author Bert Hekman <bert@condor.tv>
 * @copyright Copyright &copy; 2007, Condor Digital
 */

// Version information
define("TITLE", "World Car Pro Series");
define("SUBTITLE", "E Race Manager");
define("VERSION", "1.6.0 b5");

define("PAGE_DEFAULT", "main");
define("PAGE_ERROR", "error");

// Comment these if you do not need them:
define("USE_MYSQL", 1);
define("USE_LOGIN", 1);
#define("USER_MUST_LOGIN", 1);

// Include classes
if(defined("USE_LOGIN")) {
	require_once("classes/mysql_login.php");
}

// Start session
session_name("Liga");
session_cache_limiter("private, must-revalidate");
session_start();

// Include main configuration and functions
if(!is_file("config.php")) {
	die("Liga Script is not configured. Please create a config.php or copy config.php.dist to config.php for the default options\n");
}
require_once("config.php");
require_once("functions.php");

if(defined("USE_LOGIN")) {
	// Logged in?
	if(isset($_SESSION['login']) && $_SESSION['login']->is_loggedin()) {
		$login = $_SESSION['login'];
		$permissions = $login->get_data("permissions");
		$userid = $login->get_data("id");
		$username = $login->username();
	}
}
?>
