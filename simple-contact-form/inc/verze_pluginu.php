<?php
$logo = (KONTAKTNI_MODUL_URL.'/assets/img/logo2.png'); 
// funkce uložena c hlavním souboru
// Použití proměnné v kódu
$version = get_plugin_version();
//echo "Verze pluginu: $version"; // Můžete použít ve vašem pluginu


echo '<h1 class="titul"> <img src="'. $logo.'" alt="" width="130px" height="29px" > Administrace pluginu verze: '.$version.' RAVIS</h1>';    
    
 //require_once(WEB_ANKETA_RAVIS_DIR.'includes/verze_pluginu.php');   
    
?>