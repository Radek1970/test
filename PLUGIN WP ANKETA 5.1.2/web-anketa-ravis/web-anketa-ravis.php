<?php
/*
Plugin Name: WEB ANKETA 5 - RAVIS
Description: Dotazovací anketa na webové stránky až s pěti dotazy. získate zpětnou vazbu navštěvníků vašich web stránek. Zjistěte, co děláte dobře a co špatně. Snadné a rychlé použití. Začněte sbírat cenné odpovědi ještě dnes.
Version: 5.1.2
Author: R. V. Svoboda
Author URI: https://www.tvorbawebstranek.com/
Text Domain: anketa-ravis
Domain Path: /lang
*/


    /*  
    ====
    ====  PROSTOR PRO KOMENTAR
    ====  
    ====  
    ====  
    ====
    */
    
 
/* =================KROK-1===================== */
/* ============================================ */

/* Define some useful constants */
define('WEB_ANKETA_RAVIS_VERSION', '1.0');
define('WEB_ANKETA_RAVIS_DIR', plugin_dir_path(__FILE__));
define('WEB_ANKETA_RAVIS_URL', plugin_dir_url(__FILE__));
define('WEB_ANKETA_RAVIS_BASE_URL', trailingslashit( plugins_url( 'web-anketa-ravis' ) ) );

wp_enqueue_style( 'css-styl-pro-admin', WEB_ANKETA_RAVIS_BASE_URL . 'assets/css/style.css' );



/* Load files */
function web_anketa_ravis_load(){
		
    if(is_admin()) //load admin files only in admin
     
    require_once(WEB_ANKETA_RAVIS_DIR.'includes/admin.php');
        
    require_once(WEB_ANKETA_RAVIS_DIR.'includes/core.php');   
}

web_anketa_ravis_load();








/* =================KROK-2===================== */
/* ============================================ */


/* ================ WIDGET ==================== */
/* ============================================ */
/* ============================================ */
/* ============================================ */

 require_once(WEB_ANKETA_RAVIS_DIR.'public/widget_anketa.php');  
 
 


/* ============ KONEC WIDGET ================== */
/* ============================================ */
/* ============================================ */
/* ============================================ */












    /*  
    ====
    ====  PROSTOR PRO KOMENTAR
    ====  UKLADANI DAT DO TABULEK V DATABAZI
    ====  
    ====  
    ====
    */
    
    

/* =================KROK-3===================== */
/* ============================================ */







         //přenesená tada z formulaře widgetu
         $id_ankety = $_POST['id_ankety']; 
         $otazka    = $_POST['otazka'];
         $hodnota   = $_POST['hodnota'];
         $activace  = $_POST['activace'];
         // upravit format na datum bez času
         $datum     = date( 'Y-m-d H');  
         $ip        = $_SERVER['REMOTE_ADDR'];
         
    
          
          if (!empty($hodnota)) { 
          //test vypasaní hodnot které budou zapsany do tabulky
          /*
          echo $activace; 
          echo "<br/>";
          echo "<br/>";
          echo $id_ankety;
          echo "<br/>";
          echo $otazka;
          echo "<br/>";
          echo $hodnota;
          echo "<br/>";                   
          echo $datum;
          echo "<br/>";
          echo $ip;
          */
          
          global $wpdb;
          $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    // zapis do tabulky      
    $wpdb->insert( $rvs_anketa_vysledky_table, 
    array( 
        'ID'        => '',
        'ID_ANKETY' => ''.$id_ankety.'',
        'OTAZKA'    => ''.$otazka.'',
        'HODNOTA'   => ''.$hodnota.'',
        'IP'        => ''.$ip.'',
        'time'      => ''.$datum.''           
         ));
          } 
         
         

        

    /*  
    ====
    ====  PROSTOR PRO KOMENTAR
    ====  AKTIVACNI, DEAKTIVACNI A ODINSTALACNÍ FUKCE
    ====  Registrace aktivační funkce
    ====  Spustí se pokaždé, pokud plugin přejde ze stavu neaktivní na aktivní
    ====  register_activation_hook(__FILE__, 'NAZEV FUNKCE');
    ====  Activation, Deactivation and Uninstall Functions
    ====
    ====
    */



register_activation_hook(__FILE__, 'web_anketa_ravis_activation');
register_deactivation_hook(__FILE__, 'web_anketa_ravis_deactivation');


