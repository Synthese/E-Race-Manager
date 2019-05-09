<?php
	$config['header'] = "Online-Sim-Race-Manager Installer";
	$config['applicationPath'] = "/";
	$config['database_file'] = "/config/database.php";
	
	// INTRODUCTION
	$introduction = array();
	$introduction["product"] = "Online Sim Race Manager";
	$introduction["productVersion"] = "1.6.0";
	$introduction["company"] = "Synthese";

	// SERVER REQUIREMENTS
	$requirements = array();
	$requirements["phpVersion"] = "5.6";
	$requirements["extensions"] = array("mysqli", "pcre");

	// FILE PERMISSIONS
	// r = readable, w = writable, x = executable
	$filePermissions = array();
	$filePermissions["/config/database.php"] = "rwx";
	$filePermissions["tmp"] = "rwx";