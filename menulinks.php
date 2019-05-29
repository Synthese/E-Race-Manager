<?php
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: menulinks.php
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
 * +--------------------------------------------------------
 */
include ("includes/locale/admin.inc");
?>
<div>&nbsp;</div>
<div class="container">
	<div class="card-header text-center"><b>Platzierungen</b></div>
<?php
require_once("functions.php"); // import mysql function
$link = mysqlconnect(); // call mysql function to get the link to the database

$sql_standing_pages = "SELECT sp.id, sp.page, sp.season, s.name, s.division, d.name 
FROM `standing_pages` AS sp LEFT JOIN `season` AS s ON sp.season = s.id LEFT 
JOIN `division` AS d ON d.id = s.division ORDER BY sp.page ASC";
$exe_standing_pages = mysqli_query($link,$sql_standing_pages);
if(!$exe_standing_pages) {
	error("MySQL error: " . mysqli_error($link) . "\n");
}
if(mysqli_num_rows($exe_standing_pages) > 0) {
	while(list($spID, $spPage, $spSeason, $seasonName, $divisionName, $seasonDivision_n) = 
	mysqli_fetch_array($exe_standing_pages)) {
		$standing_pages[$spID] = array(
			'page' => $spPage,
			'season' => $spSeason,
			'seasonName' => $seasonName,
            'divisionName' => $divisionName,
            'seasonDivision' => $seasonDivision_n

		);
	}
	mysqli_free_result($exe_standing_pages);
}

$sql_season_details = "SELECT `id`, `name`, `division`, `ruleset` FROM `season`";
$exe_season_details = mysqli_query($link,$sql_season_details);
while(list($seasonID, $seasonName, $seasonDivision, $seasonRuleset) = 
    mysqli_fetch_array($exe_season_details)) {
	$season[$seasonID] = array(
		'name' => $seasonName,
		'division' => $seasonDivision,
		'ruleset' => $seasonRuleset
	);
}
mysqli_free_result($exe_season_details);

$sql_point_ruleset = "SELECT pr.id, pr.rp1, pr.rp2, pr.rp3, pr.rp4, pr.rp5, pr.rp6, pr.rp7, 
pr.rp8, pr.rp9, pr.rp10, pr.rp11, pr.rp12, pr.rp13, pr.rp14, pr.rp15 FROM `point_ruleset` AS pr";
$exe_point_ruleset = mysqli_query($link,$sql_point_ruleset);
while(list($prID, $prrp1, $prrp2, $prrp3, $prrp4, $prrp5, $prrp6, $prrp7, $prrp8, $prrp9, $prrp10, 
$prrp11, $prrp12, $prrp13, $prrp14, $prrp15) = mysqli_fetch_array($exe_point_ruleset)) {
	$point_ruleset[$prID] = array(
		'rp1' => $prrp1,
		'rp2' => $prrp2,
		'rp3' => $prrp3,
		'rp4' => $prrp4,
		'rp5' => $prrp5,
		'rp6' => $prrp6,
		'rp7' => $prrp7,
		'rp8' => $prrp8,
		'rp9' => $prrp9,
		'rp10' => $prrp10,
		'rp11' => $prrp11,
		'rp12' => $prrp12,
		'rp13' => $prrp13,
		'rp14' => $prrp14,
		'rp15' => $prrp15
	);
}
mysqli_free_result($exe_point_ruleset);
?>

<!--Standing block-->

	<div class="card text-center">
		<div class="w3-responsive">
			<ul class="w3-pagination">
				<?php
					foreach ($standing_pages as $spID => $spDetails) {
				?>
				<li><a href="javascript:void(0)" class="tablink" 
				onclick="openLink(event, 'standing_<?php echo $spID;?>');" 
				title="<?php echo $spDetails['seasonName'];?>/<?php echo $spDetails['seasonDivision'];?>">
				<i class="text-center"></i><?php echo $spDetails['page'];?></a></li>
			<?php
		}
		?>
			</ul>

		<?php
		foreach ($standing_pages as $spID => $spDetails) {

		?>
		<div id="standing_<?php echo $spID;?>" class="myLink">


			<!--Team standing-->
			<div class="text-center bg-success text-white">
			 <?php echo $spDetails['seasonName'];?>
			</div>
				<div class="text-center bg-success text-white">Team Standings</div>
			<?php
			$sql_teams = "SELECT t.id, t.name FROM `team` AS t LEFT JOIN `season_team` 
AS st ON st.team = t.id WHERE st.season = ".intval($spDetails['season']);
			$exe_teams = mysqli_query($link,$sql_teams);
			while(list($teamID, $teamName) = mysqli_fetch_array($exe_teams)) {
				echo $teamName."<br/>";
			}
			mysqli_free_result($exe_teams);
			?>
			<!--Driver standing-->
			<div class="text-center bg-success text-white">Driver Standings</div>
			<?php
			$sql_drivers = "SELECT d.id did, d.name dname FROM season_team st JOIN team t ON 
(st.team = t.id) JOIN team_driver td ON (td.team = t.id) JOIN driver d ON (d.id = td.driver) 
WHERE st.season = '".intval($spDetails['season'])."' ORDER BY t.name ASC, d.name ASC";
			$exe_drivers = mysqli_query($link,$sql_drivers);
			while(list($driverID, $driverName) = mysqli_fetch_array($exe_drivers)) {
				echo $driverName."<br/>";
			}
			mysqli_free_result($exe_drivers);
			?>
			<p></p>
		</div>
		<?php
	}
	?>

	<script>
		// Team and driver Standings
		function openLink(evt, linkName) {
			var i, x, tablinks;
			x = document.getElementsByClassName("myLink");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablink");
			for (i = 0; i < x.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
			}
			document.getElementById(linkName).style.display = "block";
			evt.currentTarget.className += " w3-red";
		}
		// Click on the first tablink on load
		document.getElementsByClassName("tablink")[0].click();
	</script>

		</div>
	</div>
		<div>&nbsp;</div>
		<div class="card-header text-center"><b>Discord - Server</b></div>
	     	<div class="text-center">
			       <iframe src="https://discordapp.com/widget?id=123456789&theme=dark" <!--hier deine Discor ID rein  -->
			               width="415" height="500" allowtransparency="true" frameborder="0"></iframe>
			</div>

<div>&nbsp;</div>
  <div class="card">
	<div class="card-header text-center">Partner</div>
	<?php
$sql ="SELECT * FROM $einstellungen WHERE id=1";
$result =mysqli_query($link, $sql);
while($row =mysqli_fetch_assoc($result)) {
    $adsense_links =$row['adsense_links'];
}
echo "$adsense_links";
?>
  </div>
   <div>&nbsp;</div>

</div>