function web_anketa_ravis_activation() {
    
	  //JEDNORÁZOVÁ AKCE PŘI AKTIVACI PLUGINU DLE NÍŽE VLOŽENÝCH FUNKCÍ   
    global $wpdb;
    global $rvs_db_version;

    $rvs_anketa_dotaz_table = $wpdb->prefix . 'rvs_anketa_dotaz';
    $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    $rvs_anketa_nastaveni_table = $wpdb->prefix . 'rvs_anketa_nastaveni';
     
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


    // VYTVOŘENÍ TABULEK V DATABAZI JESTLIŽE NEEXISTUJÍ
    $sql = "
    CREATE TABLE IF NOT EXISTS $rvs_anketa_dotaz_table 
    (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `OTAZKA` varchar(200) NOT NULL,
        `HODNOTA1` varchar(200) NOT NULL,
        `HODNOTA2` varchar(200) NOT NULL,
        `HODNOTA3` varchar(200) NOT NULL,
        `HODNOTA4` varchar(200) NOT NULL,
        `HODNOTA5` varchar(200) NOT NULL,
        `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `STATUS` varchar(20) NOT NULL,
         PRIMARY KEY (`ID`)
    );";

    dbDelta( $sql );
    
    
     $sql = "
    CREATE TABLE IF NOT EXISTS $rvs_anketa_vysledky_table 
    (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `ID_ANKETY` varchar(20) NOT NULL,
        `OTAZKA` varchar(200) NOT NULL,
        `HODNOTA` varchar(200) NOT NULL,
        `IP` varchar(200) NOT NULL,
        `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (`ID`)
    );";

    dbDelta( $sql );
    
    
    $sql = "
    CREATE TABLE IF NOT EXISTS $rvs_anketa_nastaveni_table 
    (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `GRAF` varchar(200) NOT NULL,
        `POCET` varchar(200) NOT NULL,
        `POCET_CELKEM` varchar(200) NOT NULL,
        `CASLIMIT` varchar(200) NOT NULL,
        `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (`ID`)
    );";

    dbDelta( $sql );
    

    add_option( 'rvs_db_version', $rvs_db_version );  
	
    //ZAREGISTRVÁNÍ FUNKCE PRO ODINSTAACI
    register_uninstall_hook(__FILE__, 'web_anketa_ravis_uninstall');
}

function web_anketa_ravis_deactivation() {
    
	 //JEDNORÁZOVÁ AKCE PŘI DEAKTIVACI PLUGINU DLE NÍŽE VLOŽENÝCH FUNKCÍ
   
	    
}

function web_anketa_ravis_uninstall(){
    
    //JEDNORÁZOVÁ AKCE PŘI ODINSTALACI PLUGINU DLE NÍŽE VLOŽENÝCH FUNKCÍ   wp_rvs_anketa_nastaveni
    
     global $wpdb;
    $rvs_anketa_dotaz_table = $wpdb->prefix . 'rvs_anketa_dotaz';
    $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    $rvs_anketa_nastaveni_table  = $wpdb->prefix . 'rvs_anketa_nastaveni';
    
    delete_option('rvs_db_version');
    //PŘI DEAKTIVACI PLUGIN VYMAŽE TABULKY Z DATABAZE - V TESTOVNÍ NEPOUŽITO
    $wpdb->query("DROP TABLE IF EXISTS $rvs_anketa_dotaz_table");
    $wpdb->query("DROP TABLE IF EXISTS $rvs_anketa_vysledky_table");
    $wpdb->query("DROP TABLE IF EXISTS $rvs_anketa_nastaveni_table");
    
	    
}



/* *
* Add plugin text domain
* funkce pro nacitani do aktualního jazyka ze zdrojove reci ktera je nastavena na AJ
* soubor POT je ve slozce lang
* zdrojov soubor POT (anketa-ravis-en.po)
* prekladovy  soubor POT do cestiny (anketa-ravis-cs_CZ.po)
* textova domena je (anketa-ravis)
* zdrjove texty jsou zatim nacitany ze souboru (includes/core.php , includes/admin.php)
* tyto cesty jsou nastaveny v souboru (anketa-ravis-en.po) za použiti POEDIT editoru
* @since 0.8
*/
function anketa_ravis_load_textdomain(){
	load_plugin_textdomain( 'anketa-ravis', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'anketa_ravis_load_textdomain' );



?>