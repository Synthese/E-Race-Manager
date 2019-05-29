<?php 

?>
<!-- Navigation -->
<div class="bg-secondary"><a class="navbar-brand" href="index.php">
<img src="images/page/header-logo.png" height="70px"></a>
    </div>	
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
     <a class="top navbar-brand" href="#"><img src="" alt=""></a> 
          
      <button class="navbar-toggler navbar-toggler-right" type="button" 
      data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" 
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item">
            <a class="nav-link current active" href="liga.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liga.php?page=calenda">Kalender</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=results">Ergebnisse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=show_circuits">Events</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Series
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="?page=result_season&season=15">Megane Cup</a>
              <a class="dropdown-item" href="?page=result_season&season=14">DTM GT3</a>
              <a class="dropdown-item" href="?page=result_season&season=16">Porsche Cup</a>
              <a class="dropdown-item" href="?page=result_season&season=00">Season</a>
              <a class="dropdown-item" href="?page=result_season&season=00">Season</a>
              <a class="dropdown-item" href="?page=result_season&season=00">Season</a>
            </div>
          </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPsy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              PsychoRacing
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPsy">
              <a class="dropdown-item" href="https://www.psycho-racing.de/">Homepage</a>
              <a class="dropdown-item" href="https://www.psycho-racing.de/infusions/forum/index.php">Forum</a>
              <a class="dropdown-item" href="https://www.psycho-racing.de/contact.php">Kontakt</a>
            </div>
          </li> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sonstiges
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="?page=driver_add_user">Fahrer hinzufügen</a>
              <a class="dropdown-item" href="?page=show_teams">Team Übersicht</a>
              <a class="dropdown-item" href="#"></a>
              <a class="dropdown-item" href="#"></a>
              <a class="dropdown-item" href="?page=show_transfer">Transfer Markt</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLive" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Live
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLive">
              <a class="dropdown-item" href="twlivestream.php">Live on Twitter</a>
              <a class="dropdown-item" href="ytlivestream.php">Live on Youtube</a>
              <a class="dropdown-item" href="#">Live on #</a>
            </div>
          </li>          
          
          
		  <li class="nav-item">
            <a class="nav-link" href="liga.php?page=show_videos">Videos</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="liga.php?page=show_drivers">Hall of Fame</a>
          </li>
    <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          
          <?php if(defined("USE_MYSQL") && defined("USE_LOGIN")) { ?>
          <?php if(!isset($login)) { ?>
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="?page=login"><img src="images/page/admin26.png" title="Admin Login" /></a>
          </li>
          
    <!-- <li class="w3-hide-small"><a href="?page=login" class="nav-link"><img src="images/admin.png" alt="Admin Login" /></a></li>-->
<?php } else { ?>
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="javascript:void(0)" class="w3-hover-white nav-link" title="Login Admin">Admin <i class="fa fa-caret-down"></i></a>
    <div class="w3-dropdown-content w3-white w3-card-4">
    <a href="?page=divisions" class="w3-hover-grey">Divisions</a>
    <a href="blanc.php?page=points" class="w3-hover-red">Punktesets</a>
    <a href="?page=seasons" class="w3-hover-red">Seasons</a>
    <a href="liga.php?page=races" class="w3-hover-red">Rennen</a>
    <a href="liga.php?page=drivers" class="w3-hover-red">Fahrer</a>
    <a href="?page=teams" class="w3-hover-red">Teams</a>
    <a href="?page=cars" class="w3-hover-red">Fahrzeuge</a>
    <a href="?page=show_rules_edit" class="w3-hover-red">Regeln</a>
    <a href="?page=events" class="w3-hover-red">Events</a>
    <a href="?page=send_video_url" class="w3-hover-red">Video eintragen</a>
    <a href="?page=main_news" class="w3-hover-red">News</a>
    <a href="?page=blocks" class="w3-hover-red">Standing</a>
    <a href="?page=upload" class="w3-hover-red">Datei hochladen</a>
    <a href="?page=users" class="w3-hover-red">Admins</a>
    <a href="?page=logout" class="w3-hover-red">Logout</a>
    </div>
  </li>
</ul>
</div>
<?php } ?>
<?php } ?>
          
      </div>
  </nav>