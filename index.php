<?php 
include 'head.php';
?>
  
       

  <!-- Navigation -->
     <div class="top_bild bg-secondary"><img src="images/page/header-logo.png" height="70px">
    </div>	
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="top navbar-brand text-warning" href="index.php">        
          <img src="images/logo-tes.png" width="0px" alt=""></a> 
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" 
             data-target="#navbarResponsive" aria-controls="navbarResponsive" 
                         aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item">
            <a class="nav-link current active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liga.php">Liga</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liga.php?page=calendar">Kalender</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="liga.php?page=results">Ergebnisse</a>
          </li>
        <!--  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Registrieren
            </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="http://www.gsrc-racing.de/register.php"
              target="_blanc">Registrieren</a>
           <a class="dropdown-item" href="http://www.gsrc-racing.de/infusions/forum/index.php" 
              target="_blanc">Forum</a> 
        </div>
          </li>-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Reglements
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="blog-home-1.html">Allgemeine Regeln</a>
              <a class="dropdown-item" href="blog-home-2.html">Team Regeln</a>
              <a class="dropdown-item" href="blog-post.html">Aktuelles Reglement (??? Cup)</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Forum
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="http://www.gsrc-racing.de/infusions/forum/index.php 
              target="_blanc">Registrieren</a>
              <a class="dropdown-item" href="http://www.gsrc-racing.de/infusions/forum/index.php 
              target="_blanc">Forum</a>
              <a class="dropdown-item" href="#">..</a>
              <a class="dropdown-item" href="#">...</a>
              <a class="dropdown-item" href="#">....</a>
            </div>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="liga.php?page=show_videos">Videos</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="liga.php?page=show_drivers">Hall of Fame</a>
          </li>
    <li class="nav-item">
      <a class="nav-link" href="http://www.psycho-racing.de/contact.php" target="_blanc">Contact</a>
    </li>
        </ul>
      </div>
    </div>
  </nav>
  <header>
      <div id="frontpage-content">
      <div id="intro">
        <div class="video-container">
          <!-- <video autoplay="autoplay" loop="loop" muted="muted" src="dein_video.mp4" 
          class="frontpage-video"></video> -->
          <img src="images/frontpage/gr.jpg">
          <div class="vinjette left"></div>
          <div class="vinjette right"></div>
        </div>
      </div>
    </div>
  </header>
  <!-- Page Content -->
  <div class="container">
    <h2 class="my-4"><b>Willkommen beim E-Race-Manager</b></h2>
    <div class="row"> 
    <div class="col-lg-12 mb-12">
       <div class="card h-100">
          <h4 class="card-header">Was ist der E-Race-Manager</h4>
          <div class="card-body">
            <p class="card-text">E-Race-Manager ist eine Verwaltungssoftware für Rennen und Rennligen.<br>
             Es wird dazu verwendet, um Online Rennen aus Games zu verwalten, und Veranstaltungen zu erstellen.
             Ebenfalls werden Statistiken und Übersichten der verschiedenen Bereiche erstellt. 
             Wir bieten unter diesem Link eine Demo Version von der Software an. Aktuell ist die Version 1.6.0b5 installiert.
            <a href="https://www.e-race-manager.all-webservice.de/" target="_blanc">E-Race-Manager Demo</a> an.
            Schaut Euch hier einfach mal um.<br> Dieser bereich ist im Moment Hardcodet wird aber auch geändert.
            Weiterhin benötige ich jemanden der sich mit Composer und Symphony auskennt, da habe ich noch arge Probleme mit.
            Da der weitere Weg unweigerlich an solchen Komponenten nicht vorbeiführt.</p>
          </div>
      </div>
    </div>
    </div>
    <div>&nbsp;</div>
    <!-- Marketing Icons Section -->
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
        			<a href="http://www.psycho-racing.de/infusions/faq/faq.php?cat_id=3" 
            target="_blanc"><img class="card-img-top" src="images/frontpage/main6.bmp" alt=""></a>
          <h4 class="card-header">Die Startseite</h4>
          <div class="card-body">
            <p class="card-text">Die Startseite wird als Landingpage genutzt, von hieraus gelang<br>
             man unter Liga zu dem eigentlichen Script. 
            														</p>
          </div>
          <div class="card-footer">
            <a href="#" 
            target="_blanc" class="btn btn-primary">mehr lesen</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
        		<a href="#"><img class="card-img-top" src="images/frontpage/main4.jpg" alt=""></a>
          <h4 class="card-header">Strecken</h4>
          <div class="card-body">
            <p class="card-text">Füe die Strecken kann man im Ordner images/circuits die Bilder für jede Strecke ablegen. 
            									<br>Die größe sollte der des vorgegebenen Bildes entsprechen.
            									</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">mehr lesen</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/frontpage/main5.jpg" alt=""></a>
          <h4 class="card-header">Fahrzeuge</h4>
          <div class="card-body">
            <p class="card-text">Fahrzeuge sind in der cars.php für einige Games vorgegeben, 
            jedes weiter game muss eingepflegt werden.<br>Diese werden später im Admin bereich angelegt.
            Im Rennergebnis muss dann der Sim Code des Fahrzeuges eingefügt werden</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">mehr lesen</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
  <!-- <h2>Übersicht</h2> -->

    <div class="row">
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/frontpage/main1.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Regeln usw.</a>
            </h4>
            <p class="card-text">Alle Reglements und Regeln werden über den Admin angelegt.
            Dann über den Link in das Menu eingebunden, hier werde ich noch nachbessern.</p>
          
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/frontpage/main2.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">news bereich</a>
            </h4>
         <p class="card-text">Die News sind im Moment deaktiviert und werden nach anpasungen und Änderungen<br>
          der Dateien über einen Link im oberen Menu erreichbar sein.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/frontpage/main3.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Sonstiges</a>
            </h4>
            <p class="card-text">Ich werde weiter an vielen ecken und Kanten arbeiten, Vorschläge und 
            Wünsche sowie Fehler melden kann man unter den ISSUE`S gerne machen. Wer möchte kann 
            gerne als Mitarbeiter einsteigen, und direkten Einfluss auf die weiter Entwicklung nehmen.</p>
          </div>
        </div>
      </div>

    </div> 
    <!-- /.row -->

    <!-- Features Section -->
   
    <!-- /.row -->

    <hr>
  </div>
  <!-- /.container -->

  <!-- Footer -->
<?php include "footer.php" ?>
