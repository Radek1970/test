<?php
/**
 * Admin functions MSP Helloworld plugin
 **/

   
add_action('admin_menu', 'web_anketa_ravis_setup_menu');
 
function web_anketa_ravis_setup_menu(){
      
        add_menu_page( 
        'Web Anketa',                     // Název v titulku stránky  -  zbratí se v kartě prohlížeče
        'WEB ANKETA 5',                   // Titulek v menu  -  nazev který se zobrazí v menu adminu
        'manage_options',                               // Potřebné "capability" pro úpravu  -  manage_options
        'web-anketa-ravis',               // Slug v URL adrese, musí být unikátní  -  vyobrazi-se-v-url-adrese-prohlizece
        'web_anketa_ravis_setup_menu',                  // Název funkce pro vykreslení stránky  -  inicializuje_funkci_init
        'dashicons-welcome-write-blog',   // icona urll
        50                                // pozice v menu
        ); 
           
        
     //add_menu_page('Page title', 'Top-level menu title', 'manage_options', 'my-top-level-handle', 'my_magic_function');
     //add_submenu_page( 'my-top-level-handle', 'Page title', 'Sub-menu title', 'manage_options', 'my-submenu-handle', 'my_magic_function');
        
     add_submenu_page( 'web-anketa-ravis', 'Web Anketa Administrace', 'administrace', 'manage_options', 'my-submenu-handle0', 'anketa_admin_init');   
     add_submenu_page( 'web-anketa-ravis', 'Web Anketa Nastavení',    'nastavení',    'manage_options', 'my-submenu-handle1', 'anketa_nastav_init');
     add_submenu_page( 'web-anketa-ravis', 'Web Anketa Popis',        'popis',        'manage_options', 'my-submenu-handle2', 'anketa_popis_init');

     // Add a new submenu under Settings:
     // add_options_page(__('Test Settings','menu-test'), __('Test Settings','menu-test'), 'manage_options', 'testsettings', 'mt_settings_page');

     // Add a new submenu under Tools:
     // add_management_page( __('Test Tools','menu-test'), __('Test Tools','menu-test'), 'manage_options', 'testtools', 'mt_tools_page');
       
}


                        
function anketa_admin_init(){
echo "<div class='telo'>";
// ======================================================================
// ======================================================================
 
 $logo = (WEB_ANKETA_RAVIS_BASE_URL.'assets/img/logo1.png'); 
 //echo $obr;

require_once(WEB_ANKETA_RAVIS_DIR.'includes/verze_pluginu.php'); 
echo '<h1 class="titul"> <img src="'. $logo.'" alt="" width="130px" height="29px" > Administrace pluginu WEB ANKETA 5 - RAVIS '. $verze.'</h1>';

/* *******************začátek prvniho bloku div************************* */         
echo "<div class='clearfix'>";
echo "<div class='box0'>";
//** box A
echo "<div class='box1'>";
        echo "<h2>Vytvořte novou anketu</h2>";
 //Formulař pro administraci 
 // nastavení formuláře odpovída formátu tabulky v databázi
 echo ' <form method="post" >';
 
 echo '<label >*vložte anketní otázku</label><br/>'; 
 echo '<textarea rows="3" cols="50" name="otazka" value="" class="styl-textarea" ></textarea><br/>'; 
 
 echo '<input class="input"  type="text" name="hodnocení1" value="" > '; 
 echo '<label >*hodnoceni 1</label><br/>'; 
 
 echo '<input class="input" type="text" name="hodnocení2" value=""  > '; 
 echo '<label >*hodnoceni 2</label><br/>';
 
 echo '<input class="input" type="text" name="hodnocení3" value=""> '; 
 echo '<label >hodnoceni 3</label><br/>';
 
 echo '<input class="input" type="text" name="hodnocení4" value=""> '; 
 echo '<label >hodnoceni 4</label><br/>';
 
 echo '<input class="input" type="text" name="hodnocení5" value=""> '; 
 echo '<label >hodnoceni 5</label><br/>';
 
 echo '<strong>pole označené * jsou povinná !!!</strong><br/>'; 
 echo '<input type="hidden" name="activace" value="nastav"><br/>';
 echo '<input type="hidden" name="status" value="A"><br/>';
 echo '<input type="submit" class="button"  value="vložit nový záznam">'; 
 echo '</form>';         
     
 echo '</div>';


 
//*** box B
 echo "<div class='box2'>";

 echo '<h2>Vytvořte si vlastní anketu</h2>';
 echo '<h3>například hodnocení webových stránek</h3>';
 echo '<p>vzor:</p>';
 echo '<p><strong>Jak obtížná je orientace na našich webových stránkách?</strong><br/>';
 echo '- Velmi jednoduchá <br/> - Spíše jednoduchá<br/> - Průměrná<br/> - Spíše složitá<br/>  - Velmi složitá </p>';
 echo '</div>';

      /* ******************************************** */ 
//++ is_active_widget( $callback, $widget_id, $id_base, $skip_inactive );  
$id_base =  'anketa_widget'; 
if ( is_active_widget( false, false, $id_base, true ) ) {




echo '<div class="widget-active-info-panel velke-pismo "><p>widget ankety je aktivní - (je zveřejněna min. jedna anketa)</p>';



 $obr = (WEB_ANKETA_RAVIS_BASE_URL.'assets/img/logo-small.png'); 
 //echo $obr;
 echo' <img src="'. $obr .'" alt="" width="" height="" > ';

echo '</div>';
}
else{
echo '<div class="widget-unactive-info-panel velke-pismo "><p>widget ankety není aktivní - (není zveřejněna žádná anketa)</p>' ;

 $obr = (WEB_ANKETA_RAVIS_BASE_URL.'assets/img/logo-small.png'); 
 //echo $obr;
 echo' <img src="'. $obr .'" alt="" width="" height="" > ';

echo '</div>';
}



    
     /* ******************************************** */ 
    // globani proměnná k připojení k databázi
    global $wpdb;

    // nastavení názvu tabulky dle niže napsaného vzoru s wordpress prefixem
    //$vcp_log_table = $wpdb->prefix . 'vcp_log';       
    // nazvy tabulek
    $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    $rvs_anketa_dotaz_table_nazev = $wpdb->prefix . 'rvs_anketa_dotaz';
   /* ============================================ */
   /* ============================================ */
   /* ============================================ */
 
 

/* ============== ZÁPIS DO DATABASE ============== */
/* =============================================== */
/* =============================================== */
/* =============================================== */

             /* předaná data z formulářů */       
     //===========================================//
     $ID_ANKETY = $_POST['ident_ankety'] ;
     $MAZAT_ANKETU = $_POST['activace-delet'] ;
     //echo $ID_ANKETY ;
     //echo  $MAZAT_ANKETU;
     
     $UPRAVA_ANKET_OTAZKY= $_POST['activace-update'] ;
     $UPDATE_OTAZKA = $_POST['update-otazka1'] ;
     $UPDATE_HODNOTA1 = $_POST['update-otazka2'] ;
     $UPDATE_HODNOTA2 = $_POST['update-otazka3'] ;
     $UPDATE_HODNOTA3 = $_POST['update-otazka4'] ;
     $UPDATE_HODNOTA4 = $_POST['update-otazka5'] ;
     $UPDATE_HODNOTA5 = $_POST['update-otazka6'] ;
     $UPDATE_STATUS = $_POST['stav_statusu'] ;
     
     

     $OTAZKA = $_POST['otazka'] ;
     $HODNOTA1 = $_POST['hodnocení1'] ;
     $HODNOTA2 = $_POST['hodnocení2'] ;
     $HODNOTA3 = $_POST['hodnocení3'] ;
     $HODNOTA4 = $_POST['hodnocení4'] ;
     $HODNOTA5 = $_POST['hodnocení5'] ;
    
     
     $cas = date( 'Y-m-d H:i:s');
      $STATUS = $_POST['status'] ;
     $activace = $_POST['activace'] ;
     //test
     //echo $activace ;
     echo $STATUS;
     //============================================//
     
     
          /* zápis dat z formuláře do tabulky */       
     //===========================================//
     
if ( $UPRAVA_ANKET_OTAZKY == 'activace-update' ) {


    if( (empty($UPDATE_OTAZKA)) or (empty($UPDATE_HODNOTA1)) or (empty($UPDATE_HODNOTA2)) or (empty($UPDATE_HODNOTA3)) ){ 
    $formul_info = '<div class="notice notice-error is-dismissible padding-10 velke-pismo "><p>data jsou prazdná - nebyly provedeny žádné změny'.$UPDATE_HODNOTA1.'</p></div>';
    echo '' ;}
    else{
    $formul_info = '<div class="notice notice-success is-dismissible padding-10 velke-pismo "><p>byla provedena úprava záznamu s ID : '.$ID_ANKETY.'</p></div>';
    echo '' ;
    /*
    UPDATE dbo.Platy SET Plat = 150 000 WHERE Zamestnanec = 'Jan Zedníček';
    */
    
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET OTAZKA = '$UPDATE_OTAZKA' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET HODNOTA1 = '$UPDATE_HODNOTA1' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET HODNOTA2 = '$UPDATE_HODNOTA2' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET HODNOTA3 = '$UPDATE_HODNOTA3' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET HODNOTA4 = '$UPDATE_HODNOTA4' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET HODNOTA5 = '$UPDATE_HODNOTA5' WHERE ID = '$ID_ANKETY' " );
   $wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET STATUS = '$UPDATE_STATUS' WHERE ID = '$ID_ANKETY' " );
   } 
   
  }       
     
     
     
 if ( $MAZAT_ANKETU == 'activace-delet' ) {
 
    $formul_info = '<div class="notice notice-success is-dismissible padding-10 velke-pismo "><p>bylo provedeno vymazání záznamu s ID : '.$ID_ANKETY.'</p></div>';
    echo '' ;
    // DELETE FROM [Uzivatele] WHERE [Id] = 2; 
   
    $wpdb->query("DELETE FROM $rvs_anketa_vysledky_table WHERE ID_ANKETY = '$ID_ANKETY' " );
    $wpdb->query("DELETE FROM $rvs_anketa_dotaz_table_nazev WHERE ID = '$ID_ANKETY' " );
    
  }   
    
 if ( $activace == 'nastav' ) {
           
     if ( (empty($OTAZKA)) || (empty($HODNOTA1)) || (empty($HODNOTA2))  ) {
    $formul_info = '<div class="notice notice-warning is-dismissible  padding-10 velke-pismo "><p>nejsou vyplněna povinná formulářová pole</p></div>';
    }
    else {
    // vykonání záznamu do tabulky
    $formul_info = '<div class="notice notice-info is-dismissible padding-10 velke-pismo "><p>anketní nastavení bylo uloženo</p></div>';
    echo '';
    // test 
    //echo esc_attr( $_REQUEST['page'] );  
    //$refr = esc_attr( $_REQUEST['page'] );
    //$refr = esc_attr( $_SERVER['REQUEST_URI'] ); 
    //echo '<br/><a href="admin.php?page='.$refr.'">proveďte refreshxxx'.$refr.'</a>' ; 
   
   
        
    $wpdb->insert( $rvs_anketa_dotaz_table_nazev, 
    array( 
        'ID'        => '',
        'OTAZKA'    => ''.$OTAZKA.'',
        'HODNOTA1'  => ''.$HODNOTA1.'',
        'HODNOTA2'  => ''.$HODNOTA2.'',
        'HODNOTA3'  => ''.$HODNOTA3.'',
        'HODNOTA4'  => ''.$HODNOTA4.'',
        'HODNOTA5'  => ''.$HODNOTA5.'',
        'time'      => ''.$cas.'',
        'STATUS'    => ''.$STATUS.''   
    ));
   
    } 
 
  } 
 





echo "</div>";
echo "</div>";
echo $formul_info; 
echo "<div class='after-box'></div>";

/* *******************konec prvniho bloku div************************* */
 
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================

    /*
    <div class="notice notice-error is-dismissible">
    <p>There has been an error.</p>
</div>

<div class="notice notice-warning is-dismissible">
    <p>This is a warning message.</p>
</div>

<div class="notice notice-success is-dismissible">
    <p>This is a success message.</p>
</div>

<div class="notice notice-info is-dismissible">
    <p>This is some information.</p>
</div>
    */


    
    
   
   
   
   
   
   
   
   
   
//$mylink = $wpdb->get_row( "SELECT * FROM $wpdb->users WHERE ID = ".$_POST['nastavení1']." " );
//echo $mylink->user_email; // prints "10"

  // if ( null !== $mylink ) {
  // do something with the link 
  //print("Exists - Záznam existuje");
  
//} else {
  // no link found
  //print("Doesn't exist- Záznam  neexistuje");
 
//}








 
 
   
  
  
  
/* ******************************************************************* */  
/* ******************************************************************* */
/* ******************************************************************* */
/* ******************************************************************* */
/* ***************************    TABULKY      *********************** */
/* ******************************************************************* */  
/* ******************************************************************* */
/* ******************************************************************* */

/* =============== TABULKA 1 =============== */  
// spočítá kolik je v tabulce záznamů
$anketa_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_dotaz_table_nazev" );
if($anketa_count == 0){echo '<div class="notice notice-info is-dismissible padding-10 velke-pismo "><p>Není vytvořena žádná anketa, vytvořte první anketu</p></div>';}
//jestli tabulka neobsahuje žádný záznam nebude vypsaná na obrazovku
if($anketa_count > 0){
// začátek prostoru pro vypisování tabulek    
echo '<div class="blok-table">';   

 $fivesdrafts = $wpdb->get_results( "SELECT * FROM $rvs_anketa_dotaz_table_nazev");
      
   $pocitadloradku = 1;
     
   echo '<br/><h3><u>vložené anketní otázky - stručný přehled</u></h3>';
   echo "<p>počet vytvořených anketních dotazů : {$anketa_count} </p>";
  
   echo '<table class="table" >';
   echo "<thead><tr>";
   echo "<td>Poř.</td>"; 
   echo "<td>Id</td>";
   echo "<td>Otázka</td>";
   echo "<td>Ohlasy</td>";
   echo "<td>Hodnocení</td>";
   echo "<td>Mazat</td>";
   echo '</tr></thead>';
   
   echo '<tbody>';
   foreach ( $fivesdrafts as $fivesdraft ) 
   {  
    echo "<tr>";
//**1     
    echo "<td>".$pocitadloradku."</td>"; 
//**2	
    echo "<td>".$fivesdraft->ID."</td>";
//**3 
    echo "<td>".$fivesdraft->OTAZKA."</td>";
    
    
    
    
    
     
   $id_ankety = $fivesdraft->ID;
   $hlasy_celkem_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table WHERE  ID_ANKETY ='$id_ankety' " );
   if( $hlasy_celkem_count > 0){
//**4
   echo "<td><strong>počet hlasování: {$hlasy_celkem_count}</strong></td>";  } 
   else{
   echo "<td><strong>zatím nikdo nehlasoval</strong></td>";  }

   
//**5        
   echo "<td>";
     /*
      echo "".$fivesdraft->HODNOTA1."&nbsp;&nbsp;";
       echo "".$fivesdraft->HODNOTA2."&nbsp;&nbsp;";
        echo "".$fivesdraft->HODNOTA3."&nbsp;&nbsp;";
         echo "".$fivesdraft->HODNOTA4."&nbsp;&nbsp;";
          echo "".$fivesdraft->HODNOTA5."&nbsp;&nbsp;";
            */     
          
$pocet_hodnoceni = 5;
$i = 1;
while ($i <= 5) {
//echo $i;
   
   $HODNOTA = HODNOTA.$i;
   $hodnoty = $fivesdraft->$HODNOTA;
   //echo $hodnoty;    
 if (!empty($hodnoty)) { 
 echo '<b>[ '.$hodnoty.'</b>'; 
 $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table WHERE HODNOTA = '$hodnoty' AND ID_ANKETY ='$id_ankety' " );
 if( $user_count > 0)
 {
   $procenta =  round($user_count/$hlasy_celkem_count*100);
   $delka =  round(($user_count/$hlasy_celkem_count*100)*2);
 echo "&nbsp - <small>počet hlasů {$user_count} - $procenta% </small>]<br/>  ";
 
 //echo $delka;
 //graf
 echo '<div  style="margin-left:0px; background:#CC0000; width:'.$delka.'px; height: 4px;"></div>';   
 }
 else{echo '&nbsp - <small>počet hlasů 0 </small>]<br/>';}
 }  
   
   $i++;  
 }    
   echo "</td>";
   
///**6      
   echo "<td>";
   $id_ankety = $fivesdraft->ID;
   //echo $id_ankety ;   
 echo '<form method="post" >';
 echo '<input type="hidden" name="ident_ankety" value="'.$id_ankety.'"> '; 
 echo '<input type="hidden" name="activace-delet" value="activace-delet">'; 
 echo '<input type="submit" class="button" title="nenávratně odstranit !!!" value="vymazat anketu">'; 
 echo '</form>'; 
        
   echo "</td>";   
      
      echo "</tr>";
   
   

   
   $pocitadloradku++;
   }
   echo '</tbody>';
    echo '</table>';


echo "</div>";
}
/* ================== konec ======================== */ 

// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================

/* ================== TABULKA 2 ==================== */
// spočítá kolik je v tabulce záznamů
$tabulka2_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_dotaz_table_nazev" );


//jestli tabulka neobsahuje žádný záznam nebude vypsaná na obrazovku
if($tabulka2_count > 0){
// začátek prostoru pro vypisování tabulek    
echo '<div class="blok-table">';

$arr = $wpdb->get_results("SELECT * FROM $rvs_anketa_dotaz_table_nazev");
echo ''; 
echo '<table class="table"><br/><h3>tabulka dotazů</h3><thead><tr>';
foreach ($arr[0] as $k => $v) {
    echo "<td>".$k."</td>";
}
    echo "<td>editace</td>";


echo '</tr></thead>';
echo '<tbody>';
foreach($arr as $i=>$j){
	echo "<tr>";
  echo '<form method="post" >';
  
  $poradi = '0';
	foreach ($arr[$i] as $k => $v) {
  
      if($poradi == '0'){ $id_ankety = $v;}
      if($poradi == '1'){echo '<td><textarea rows="2" cols="30" name="update-otazka'.$poradi.'" value="" class="textarea2">'.$v.'</textarea><br/></td>';  }
      else {  
           if (($poradi >= '2') and ($poradi <= '6')){
           echo '<td><input type="text" name="update-otazka'.$poradi.'" value="'.$v.'" class="input2"><br/></td>';}           
           else{     
           
           if($poradi == '8'){
           if($v == 'A'){
           echo '<td>
           <small><u>'.$v.'</u>ktivní</small><br/>
           <input type="radio" name="stav_statusu" value="A" checked="checked"><br/>
           <hr/>
           <small>Neaktivní</small><br/>
           <input type="radio" name="stav_statusu" value="N">
           </td>';}
           else{
           echo '<td>
           <small>Aktivní..</small><br/>
           <input type="radio" name="stav_statusu" value="A" ><br/>
           <hr/>
           <small><u>'.$v.'</u>eaktivní</small><br/>
           <input type="radio" name="stav_statusu" value="N" checked="checked">
           </td>';
           }
            }  
            else {echo '<td>'.$v.'</td>';
            //echo '<td>'.$v.''.$poradi.'xx</td>';
            }
            
            
           } 
           
           }
       
  $poradi++;    
	}
  
  
  
 
  
  echo '<td>';
  echo '<input type="hidden" name="ident_ankety" value="'.$id_ankety.'"> '; 
  echo '<input type="hidden" name="activace-update" value="activace-update">'; 
  echo '<input type="submit" class="button" title="opravit otázku" value="editovat">';  
  echo '</td>'; 
  
  echo '</form>';
	echo "</tr>"; 
}
echo '</tbody>';
echo '</table>';


echo "</div>";
}
/* ================== konec ======================== */ 


// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================
// ======================================================================


/* =================== TABULKA 3 =================== */
// spočítá kolik je v tabulce záznamů
$tabulka3_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table" );


//jestli tabulka neobsahuje žádný záznam nebude vypsaná na obrazovku
if($tabulka3_count > 0){
// začátek prostoru pro vypisování tabulek    
echo '<div class="blok-table">';

$arr = $wpdb->get_results("SELECT * FROM $rvs_anketa_vysledky_table  ORDER BY Time DESC LIMIT 100");
echo ''; 
echo '<table class="table"><br/><h3>tabulka výsledků</h3><p>vypíše max. 100 posledních záznamů</p><thead><tr>';
foreach ($arr[0] as $k => $v) {
    echo "<td>".$k."</td>";
}
echo '</tr></thead><tbody>';
foreach($arr as $i=>$j){
	echo "<tr>";
	foreach ($arr[$i] as $k => $v) {
	    echo "<td>".$v."</td>";
	}
  
	echo "</tr>";
}  

echo '</tbody>';
echo '</table>';

echo "</div>";
}
//doplneno - upraveno 05.2021
else{echo '<div class="blok-table"><br/><h3>v databázi není žadný záznam o výsledcích k žadné anketě</h3><p>ještě neproběhlo žádné hlasování</p></div>';}
/* ================== konec ======================== */ 





// ======================================================================
// ======================================================================
echo "</div>";
}   
?>