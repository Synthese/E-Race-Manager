<?php 
if (!defined("CONFIG"))
    exit();

require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database
/* change character set to utf8 */
$link->set_charset("utf8");

	?>
<!-- Main page content-->
<!--Events-->
<!--  Füe events benötige link zum bild, dann link zum event -->
<?php 
 $event ="SELECT `id`, `name`, `image`, `groups`, `sign_up`, `game`,`platform`, `event_link` FROM events ORDER BY `id` ASC";
    $result =mysqli_query($link, $event);
    if(!$result) {
        show_error("MySQL Error: ".mysqli_error($link)."\n");
        return;
}

 ?> 
 <div>&nbsp;</div>  
<div class="container">
  <div class="card">
    <div class="card-header"><b>Veranstaltungen</b></div>
      <div class="row">
            <?php
                  while($evitem =mysqli_fetch_array($result)) {
                     $image = $evitem['image']; 
                     $name = $evitem['name'];
                     $group = $evitem['groups']; 
                     $status = $evitem['sign_up'];
                     $game = $evitem['game'];
                     $platform = $evitem['platform'];
                     $event_link = $evitem['event_link'];
                    
               ?>
        <div class="col-lg-4 text-center">
          <div class="card mt-3 bg-light">
         
          <div class="card-header"><h3 class=""><?php echo $name .'&nbsp;&nbsp;'. $group ?></b></h3></div>
           <a href="<?php echo $event_link ?>" class="card h-10">
              <img class="card" src="<?php echo $image ?>" alt="<?php echo $name ?>" width="100%" height="150px">
           <!--  <div class="carousel-caption">
              <h3><?php echo $name ?><br><?php echo $group; ?></h3>
            </div> -->
               <div class="card">
                  <div class="light">
                  <?php if($status=="online")
                      echo "<div class=\"btn btn-success\">Beitritt offen</div>" ;
                      if($status=="offline")
                          echo "<div class=\"btn btn-danger\">Beitritt geschlossen </div>";
                      if($status=="planung")
                          echo "<div class=\"btn btn-warning\">In Planung </div>";
                      ?> 
                      </a> 
                    </div>    
                </div>      
               <div class="card"><b><?php echo $group; ?></b></div>
                   <div class="card-footer"><img src="<?php echo $game ?>" width="100px">&nbsp;
                   <img src="<?php echo $platform ?>" width="20">
                   </div>
                     
              
          
 			</div>
  </div>
     <?php
                  
}
?>
    </div>
  </div>
</div>