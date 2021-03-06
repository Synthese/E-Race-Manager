<?php 
/*
 * -------------------------------------------------------+
 * | PHP-Liga Management System E-Race_Manager
 * | Copyright (C) Synthes
 * | https://www.e-race-manager.all-webservice.de/
 * +--------------------------------------------------------+
 * | Filename: car_add.php
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
if(!defined("CONFIG")) 
	exit(); 
if(!isset($login)) { 
	show_error("Du hast keine Administratorrechte"); 
	return; 
} 
?>

<script type="text/javascript">
var
    charfield = document.getElementById('charsleft'),
    messagefield = document.getElementById('nachricht'),
    maxlength = messagefield.getAttribute('maxlength');
function showCharsLeft() {
    var charsRemaining = maxlength - messagefield.value.length;
    if(charsRemaining < 0) {
        messagefield.value = messagefield.value.substr(0, 512);
        charsRemaining = 0;
    }
    charfield.value = charsRemaining;
}
</script>
<div>&nbsp;</div>
<div class="container">
<div class="card">
<div class="card-header"><b>Fahrzeug hinzufügen</b></div>

<form action="car_add_do.php" method="post">
<table class="table table-striped">
	<tr>
	  <td width="100">Simulation:</td>
		<td>
			<select name="sim">
					<option value="gts">Gran Turismo Sport</option>
					<option value="ac">Assetto Corsa</option>
					<option value="pc2">Project Cars 2 </option>
		</select>
	  </td>
	</tr>

	<tr>
	  <td width="120">Logo:</td>
		<td>
			<select name="badge">
					<optgroup label="(images in /images/badges/)">
					</optgroup>
					<option value="" selected="selected"></option>
		  <?php
		       foreach(glob(dirname(__FILE__) . '/images/badges/*') as $filename){
		       $filename = basename($filename);
		       echo "<option value='" . $filename . "'>".$filename."</option>";
		    }
		?>
    </select>
	  </td>
	   </tr>

	<tr>
		<td width="100">Hersteller:</td>
		<td>
			<select name="brand">
				 <option value="Abarth">Abarth</option>
					<option value="Alfa Romeo">Alfa Romeo</option>
					<option value="Alpine">Alpine</option>
					<option value="Amuse">Amuse</option>
					<option value="Aston Martin">Aston Martin</option>
					<option value="Audi">Audi</option>
					<option value="BMW">BMW</option>
					<option value="Bugatti">Bugatti</option>
					<option value="Caterham">Caterham</option>
					<option value="Chaparral">Chaparral</option>
					<option value="Chevrolet">Chevrolet</option>
					<option value="Chris Holstrom Concepts">Chris Holstrom Concepts</option>
					<option value="Citroen">Citroen</option>
					<option value="Daihatsu">Daihatsu</option>
					<option value="Dodge">Dodge</option>
					<option value="Eckerts Rod & Custom">Eckerts Rod & Custom</option>
					<option value="Ferrari">Ferrari</option>
					<option value="Fiat">Fiat</option>
					<option value="Fittipaldi Motors">Fittipaldi Motors</option>
					<option value="Ford">Ford</option>
					<option value="Gran Turismo">Gran Turismo</option>
					<option value="Ginetta">Ginetta</option>
					<option value="Glickenhaus">Glickenhaus</option>
					<option value="Honda">Honda</option>
					<option value="Hyundai">Hyundai</option>
					<option value="Infiniti">Infiniti</option>
					<option value="Iso Rivolta Zagato VGT">Iso Rivolta Zagato VGT</option>
					<option value="Jaguar">Jaguar</option>
					<option value="KTM">KTM</option>
					<option value="Lamborghini">Lamborghini</option>
					<option value="Lancia">Lancia</option>
					<option value="Lexus">Lexus</option>
					<option value="Lotus">Lotus</option>
					<option value="Lotus Classic">Lotus Classic</option>
					<option value="Maserati">Maserati</option>
					<option value="Mazda">Mazda</option>
					<option value="McLaren">McLaren</option>
					<option value="Mercedes">Mercedes</option>
					<option value="Mercedes AMG">Mercedes AMG</option>
					<option value="Mercedes-Benz">Mercedes-Benz</option>
					<option value="Mini">Mini</option>
					<option value="Mini-Cooper">Mini-Cooper</option>
					<option value="Mitsubishi">Mitsubishi</option>
					<option value="Nissan">Nissan</option>
					<option value="Oreca">Oreca</option>
					<option value="Pagani">Pagani</option>
					<option value="Peugeot">Peugeot</option>
					<option value="Porsche">Porsche</option>
					<option value="Praga">Praga</option>
					<option value="Renault">Renault</option>
					<option value="Renault-Sport">Renault-Sport</option>
					<option value="RUF">RUF</option>
					<option value="Shelby">Shelby</option>
					<option value="Subaru">Subaru</option>
					<option value="Suzuki">Suzuki</option>
					<option value="Tesla Motors">Tesla Motors</option>
					<option value="Australian Supercars">Australian Supercars</option>
					<option value="Tatuus">Tatuus</option>
					<option value="Toyota">Toyota</option>
					<option value="Volkswagen">Volkswagen</option>
				</select>
		</td>
	</tr>
<tr>
	<td width="200">Fahrzeug Modell:</td>
	<td><input type="text" name="name" maxlength="30"></td>
</tr>
<tr>
	<td width="100">SimCode:</td>
	<td>
		<select name="code">
			<optgroup label="Assetto Corsa">
			<option disabled>────────────────</option>
			<option value="abarth500">abarth500</option>
			<option value="abarth500_s1">abarth500_s1</option>
			<option value="alfa_romeo_giulietta_qv">alfa_romeo_giulietta_qv</option>
			<option value="alfa_romeo_giulietta_qv_le">alfa_romeo_giulietta_qv_le</option>
			<option value="bmw_1m">bmw_1m</option>
			<option value="bmw_1m_s3">bmw_1m_s3</option>
			<option value="bmw_m3_e30">bmw_m3_e30</option>
			<option value="bmw_m3_e30_drift">bmw_m3_e30_drift</option>
			<option value="bmw_m3_e30_dtm">bmw_m3_e30_dtm</option>
			<option value="bmw_m3_e30_gra">bmw_m3_e30_gra</option>
			<option value="bmw_m3_e30_s1">bmw_m3_e30_s1</option>
			<option value="bmw_m3_e92">bmw_m3_e92</option>
			<option value="bmw_m3_e92_drift">bmw_m3_e92_drift</option>
			<option value="bmw_m3_e92_s1">bmw_m3_e92_s1</option>
			<option value="bmw_m3_gt2">bmw_m3_gt2</option>
			<option value="bmw_z4">bmw_z4</option>
			<option value="bmw_z4_drift">bmw_z4_drift</option>
			<option value="bmw_z4_gt3">bmw_z4_gt3</option>
			<option value="bmw_z4_s1">bmw_z4_s1</option>
			<option value="bo_caterham_academy_lhd">bo_caterham_academy_lhd</option>
			<option value="corvette_dp_c">corvette_dp_c</option>
			<option value="corvette_dp_d">corvette_dp_d</option>
			<option value="ferrari_312t">ferrari_312t</option>
			<option value="ferrari_458">ferrari_458</option>
			<option value="ferrari_458_gt2">ferrari_458_gt2</option>
			<option value="ferrari_458_s3">ferrari_458_s3</option>
			<option value="ferrari_599xxevo">ferrari_599xxevo</option>
			<option value="ferrari_f40">ferrari_f40</option>
			<option value="ferrari_f40_s3">ferrari_f40_s3</option>
			<option value="ferrari_laferrari">ferrari_laferrari</option>
			<option value="ks_abarth500_assetto_corse">ks_abarth500_assetto_corse</option>
			<option value="ks_abarth_595ss">ks_abarth_595ss</option>
			<option value="ks_abarth_595ss_s1">ks_abarth_595ss_s1</option>
			<option value="ks_abarth_595ss_s2">ks_abarth_595ss_s2</option>
			<option value="ks_alfa_33_stradale">ks_alfa_33_stradale</option>
			<option value="ks_alfa_giulia_qv">ks_alfa_giulia_qv</option>
			<option value="ks_alfa_mito_qv">ks_alfa_mito_qv</option>
			<option value="ks_alfa_romeo_155_v6">ks_alfa_romeo_155_v6</option>
			<option value="ks_alfa_romeo_4c">ks_alfa_romeo_4c</option>
			<option value="ks_alfa_romeo_gta">ks_alfa_romeo_gta</option>
			<option value="ks_audi_a1s1">ks_audi_a1s1</option>
			<option value="ks_audi_r18_etron_quattro">ks_audi_r18_etron_quattro</option>
			<option value="ks_audi_r8_lms">ks_audi_r8_lms</option>
			<option value="ks_audi_r8_lms_2016">ks_audi_r8_lms_2016</option>
			<option value="ks_audi_r8_plus">ks_audi_r8_plus</option>
			<option value="ks_audi_sport_quattro">ks_audi_sport_quattro</option>
			<option value="ks_audi_sport_quattro_rally">ks_audi_sport_quattro_rally</option>
			<option value="ks_audi_sport_quattro_s1">ks_audi_sport_quattro_s1</option>
			<option value="ks_audi_tt_cup">ks_audi_tt_cup</option>
			<option value="ks_audi_tt_vln">ks_audi_tt_vln</option>
			<option value="ks_bmw_m235i_racing">ks_bmw_m235i_racing</option>
			<option value="ks_bmw_m4">ks_bmw_m4</option>
			<option value="ks_bmw_m4_akrapovic">ks_bmw_m4_akrapovic</option>
			<option value="ks_corvette_c7r">ks_corvette_c7r</option>
			<option value="ks_corvette_c7_stingray">ks_corvette_c7_stingray</option>
			<option value="ks_ferrari_488_gt3">ks_ferrari_488_gt3</option>
			<option value="ks_ferrari_488_gtb">ks_ferrari_488_gtb</option>
			<option value="ks_ferrari_f138">ks_ferrari_f138</option>
			<option value="ks_ferrari_fxx_k">ks_ferrari_fxx_k</option>
			<option value="ks_ferrari_sf15t">ks_ferrari_sf15t</option>
			<option value="ks_ford_escort_mk1">ks_ford_escort_mk1</option>
			<option value="ks_ford_gt40">ks_ford_gt40</option>
			<option value="ks_ford_mustang_2015">ks_ford_mustang_2015</option>
			<option value="ks_glickenhaus_scg003">ks_glickenhaus_scg003</option>
			<option value="ks_lamborghini_aventador_sv">ks_lamborghini_aventador_sv</option>
			<option value="ks_lamborghini_countach">ks_lamborghini_countach</option>
			<option value="ks_lamborghini_countach_s1">ks_lamborghini_countach_s1</option>
			<option value="ks_lamborghini_gallardo_sl">ks_lamborghini_gallardo_sl</option>
			<option value="ks_lamborghini_gallardo_sl_s3">ks_lamborghini_gallardo_sl_s3</option>
			<option value="ks_lamborghini_huracan_gt3">ks_lamborghini_huracan_gt3</option>
			<option value="ks_lamborghini_huracan_performante">ks_lamborghini_huracan_performante</option>
			<option value="ks_lamborghini_huracan_st">ks_lamborghini_huracan_st</option>
			<option value="ks_lamborghini_miura_sv">ks_lamborghini_miura_sv</option>
			<option value="ks_lamborghini_sesto_elemento">ks_lamborghini_sesto_elemento</option>
			<option value="ks_lotus_25">ks_lotus_25</option>
			<option value="ks_lotus_3_eleven">ks_lotus_3_eleven</option>
			<option value="ks_lotus_72d">ks_lotus_72d</option>
			<option value="ks_maserati_250f_12cyl">ks_maserati_250f_12cyl</option>
			<option value="ks_maserati_250f_6cyl">ks_maserati_250f_6cyl</option>
			<option value="ks_maserati_alfieri">ks_maserati_alfieri</option>
			<option value="ks_maserati_gt_mc_gt4">ks_maserati_gt_mc_gt4</option>
			<option value="ks_maserati_levante">ks_maserati_levante</option>
			<option value="ks_maserati_mc12_gt1">ks_maserati_mc12_gt1</option>
			<option value="ks_maserati_quattroporte">ks_maserati_quattroporte</option>
			<option value="ks_mazda_787b">ks_mazda_787b</option>
			<option value="ks_mazda_miata">ks_mazda_miata</option>
			<option value="ks_mazda_mx5_cup">ks_mazda_mx5_cup</option>
			<option value="ks_mazda_mx5_nd">ks_mazda_mx5_nd</option>
			<option value="ks_mazda_rx7_spirit_r">ks_mazda_rx7_spirit_r</option>
			<option value="ks_mazda_rx7_tuned">ks_mazda_rx7_tuned</option>
			<option value="ks_mclaren_570s">ks_mclaren_570s</option>
			<option value="ks_mclaren_650_gt3">ks_mclaren_650_gt3</option>
			<option value="ks_mclaren_f1_gtr">ks_mclaren_f1_gtr</option>
			<option value="ks_mclaren_p1">ks_mclaren_p1</option>
			<option value="ks_mclaren_p1_gtr">ks_mclaren_p1_gtr</option>
			<option value="ks_mercedes_190_evo2">ks_mercedes_190_evo2</option>
			<option value="ks_mercedes_amg_gt3">ks_mercedes_amg_gt3</option>
			<option value="ks_mercedes_c9">ks_mercedes_c9</option>
			<option value="ks_nissan_370z">ks_nissan_370z</option>
			<option value="ks_nissan_gtr">ks_nissan_gtr</option>
			<option value="ks_nissan_gtr_gt3">ks_nissan_gtr_gt3</option>
			<option value="ks_nissan_skyline_r34">ks_nissan_skyline_r34</option>
			<option value="ks_pagani_huayra_bc">ks_pagani_huayra_bc</option>
			<option value="ks_porsche_718_boxster_s">ks_porsche_718_boxster_s</option>
			<option value="ks_porsche_718_boxster_s_pdk">ks_porsche_718_boxster_s_pdk</option>
			<option value="ks_porsche_718_cayman_s">ks_porsche_718_cayman_s</option>
			<option value="ks_porsche_718_spyder_rs">ks_porsche_718_spyder_rs</option>
			<option value="ks_porsche_908_lh">ks_porsche_908_lh</option>
			<option value="ks_porsche_911_carrera_rsr">ks_porsche_911_carrera_rsr</option>
			<option value="ks_porsche_911_gt1">ks_porsche_911_gt1</option>
			<option value="ks_porsche_911_gt3_cup_2017">ks_porsche_911_gt3_cup_2017</option>
			<option value="ks_porsche_911_gt3_r_2016">ks_porsche_911_gt3_r_2016</option>
			<option value="ks_porsche_911_gt3_rs">ks_porsche_911_gt3_rs</option>
			<option value="ks_porsche_911_r">ks_porsche_911_r</option>
			<option value="ks_porsche_911_rsr_2017">ks_porsche_911_rsr_2017</option>
			<option value="ks_porsche_917_30">ks_porsche_917_30</option>
			<option value="ks_porsche_917_k">ks_porsche_917_k</option>
			<option value="ks_porsche_918_spyder">ks_porsche_918_spyder</option>
			<option value="ks_porsche_919_hybrid_2015">ks_porsche_919_hybrid_2015</option>
			<option value="ks_porsche_919_hybrid_2016">ks_porsche_919_hybrid_2016</option>
			<option value="ks_porsche_935_78_moby_dick">ks_porsche_935_78_moby_dick</option>
			<option value="ks_porsche_962c_longtail">ks_porsche_962c_longtail</option>
			<option value="ks_porsche_962c_shorttail">ks_porsche_962c_shorttail</option>
			<option value="ks_porsche_991_carrera_s">ks_porsche_991_carrera_s</option>
			<option value="ks_porsche_991_turbo_s">ks_porsche_991_turbo_s</option>
			<option value="ks_porsche_cayenne">ks_porsche_cayenne</option>
			<option value="ks_porsche_cayman_gt4_clubsport">ks_porsche_cayman_gt4_clubsport</option>
			<option value="ks_porsche_cayman_gt4_std">ks_porsche_cayman_gt4_std</option>
			<option value="ks_porsche_macan">ks_porsche_macan</option>
			<option value="ks_porsche_panamera">ks_porsche_panamera</option>
			<option value="ks_praga_r1">ks_praga_r1</option>
			<option value="ks_ruf_rt12r">ks_ruf_rt12r</option>
			<option value="ks_ruf_rt12r_awd">ks_ruf_rt12r_awd</option>
			<option value="ks_toyota_ae86">ks_toyota_ae86</option>
			<option value="ks_toyota_ae86_drift">ks_toyota_ae86_drift</option>
			<option value="ks_toyota_ae86_tuned">ks_toyota_ae86_tuned</option>
			<option value="ks_toyota_celica_st185">ks_toyota_celica_st185</option>
			<option value="ks_toyota_gt86">ks_toyota_gt86</option>
			<option value="ks_toyota_supra_mkiv">ks_toyota_supra_mkiv</option>
			<option value="ks_toyota_supra_mkiv_drift">ks_toyota_supra_mkiv_drift</option>
			<option value="ks_toyota_supra_mkiv_tuned">ks_toyota_supra_mkiv_tuned</option>
			<option value="ks_toyota_ts040">ks_toyota_ts040</option>
			<option value="ktm_xbow_r">ktm_xbow_r</option>
			<option value="lmp2_porsche_rs_spyder_evo">lmp2_porsche_rs_spyder_evo</option>
			<option value="lotus_2_eleven">lotus_2_eleven</option>
			<option value="lotus_2_eleven_gt4">lotus_2_eleven_gt4</option>
			<option value="lotus_49">lotus_49</option>
			<option value="lotus_98t">lotus_98t</option>
			<option value="lotus_elise_sc">lotus_elise_sc</option>
			<option value="lotus_elise_sc_s1">lotus_elise_sc_s1</option>
			<option value="lotus_elise_sc_s2">lotus_elise_sc_s2</option>
			<option value="lotus_evora_gtc">lotus_evora_gtc</option>
			<option value="lotus_evora_gte">lotus_evora_gte</option>
			<option value="lotus_evora_gte_carbon">lotus_evora_gte_carbon</option>
			<option value="lotus_evora_gx">lotus_evora_gx</option>
			<option value="lotus_evora_s">lotus_evora_s</option>
			<option value="lotus_evora_s_s2">lotus_evora_s_s2</option>
			<option value="lotus_exige_240">lotus_exige_240</option>
			<option value="lotus_exige_240_s3">lotus_exige_240_s3</option>
			<option value="lotus_exige_s">lotus_exige_s</option>
			<option value="lotus_exige_scura">lotus_exige_scura</option>
			<option value="lotus_exige_s_roadster">lotus_exige_s_roadster</option>
			<option value="lotus_exige_v6_cup">lotus_exige_v6_cup</option>
			<option value="lotus_exos_125">lotus_exos_125</option>
			<option value="lotus_exos_125_s1">lotus_exos_125_s1</option>
			<option value="mclaren_mp412c">mclaren_mp412c</option>
			<option value="mclaren_mp412c_gt3">mclaren_mp412c_gt3</option>
			<option value="mercedes_sls">mercedes_sls</option>
			<option value="mercedes_sls_gt3">mercedes_sls_gt3</option>
			<option value="p4-5_2011">p4-5_2011</option>
			<option value="pagani_huayra">pagani_huayra</option>
			<option value="pagani_zonda_r">pagani_zonda_r</option>
			<option value="porsche_rs_spyder_evo">porsche_rs_spyder_evo</option>
			<option value="ruf_yellowbird">ruf_yellowbird</option>
			<option value="shelby_cobra_427sc">shelby_cobra_427sc</option>
			<option value="supercars_ford">supercars_ford</option>
			<option value="supercars_holden">supercars_holden</option>
			<option value="supercars_nissan">supercars_nissan</option>
			<option value="tatuusfa1">tatuusfa1</option>
<!-- /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++  */	-->		
	<optgroup label="Gran Turismo Sport">
			<option disabled>────────────────</option>
			<option value="Abarth_a1500">a1500 Biposto Bertone B.A.T 1 '52 (N100)</option>
			<option value="Abarth_500_09">500 `09 (N100)</option>
			<option value="A_R_4C_3">4C - (Gr.3)</option>
			<option value="A_R_4C_3rd">4C Gr.3 Road Car (N500)</option>
			<option value="A_R_4C_4">4C - (Gr.4)</option>
			<option value="A_R_4C_LE">4C - Launch Edition (N200)</option>
			<option value="A_R_Giulia_TZ2">GIULIA TZ2 ´65(Gr.X</option>
			<option value="A_R_mito_1_4">Mito 1.4 T Sport(N200)</option>
			<option value="Alpine_VGT">Alpine VGT(Gr.X)</option>
			<option value="Alpine_VGT_RM">Alpine VGT Race Mode(Gr.X)</option>
			<option value="Alpine_VGT_2017">Alpine VGT 2017(Gr.1)</option>
			<option value="Amuse_S200_GT1_Turbo">S2000 GT1 Turbo(N600)</option>
			<option value="Aston_Vulcan">Aston Martin Vulcan(Gr.X)</option>
			<option value="Aston_DP_100 VGT">Aston Martin DP-100 VGT(Gr:X)</option>
			<option value="Aston_DB3S">Aston Martin DB3S CN.1 ´53(Gr.X)</option>
			<option value="Aston_one77">Aston Martin One-77(N800)</option>
			<option value="Aston_V12_Vantage">Aston Martin V12 Vantage(Gr.3)</option>
			<option value="Aston_V8">Aston Martin V8 Vantage S(N400)</option>
			<option value="Aston_Vantage">Aston Martin Vantage (Gr.4)</option>
			<option value="Aston_DB11">Aston marint DB11 ´16(N600)</option>
			<option value="Audi_R8_LMS">Audi R8 LMS(Gr.3)</option>
			<option value="Audi_R18_TDI">Audi R18 TDI(Gr.1)</option>
			<option value="Audi_S1">Audi Sport quattro S1 Pikes Peak(Gr.B)</option>
			<option value="Audi_VGT_gr.1">Audi VGT (Gr.1)</option>
			<option value="Audi_R18">Audi R18(Gr.1)</option>
			<option value="Audi_etron_VGT">Audi E-Tron VGT(Gr.X)</option>
			<option value="Audi_TT_Cup">Audi TT Cup(Gr.4)</option>
			<option value="Audi_TT_Coupe">Audi TT Coupé 3.2 quattro '03(N200)</option>
			<option value="Audi_TTS_Coupe">Audi TTS Coupé(N300)</option>
			<option value="BMW_M3">BMW M3 Sport Evolution ´89(N200)</option>
			<option value="BMW_i3">BMW i3 (N200)</option>
			<option value="BMW_M3_GT">BMW M3 GT (BMW Motorsport) ‘11 (Gr.3)</option>
			<option value="BMW_M4">BMW M4 (Gr.4)</option>
			<option value="BMW_M4_coupe">BMW M4 Coupé (N400)</option>
			<option value="BMW_M4_Safety">BMW M4 Safety Car (Gr.X)</option>
			<option value="BMW_M6_GT3">BMW M6 GT3 (Gr.3)</option>
			<option value="BMW_M6_GT3_PL">BMW M6 GT3 Power Livery (Gr.3)</option>
			<option value="BMW_VGT">BMW VGT (Gr.X)</option>
			<option value="BMW_Z4">BMW Z4 GT3 (Gr.3)</option>
			<option value="BMW_Z8">BMW Z8 ´01 (N400)</option>
			<option value="Bugatti_VGT">Bugatti VGT (Gr.X / Gr.1)</option>
			<option value="Bugatti_gr.4">Bugatti Veyron (Gr.4)</option>
			<option value="Bugatti_Veyron_16">Bugatti Veyron 16.4 (N1000)</option>
			<option value="Chaparral">Chevrolet Chaparral 2X VGT (Gr.X)</option>
			<option value="Chevrolet_camaro">Camaro SS (N500)</option>
			<option value="Chevrolet_C7_3">Corvet C7 (Gr.3)</option>
			<option value="Chevrolet_C7_4">Corvet C7 (Gr.4)</option>
			<option value="Chevrolet_C7_3_RDC">Corvet C7 Gr.3 Road Car(N500)</option>
			<option value="Chevrolet">Corvet Stingray (C7) (N500)</option>
			<option value="Chevrolet">Chevrolet Stingray Convertible (C3) (N300)</option>
			<option value="Chris_Holstrom">Chris Holstrom Concepts 1967 Chevy Nova (N700)</option>
			<option value="Citroen_DS3">Citroen DS3 Racing (N200)</option>
			<option value="Citroen_GT_4">GT Citroen (Gr.4)</option>
			<option value="Citroen_GT_3">GT Citroen Race Car (Gr.3)</option>
			<option value="Citroen_GT_RoadCar">GT Citroen Road Car (N500)</option>
			<option value="Daihatsu_Copen">Daihatsu Copen Active Top '02 (N100)</option>
			<option value="Dodge_Charger">Dodge Charger SRT Hellcat (N700)</option>
			<option value="Dodge_SRT_GTS">Dodge SRT Tomahawk GTS-R VGT (Gr.X)</option>
			<option value="Dodge_SRT_S">Dodge SRT Tomahawk S VGT (Gr.X)</option>
			<option value="Dodge_SRT_GR1">Dodge SRT Tomahawk (Gr.1)</option>
			<option value="Dodge_SRT_X">Dodge SRT Tomahawk X (Gr.X)</option>
			<option value="Dodge_Viper">Dodge Viper (Gr.4)</option>
			<option value="Dodge_Viper_GTS">Dodge Viper GTS (N600)</option>
			<option value="Dodge_Viper_GTS02">Dodge Viper GTS ´02 (N500)</option>
			<option value="Dodge_ViperSRT_GT3">Dodge Viper SRT GT3-R (Gr.3)</option>
			<option value="Dodge_ViperSRT_10">Dodge Viper SRT10 Coupe ‘06 (N500)</option>
			<option value="Eckerts Rod & Custom">Mach Forty (N800)</option>
			<option value="Ferrari_Dino">Ferrari Dino 246 GT ‘71(N200)</option>
			<option value="Ferrari_F40">Ferrari F40(N500)</option>
			<option value="Ferrari_330">Ferrari 330 P4 '67 (Gr.X)</option>
			<option value="Ferrari_250_GTO">Ferrari 250 GTO CN.3729GT `62 (Gr.X)</option>
			<option value="Ferrari_458">Ferrari 458 Italia (N600)</option>
			<option value="Ferrari_458_GT3">Ferrari 458 Italia GT3 (Gr.3)</option>
			<option value="Ferrari_458_gr4">Ferrari 458 Italia (Gr.4)</option>
			<option value="Ferrari_512BB">Ferrari 512BB '76 (N400)</option>
			<option value="Ferrari_GTO84">GTO '84 (N400)</option>
			<option value="Ferrari_LaFerrari">La Ferrari (N1000)</option>
			<option value="Ferrari_ENZO">Enzo Ferrari (N700)</option>
			<option value="Fiat_500">Fiat 500 ´68 (N100)</option>
			<option value="Fittipaldi_Motors">Fittipaldi EF7 VGT / Pininfarina (Gr.X)</option>
			<option value="Ford_Focus">Focus Rally Car (Gr.B)</option>
			<option value="Ford_GT40_MarkI">GT40 Mark I '66 (N400)</option>
			<option value="GT_Spec_II_Test_Car">GT Spec II Test Car (Gr.3)</option>
			<option value="Ford_GT_06">Ford GT ´06 (N600)</option>
			<option value="Ford_focus_ST">Ford Focus ST (N300)</option>
			<option value="Ford_F150">Ford F-150 SVT Raptor (N400)</option>
			<option value="Ford_Mark_IV">Mark IV Race Car '67 (Gr.X)</option>
			<option value="Ford_Mustang_gr3">Mustang (Gr.3)</option>
			<option value="Ford_mustang_gr3_road_car">Mustang Gr.3 Road Car(N500)</option>
			<option value="Ford_Mustang_gr4">Mustang (Gr.4)</option>
			<option value="Ford_mustang_grB">Mustang Rally Car (Gr.B)</option>
			<option value="Ford_mustang_gt_fastback">Mustang GT Premium Fastback (N400)</option>
			<option value="GT_Red_Bull_Junior">Red Bull X2014 Junior´14 (Gr.X)</option>
			<option value="GT_Racing_Kart">GT Racing Kart 125 Shifter (Gr.X)</option>
			<option value="GT_Red_Bull_x2014">Red Bull X2014 Standard (Gr.X)</option>
			<option value="Honda_beat">Beat `91 (N100)</option>
			<option value="Honda_Epson_NSX">EPSON NSX ’08 (Gr.2)</option>
			<option value="Honda_Fit_Hybrid">Fit Hybrid '14(N100)</option>
			<option value="Honda_Integra">Integra Type R (DC2) ‘98(N200)</option>
			<option value="Honda_Raybrig_NSX">Raybrig NSX Concept-GT '16(Gr.2)</option>
			<option value="Honda_NSX">NSX (N600)</option>
			<option value="Honda_NSX_Gr.3">NSX (Gr.3)</option>
			<option value="Honda_NSX_Gr.4">NSX (Gr.4)</option>
			<option value="Honda_NSX_gr.B">NSX Rally Car (Gr.B)</option>
			<option value="Honda_NSX_type_R">NSX Type R ‘92 (N300)</option>
			<option value="Honda_Civic_Type_R">Civic Type R (FK2) (N300)</option>
			<option value="Honda_Project_2&4">Honda Project 2&4 by RC213V (Gr.X)</option>
			<option value="Honda_S660_15">S660 `15 (N100)</option>
			<option value="Hyundai_Genesis_3.8">Genesis Coupe 3.8 Track(N300)</option>
			<option value="Hyundai_Genesis_gr.3">Genesis (Gr.3)</option>
			<option value="Hyundai_genesis_gr.4">Genesis (Gr.4)</option>
			<option value="Hyundai_Genesis_gr.b">Genesis Rally Car (Gr.B)</option>
			<option value="Hyundai_N_2025">Hyundai N 2025 VGT (Gr.X / Gr.1)</option>
			<option value="infiniti_Concept_VGT">Infiniti Concept VGT (Gr.X)</option>
			<option value="Iso_Rivolta_Zagato">Iso Rivolta Zagato VGT</option>
			<option value="Jaguar_xj13">Jaguar Xj13 '66 (Gr.X)</option>
			<option value="Jaguar_E_Type">E-type Coupé '61 (N300)</option>
			<option value="Jaguar_F_Type_gr3">F-type (Gr.3)</option>
			<option value="Jaguar_F_Type_gr4">F-type (Gr.4)</option>
			<option value="Jaguar_F_Type_R">F-type R Coupé (N500)</option>
			<option value="Jaguar_XJR_9">XJR-9 '88 (Gr.1)</option>
			<option value="KTM_X_Bow">KTM X-Bow R (N300)</option>
			<option value="Lamborghini_huracan_GT3">Huracan GT3 (Gr.3)</option>
			<option value="Lamborghini_Huracan_gr4">Huracan (Gr.4)</option>
			<option value="Lamborghini_Huracan_LP610">Huracan LP 610-4(N600)</option>
			<option value="Lamborghini_Diablo">Lamborghini Diablo GT '00 (N600)</option>
			<option value="Lamborghini_Miura">Miura P400 Bertone Prototype CN.0706 '67 (N400)</option>
			<option value="Lamborghini_Veneno">Veneno (N800)</option>
			<option value="Lamborghini_LP400">Lamborghini Countach LP400 (N400)</option>
			<option value="Lancia_Delta_HF">DELTA HF Integrale Evoluzione '91(N200)</option>
			<option value="Lexus_LC_500">LC500 (N500)</option>
			<option value="Lexus_Tom">Lexus au TOM'S RC F '16 (Gr.2)</option>
			<option value="Lexus_LF_LC">LF-LC GT VGT (Gr.X)</option>
			<option value="Lexus_SC430">PETRONAS TOM'S SC430 ’08(Gr.2)</option>
			<option value="Lexus_RC_GT3">RC F GT3 (Emil Frey Racing) '17 (Gr.3)</option>
			<option value="Lexus_RC_F">RC F (N500)</option>
			<option value="Lexus_RC_F_gr4">RC F (Gr.4)</option>
			<option value="Lexus_RC_F_gt3">RC F GT3 prototype (Emil Frey Racing)(Gr.3)</option>
			<option value="Mc_laren_F1">McLaren F1 '94 (N600)</option>
			<option value="Mc_laren_650S">650S Coupe (N700)</option>
			<option value="Mc_laren_650_GT3">650S GT3 (Gr.3)</option>
			<option value="Mc_laren_650_gr4">650S (Gr.4)</option>
			<option value="Mc_laren_MP4">MP4-12C (N600)</option>
			<option value="Mc_laren_F1_GTR">F1 GTR – BMW (Kokusai Kaihatsu UK Racing) ‘95 (Gr.3)</option>
			<option value="Mc_laren_Ultimate_VGT">McLaren Ultimate VGT (Gr.X / Gr.1)</option>
			<option value="Maserati_GT_S_08">GranTurismo S '08 (N400)</option>
			<option value="Mazda_787B">787B `91 (Gr.1)</option>
			<option value="Mazda_Atenza_gr4">Atenza (Gr.4)</option>
			<option value="Mazda_Atenza_sedan">Atenza Sedan XD L Package(N200)</option>
			<option value="Mazda_Eunos">Eunos Roadster (NA Special Package) ‘89(N200)</option>
			<option value="Mazda_RX7">RX-7 GT-X (FC) '90 (N200)</option>
			<option value="Mazda_RX500">RX500 ‘70 (N300)</option>
			<option value="Mazda_LM55">LM 55 Vision Gran Turismo (Gr.X / Gr.1)</option>
			<option value="Mazda_Roadster_S">Roadster S (ND) (N100)</option>
			<option value="Mazda_Atenza_gr4">Atenza (Gr.4)</option>
			<option value="Mazda_Atenza_road_gr3">Atenza Gr.3 Road Car (N500)</option>
			<option value="Mazda_RX7_spirit">Mazda RX-7 Spirit R Type A (N300)</option>
			<option value="Mercedes_AMG">F1 W08 EQ Power+ 2017 (Gr.X)</option>
			<option value="Mercedes_Benz_A_45">A 45 AMG 4MATIC (N400)</option>
			<option value="Mercedes_Benz_GT_S">Mercedes-AMG GT S (N500)</option>
			<option value="Mercedes_Benz_GT_Safety">Mercedes-AMG GT Safety Car (Gr.X)</option>
			<option value="Mercedes_Benz_GT3">Mercedes-AMG GT3 (Gr.3)</option>
			<option value="Mercedes_Benz_AMG_VGT">Mercedes-Benz AMG VGT (Gr.X)</option>
			<option value="Mercedes_Benz_AMG_VGT_RS">Mercedes-Benz AMG VGT RS (Gr.X)</option>
			<option value="Mercedes_Benz_C9">Sauber Mercedes C9 '89 (Gr.X)</option>
			<option value="Mercedes_Benz_SLR">SLR McLaren ‘09 (N600)</option>
			<option value="Mercedes_Benz_SLS_AMG">SLS AMG (N600)</option>
			<option value="Mercedes_Benz_SLS_AMG_Gr4">SLS AMG (Gr.4)</option>
			<option value="Mercedes_Benz_SLS_AMG_Gr3">SLS AMG GT3 (Gr.3)</option>
			<option value="Mini_clubman">MINI Clubman VGT(Gr.X)</option>
			<option value="Mini_Cooper_S05">S'05 (N200)</option>
			<option value="Mini_Cooper_S65">S'65 (N100)</option>
			<option value="Mitsubishi_XR">Concept XR-PHEV EVOLUTION VGT (Gr.X)</option>
			<option value="Mitsubishi_FE">Lancer Evolution Final Edition (N300)</option>
			<option value="Mitsubishi_Evo_gr3">Lancer Evolution Final Edition (Gr.3)</option>
			<option value="Mitsubishi_Evo_gr4">Lancer Evolution Final Edition (Gr.4)</option>
			<option value="Mitsubishi_Evo_grB">Lancer Evolution Final Edition Rally Car(Gr.B)</option>
			<option value="Mitsubishi_Evo_Road">Lancer Evolution Final Edition B Road Car (N500)</option>
			<option value="Mitsubishi_Evo_IV">Lancer Evolution IV GSR '96 (N300)</option>
			<option value="Nissan_Z_300_ZX">Fairlady Z 300ZX TwinTurbo (N300)</option>
			<option value="Nissan_Z_33">Fairlady Z Version S (Z33) ‘07 (N300)</option>
			<option value="Nissan_GTR_gr4">GT-R (Gr.4)</option>
			<option value="Nissan_GTR_grB">GT-R Rally Car(Gr.B)</option>
			<option value="Nissan_GTR_Nismo">GT-R Nismo '17 (N600)</option>
			<option value="Nissan_GTR_gr3">GT-R NISMO GT3 N24 Schulze Motorsport (Gr.3)</option>
			<option value="Nissan_GTR_Prem">GT-R Premium edition (N600)</option>
			<option value="Nissan_GTR_Safety">GT-R Safety Car (Gr.X)</option>
			<option value="Nissan_Motul_GTR">MOTUL AUTECH GT-R '16 (Gr.2)</option>
			<option value="Nissan_Concept_2020">NISSAN CONCEPT 2020 VGT (Gr.X)</option>
			<option value="Nissan_Skyline_GTR_V_spec">Nissan Skyline GT-R V spec II Nür</option>
			<option value="Nissan_Skyline_GTR_V">Nissan Skyline GT-R V</option>
			<option value="Nissan_GTR_LM">Nissan GT-R LM NISMO (Gr.1)</option>
			<option value="Nissan_R92CP">R92CP '92 (Gr.1)</option>
			<option value="Nissan_Skyline_GTR">Skyline GT-R V - spec (R33) '97(N300)</option>
			<option value="Nissan_Nismo_GTR">XANAVI NISMO GT-R ’08 (Gr.2)</option>
			<option value="Pagani_huayra">Huayra ‘13 (N700)</option>
			<option value="Pagani_zonda_R">Zonda R ’09 (Gr.X)</option>
			<option value="Peugeot_RCZ_gr3">RCZ (Gr.3)</option>
			<option value="Peugeot_RCZ_gr4">RCZ (Gr.4)</option>
			<option value="Peugeot_RCZ_grB">RCZ Rally Car (Gr.B)</option>
			<option value="Peugeot_RCZ_GT">RCZ GT Line (N200)</option>
			<option value="Peugeot_RCZ_gr3">RCZ Gr.3 Road Car (N500)</option>
			<option value="Peugeot_208">Peugeot 208 Gti By Peugeot Sport (N200)</option>
			<option value="Peugeot_908">Peugeot 908 Hdi FAP – Team Peugeot Total (Gr.1)</option>
			<option value="Peugeot_VGT">PEUGEOT Vision Gran Turismo(Gr.1)</option>
			<option value="Peugeot_Vision_VGT">PEUGEOT Vision Gran Turismo (Gr.3)</option>
			<option value="Plymouth_XNR">XNR Ghia Roadster ‘60 (N300)</option>
			<option value="Porsche_356_A">356 A/1500 GS GT Carrera Speedster ‘56 (N100)</option>
			<option value="Porsche_911_GT3_996">911 GT3 (996) ‘01 (N400)</option>
			<option value="Porsche_911_GT3_997">911 GT3 (997) ‘08 (N400)</option>
			<option value="Porsche_911_GT3_RS">911 GT3 RS (991) (N500)</option>
			<option value="Porsche_911_RSR">911 RSR (991) (Gr.3)</option>
			<option value="Porsche_962">962 C ’88 (Gr.1)</option>
			<option value="Porsche_Cayman">Cayman GT4 Clubsport (Gr.4)</option>
			<option value="Porsche_919">Porsche 919 Hybrid (Porsche Team)(Gr.1)</option>
			<option value="Renault_R8">R8 Gordini ’66 (Gr.X)</option>
			<option value="Renault_Sport_clio_RS_220">Clio R.S. 220 EDC Trophy (N200)</option>
			<option value="Renault_Sport_Clio_rs_16">Clio R.S. 220 EDC Trophy '16(N200)</option>
			<option value="Renault_Sport_megane_gr4">Mégane (Gr.4)</option>
			<option value="Renault_Sport_Megane">Mégane Trophy '11(Gr.4)</option>
			<option value="Renault_Sport_RS_trophy">Mégane R.S. Trophy (Gr.3)</option>
			<option value="Renault_Sport_RS01">R.S.01 (Gr.X)</option>
			<option value="Renault_Sport_RS_gr3">R.S.01 GT3 (Gr.3)</option>
			<option value="Shelby_Daytona">Cobra Daytona Coupe '64 (Gr.X)</option>
			<option value="Shelby_GT_350">G.T.350 ‘65 (N300)</option>
			<option value="Shelby_Cobra">Shelby Cobra</option>
			<option value="Subaru_BRZ_S">BRZ S '15 (N200)</option>
			<option value="Subaru_Impreza">Impreza 22B-STi Version '98 (N300)</option>
			<option value="Subaru_VIZIV">SUBARU VIZIV GT VGT (Gr.X)</option>
			<option value="Subaru_WRX_gr3">WRX (Gr.3)</option>
			<option value="Subaru_WRX_gr4">WRX (Gr.4)</option>
			<option value="Subaru_WRX_grB">WRX Rally Car (Gr.B)</option>
			<option value="Subaru_WRX_Road">WRX Gr.B Road Car (N500)</option>
			<option value="Subaru_WRX_S">WRX STI Type S (N300)</option>
			<option value="Suzuki_Swift">Suzuki Swift Sport(N100)</option>
			<option value="Tesla_Motors_S">Model S Signature Performance '12 (Gr.X)</option>
			<option value="Toyota_86_GRMN">86 GRMN (N200)</option>
			<option value="Toyota_GR_2018">GR SUPRA RACING CONCEPT 2018 (Gr.3)</option>
			<option value="Toyota_Supra_RZ_19">GR Supra RZ ‘19 (N300)</option>
			<option value="Toyota_2000_GT">2000GT '67 (N200)</option>
			<option value="Toyota_86_gr4">86 (Gr.4)</option>
			<option value="Toyota_86_GrB">86 Rally Car (Gr.B)</option>
			<option value="Toyota_86_GT">86 GT (N200)</option>
			<option value="Toyota_FT_1">FT-1 (Gr.X)</option>
			<option value="Toyota_FT1_VGT">FT-1 VGT (Gr.X)</option>
			<option value="Toyota_FT1_VGT_gr3">FT-1 VGT(Gr.3)</option>
			<option value="Toyota_S_FR">S-FR (N100)</option>
			<option value="Toyota_S_FR_racing">S-FR Racing Concept (N400)</option>
			<option value="Toyota_Trueno">Sprinter Trueno 3door 1600GT APEX (AE86) '83 (N100)</option>
			<option value="Toyota_Supra_RZ">Supra RZ '97 (N300)</option>
			<option value="Toyota_TS_050">TS050 – Hybrid (Gazoo Racing)(Gr.1)</option>
			<option value="Toyota_TS_030">TS030 Hybrid (Gr.1)</option>
			<option value="VW_beetle_gr3">1200 ´66 (N100)</option>
			<option value="VW_beetle_gr3">GTI Roadster VGT (Gr.X)</option>
			<option value="VW_beetle_gr3">GTI Supersport VGT (Gr.X)</option>
			<option value="VW_beetle_gr3">GTI VGT (Gr.3)</option>
			<option value="VW_beetle_gr3">Samba Bus Type2 (N100)</option>
			<option value="VW_beetle_gr3">Golf VII GTI (N200)</option>
			<option value="VW_beetle_gr3">Scirocco (Gr.4)</option>
			<option value="VW_beetle_gr3">Beetle (Gr.3)</option>
	</optgroup>
		<optgroup label="Project Cars 2">
			<option disabled>────────────────</option>
		</optgroup>
		<optgroup label="..">
			<option disabled>────────────────</option>
		</optgroup>
	</select>
	</td>
</tr>
<!-- 
<tr><td>Leistung</td>
  <td><input type="text" name="horsepower" value= "<?php echo $horsepower;?>" size="20" maxlength="20"></td></tr>
<tr><td>Drehmoment:</td>
  <td><input type="text" name="torque" value= "<?php echo $torque;?>" min=1 max="9999"></td></tr>
<tr><td>Gewicht:</td>
  <td><input type="text" name="weight" value= "<?php echo $weight;?>" min=1 max="9999"></td></tr>
<tr>
-->
	<td width="120">Beschreibung:</td>
	<td><textarea maxlength="2048" id="nachricht" onchange="showCharsLeft()"
		 						onkeyup="showCharsLeft()" name="description"
		 						cols="60" rows="10" onfocus="if (this.value === 'Type Description, max. 2048 characters') { this.value = ''; }"
                >Beschreibung, max. 2048 </textarea></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" class="btn btn-success" value="hinzufügen">
    <input type="button" class="btn btn-danger" value="Abbrechen" onclick="history.go(-1);">
	</td>
</tr>
</table>
</form>
</div>
</div>