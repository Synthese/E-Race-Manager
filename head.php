<?php
// Start the session
require_once ("session_start.php");
// Which page is requested?
$page = isset($_GET['page']) ? $_GET['page'] : PAGE_DEFAULT;
if ($page == PAGE_ERROR) {
    $error = $_GET['error'];
}
if (!is_file($page . ".php") || (!is_readable($page . ".php"))) {
    $error = "Page '$page' does not exist or is not readable\n";
    $page = PAGE_ERROR;
}
if (!defined("CONFIG")) {
    $error = TITLE . " is not configured\n";
    $page = "error";
}
if ($page != "error") {
    if (defined("USE_LOGIN") & defined("USER_MUST_LOGIN")) {
        // Check if user is logged in else kick to login page
        if (!isset($login)) {
            $page = "login";
        }
    }
}

// Start output
?>
<!DOCTYPE html>
<html lang="de-DE">
<head>
  <link rel="shortcut icon" type="image/x-icon" href="images/icon/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="E-Race-Manager .">
  <meta name="keywords" content="Sim Race, E-Race, manager, racing, gt-sport">
  <meta name="author" content="Synthese">
  <title><?php echo  TITLE ?> - <?php echo  $config['org'] ?></title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/modern-business.css" >
  <link rel="stylesheet" type="text/css" href="css/view.css">
  <link rel="stylesheet" type="text/css" href="fonts/css/palatino.css" >
  <link rel="stylesheet" type="text/css" href="fonts/css/opensans.css" >
  <link rel="stylesheet" type="text/css" href="fonts/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/css/font-sf.css">
  <link href="css/carousel/style.css" rel="stylesheet"  type="text/css" />


	<script src="tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	  tinymce.init({
		selector: '#tinyeditor',
		theme: 'modern',
		width: 887,
		height: 400,
		plugins: [
		  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor'
		],
		content_css: 'href="css/view.css"',
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
	  });
	</script>



	<!--[if lt IE 7]>
	<script defer type="text/javascript" src="js/pngfix.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<![endif]-->

<!-- Start Cookie Plugin -->
<script type="text/javascript">
  window.CookieHinweis_options = {
  message: 'Diese Website nutzt Cookies, um bestmögliche Funktionalität bieten zu können.',
  agree: 'Ok, verstanden',
  learnMore: 'Mehr Infos',
  link: 'datenschutz.php', 
  theme: 'hell-unten-rechts' 
 };
</script>
<script type="text/javascript" src="js/cookie.js
"></script>
<!-- Ende Cookie Plugin -->
	
	
</head>