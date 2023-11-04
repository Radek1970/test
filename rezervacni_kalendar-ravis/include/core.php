<?php
/**
 * Main functionality
 **/



function anketa_nastav_init(){
echo "<div class='telo'>";
// ======================================================================
// ======================================================================
 



  
  require_once(WEB_ANKETA_RAVIS_DIR.'includes/verze_pluginu.php'); 
 
  echo '<h1 class="titul"> <img src="'. $logo.'" alt="" width="130px" height="29px" > Nastavení pluginu WEB ANKETA 5 - RAVIS '. $verze.'</h1>';

/* *******************začátek bloku div************************* */         
echo "<div class='clearfix'>";
echo "<div class='box0'>";
echo "<div class='box00'>";
echo "<h2>";
echo _e('Settings', 'default'); 
echo " WEB ANKETA 5</h2>";   


        
    /* ******************************************** */ 
    // globani proměnná k připojení k databázi
    global $wpdb;
    // nayev tabulkz s prefixem
    $rvs_anketa_nastaveni_table = $wpdb->prefix . 'rvs_anketa_nastaveni';
    
    $anketa_nastaveni_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_nastaveni_table " );
    // test dotazu
    if($anketa_nastaveni_count == 0){
    echo '<strong>'; 
    _e( 'Base settings.', 'anketa-ravis' );
    echo '</strong><br/><br/><br/>';}
    
    if($anketa_nastaveni_count >= 1){
    echo '<strong>';  
    _e( 'User settings.', 'anketa-ravis' );
    echo '</strong><br/><br/>';}  
      
    
    // tabulka ma 6 sloupcu
    // zjistime cislo ID
    $arr = $wpdb->get_results("SELECT * FROM $rvs_anketa_nastaveni_table");
    $pp = '0';
    if( !empty ($arr)){
    foreach ($arr[0] as $k => $v) {
    // dosazeni promene do promene
    ${"ident_id_pozice_". $pp }  =  $v;
    $pp++;
    }
    }
    //echo $ident_id_pozice_0 ;
    $cislo_id = $ident_id_pozice_0;
    
    /* ******************************************** */ 
    /* předaná data z formulářů */       
    //===========================================//
    $cas = date( 'Y-m-d H:i:s');
    $action = $_POST['action'];
    $update_graf = $_POST['update_graf'];
  
    $update_pocet = $_POST['update_pocet']; 
    $update_pocet_celkem = $_POST['update_pocet_celkem'];
    $update_limit = $_POST['update_limit'];
    
    
    
     
     //test
     //echo $update_graf ;
     //echo  $action;  
     if( $action == 'update_snastaveni'){
     
     if($anketa_nastaveni_count >= 1){
     echo '<br/><div class="notice notice-error is-dismissible padding-10 velke-pismo "><p>';
       _e( 'The required setting has been made.', 'anketa-ravis' );
     echo '</p></div><br/><br/>';
     //echo 'ok povolena uprava';
     $wpdb->query("UPDATE $rvs_anketa_nastaveni_table SET GRAF         = '$update_graf'         WHERE ID = '$cislo_id' " );
     $wpdb->query("UPDATE $rvs_anketa_nastaveni_table SET POCET        = '$update_pocet'        WHERE ID = '$cislo_id' " );
     $wpdb->query("UPDATE $rvs_anketa_nastaveni_table SET POCET_CELKEM = '$update_pocet_celkem' WHERE ID = '$cislo_id' " );
     $wpdb->query("UPDATE $rvs_anketa_nastaveni_table SET CASLIMIT     = '$update_limit'        WHERE ID = '$cislo_id' " );
     
     $wpdb->query("UPDATE $rvs_anketa_nastaveni_table SET Time = '$cas'         WHERE ID = '$cislo_id' " );
     
     }
     else{
       // zapis do tabulky      
     $wpdb->insert( $rvs_anketa_nastaveni_table, 
     array( 
        'ID'             => '',
        'GRAF'           => ''.$update_graf.'',
        'POCET'          => '',
        'POCET_CELKEM'   => '',
        'CASLIMIT'       => '',
        'Time'           => ''.$cas.''           
         ));
          }     
     }
     //===========================================//


    
    
    
    


      /* ******************************************** */ 
      /* ******************************************** */ 
      /* ******************************************** */ 
      // tabulka ma 6 sloupcu
      // zjistime obsah promenne  a nacitame do formulare
      $arr = $wpdb->get_results("SELECT * FROM $rvs_anketa_nastaveni_table");
      $pp = '0';
      if( !empty ($arr)){
      foreach ($arr[0] as $k => $v) {
      // dosazeni promene do promene
      ${"id_pozice_". $pp }  =  $v;
      $pp++;
      }
      }
      $graf         = $id_pozice_1;
      $pocet        = $id_pozice_2;
      $pocet_celkem = $id_pozice_3;
      $caslimit     = $id_pozice_4;
        
      //test
      //echo 'xxxxxx'.$graf.'xxxxxxxxxx';
      /* ******************************************** */ 
      /* ******************************************** */ 
      /* ******************************************** */ 
    

  ?>
  
   
  <form method="post" action="admin.php?page=my-submenu-handle1" >
   
    
    
    
<label>
<input name="update_graf" type="checkbox" id="update_graf" value="ne"  <?php if (( $graf  == 'ne' ) or ($update_graf == 'ne')) echo 'checked="checked"'; ?>><?php _e( 'Do not show a graph.', 'anketa-ravis' ); ?></label>
<p class="description"><?php _e( 'Do not show a graphic line in the survey.', 'anketa-ravis' ); ?></p>
<br/>
    
<label><input name="update_pocet" type="checkbox" id="update_pocet" value="ano"  <?php if (( $pocet == 'ano' ) or ($update_pocet == 'ano')) echo 'checked="checked"'; ?>><?php _e( 'Show votes in counts.', 'anketa-ravis' ); ?></label>
<p class="description"><?php _e( 'In the poll show the vote of the individual answers in the number of voters.', 'anketa-ravis' ); ?></p>   
<br/>

<label><input name="update_pocet_celkem" type="checkbox" id="ano" value="ano" <?php if (( $pocet_celkem == 'ano' ) or ($update_pocet_celkem == 'ano')) echo 'checked="checked"'; ?>><?php _e( 'Show total votes.', 'anketa-ravis' ); ?></label>
<p class="description"><?php _e( 'Show the total number of votes in the survey.', 'anketa-ravis' ); ?></p>
<br/>
                                                     

<label><input name="update_limit" type="radio" id="" <?php if (( $caslimit == '0' ) or ($update_limit == '0')) echo 'checked="checked"'; ?> value="0"><?php _e( 'Time limit for next votes, unlimited (in time).', 'anketa-ravis' ); ?></label><br/>

<label><input name="update_limit" type="radio" id="" <?php if (( $caslimit == '1'  ) or ($update_limit == '1')) echo 'checked="checked"'; ?> value="1"><?php _e( 'Time limit for next votes, once a hour.', 'anketa-ravis' ); ?></label><br/>

<label><input name="update_limit" type="radio" id="" <?php if (( $caslimit == '24' ) or ($update_limit == '24')) echo 'checked="checked"'; ?> value="24"><?php _e( 'Time limit for next votes, once of day.', 'anketa-ravis' ); ?></label><br/>

<p class="description"> <?php _e( 'Time limit for re-voting a visitor from one IP address.', 'anketa-ravis' ); ?></p>   
    
   
   
     
      
    
     
     
    <br/> <br/> 
    <input type="hidden" name="action" value="update_snastaveni" />
    <?php submit_button( __( 'Update settings', 'anketa-ravis' ), 'primary', 'submit', false ); ?>
    
  </form>
  
  <?php
    
     
     
    
  
echo "</div>";         
echo "</div>";
echo "</div>";  
/* *******************konec bloku div************************* */  


// ======================================================================
// ======================================================================
echo "</div>";
}



/*
**
**
**
**
**
**
**
**
**
**
**
**
**
*/



function anketa_popis_init(){
echo "<div class='telo'>";
// ======================================================================
// ======================================================================
 

  require_once(WEB_ANKETA_RAVIS_DIR.'includes/verze_pluginu.php'); 
  
  echo '<h1 class="titul"> <img src="'. $logo.'" alt="" width="130px" height="29px" > Popis pluginu WEB ANKETA 5 - RAVIS '. $verze.'</h1>';

/* *******************začátek bloku div************************* */         
echo "<div class='clearfix'>";
echo "<div class='box0'>";
echo "<div class='box00'>";
echo "<h2>Nastavení pluginu Google cloud messaging</h2>";

  ?>
  <h2>Popis pluginu</h2>
  <p>Vytvořte si vlastní anketu
například hodnocení webových stránek

vzor:

Jak obtížná je orientace na našich webových stránkách?
- Velmi jednoduchá
- Spíše jednoduchá
- Průměrná
- Spíše složitá
- Velmi složitá </p>
  
  <?php
  
echo "</div>";         
echo "</div>";
echo "</div>";  
/* *******************konec bloku div************************* */ 

// ======================================================================
// ======================================================================
echo "</div>";    
}














 

?>