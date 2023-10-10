<?php
/**
 * Main functionality
 **/






  
//+++++++++++++ třída widgetu, která bude rozšiřovat třídu WP_Widget.
class Anketa_Widget extends WP_Widget {
    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX == 1 == XXXXXXXXXXXXXXXXXXXXXXXXXXXX 
   
//+++++++++++++ unkce _contruct tvoří funkci. Uvnitř této funkce definujeme věci jako ID widgetu, jeho název a popis.
    public function __construct() {
    $widget_options = array( 
      'classname' => 'anketa_widget',
      'description' => 'web anketa Widget',
    );
    $control_ops = array(
			'width'   => 300,
			'height'  => 350,
			'id_base' => 'anketa_widget'
		);
    
    parent::__construct( 'anketa_widget', //    Base ID Základní ID widgetu
                         'WEB ANKETA 5 - RAVIS',    //název Widget objeví se v administraci
                          $widget_options  // popis widgetu
                          );
  }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX == 2 == XXXXXXXXXXXXXXXXXXXXXXXXXXXX

//+++++++++++++ funkce form tvoří formulář, který bude zobrazen ve Vzhled -> Widgety. Slouží k přizpůsobení widgetu.
    function form( $instance ) {
         
    
    
        $title = esc_attr($instance['title']);
        $otazka = esc_attr($instance['otazka']);
        $barva_grafu = esc_attr($instance['barva_grafu']);
        $barva_pozadi = esc_attr($instance['barva_pozadi']);
        $barva_ramu = esc_attr($instance['barva_ramu']);
        $ramecek = esc_attr($instance['ramecek']);
         
         
         
    global $wpdb;
    $rvs_anketa_dotaz_table_nazev = $wpdb->prefix . 'rvs_anketa_dotaz';   
    $fivesdrafts = $wpdb->get_results( "SELECT * FROM $rvs_anketa_dotaz_table_nazev");
   
    
   
        // formular do administrace
        echo '';
        echo '<label for="'.$this->get_field_id('otazka').'"> otázka: </label>';   
        echo '<select  id="'.$this->get_field_id('otazka').'" name="'.$this->get_field_name('otazka').'" style="width:100%;"  >'; 
        echo '<option value="'.$otazka.'">'. _e('otazka:').'</option>'; 
        foreach ( $fivesdrafts as $otazka ) 
        {	
        echo '<option value="'.$otazka->ID.'">'.$otazka->OTAZKA.'</option>';
        }  
        echo '</select>'; 
 
        echo '</br>';
        echo '<label for="'.$this->get_field_id('title').'"'. _e('Title:').'</label> ';
        echo '<br/>';
        echo '<input id=" '.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'"  style="width:100%;" /> ';
        echo '<br/>';
               
        echo '<label for="'.$this->get_field_id('barva_grafu').'" > barva grafu: </label>';
        echo '<br/>'; 
        echo '<select id="'.$this->get_field_id('barva_grafu').'" name="'.$this->get_field_name('barva_grafu').'"style="width:100%;" >';
        echo '<option value="'.$barva_grafu.'">'. _e('barva_grafu:').'</option>';
        echo '<option value="#FFCC00">přednastavená barva</option>';
        echo '<option value="#FFFF00">žlutá</option>';
        echo '<option value="#CC0000">červená</option>';
        echo '<option value="#0033FF">modrá</option>';
        echo '<option value="#33CC00">zelená</option>';
        echo '<option value="#000000">černá</option>';
        echo '<option value="#FFFFFF">bílá</option>';
        echo '</select> ';
        echo '</br>';
        
        echo '<label for="'.$this->get_field_id('barva_pozadi').'"> barva pozadi: </label>'; 
        echo '</br>';
        echo '<select id="'.$this->get_field_id('barva_pozadi').'" name="'.$this->get_field_name('barva_pozadi').'" style="width:100%;">';
        echo '<option value="'.$barva_pozadi.'">'. _e('barva_pozadi:').'</option>';
        echo '<option value="transparent">bez barvy</option>';
        echo '<option value="#FFFF00">žlutá</option>';
        echo '<option value="#CC0000">červená</option>';
        echo '<option value="#0033FF">modrá</option>';
        echo '<option value="#33CC00">zelená</option>';
        echo '<option value="#000000">černá</option>';
        echo '<option value="#FFFFFF">bílá</option>';
        echo '<option value="#727272">tmavě šedá</option>';
        echo '<option value="#B2B2B2">šedá</option>';
        echo '<option value="#E0E0E0">světle šedá</option>';
        echo '</select> ';
        echo '</br>';
        
        echo '<label for="'.$this->get_field_id('barva_ramu').'"> barva rámečku: </label>'; 
        echo '</br>';
        echo '<select id="'.$this->get_field_id('barva_ramu').'" name="'.$this->get_field_name('barva_ramu').'" style="width:100%;">';
        echo '<option value="'.$barva_ramu.'">'. _e('barva_ramu:').'</option>';
        echo '<option value="transparent">bez barvy</option>';
        echo '<option value="#FFFF00">žlutá</option>';
        echo '<option value="#CC0000">červená</option>';
        echo '<option value="#0033FF">modrá</option>';
        echo '<option value="#33CC00">zelená</option>';
        echo '<option value="#000000">černá</option>';
        echo '<option value="#FFFFFF">bílá</option>';
        echo '<option value="#727272">tmavě šedá</option>';
        echo '<option value="#B2B2B2">šedá</option>';
        echo '<option value="#E0E0E0">světle šedá</option>';
        echo '</select> ';
        echo '</br>';
        
        echo '<label for="'.$this->get_field_id('ramecek').'"> šířka rámečku: </label>'; 
        echo '</br>';
        echo '<select id="'.$this->get_field_id('ramecek').'" name="'.$this->get_field_name('ramecek').'" style="width:100%;">';
        echo '<option value="'.$ramecek.'">'. _e('ramecek:').'</option>';
        $i = 0;
        while ($i <= 15) {
        //echo $i;
         echo '<option value="'.$i.'">šířka '.$i.' px</option>';
        $i++;
        }
        echo '</select> ';
        echo '';
        
    
       
    }
    
    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX == 3 == XXXXXXXXXXXXXXXXXXXXXXXXXXXX

//+++++++++++ funkce update zajišťuje, že se aktualizuje nastavení, které uživatelé do nastavení widgetu vložili.  
    function update( $new_instance, $old_instance ) { 
    $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['otazka'] = strip_tags($new_instance['otazka']);
        $instance['barva_grafu'] = strip_tags($new_instance['barva_grafu']);
        $instance['barva_pozadi'] = strip_tags($new_instance['barva_pozadi']);
        $instance['barva_ramu'] = strip_tags($new_instance['barva_ramu']);
        $instance['ramecek'] = strip_tags($new_instance['ramecek']);
        
        return $instance;      
    }


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX == 4 == XXXXXXXXXXXXXXXXXXXXXXXXXXXX

//++++++++++ funkce widget definuje výstup widgetu při zobrazení na stránce
    function widget( $args, $instance ) {
     extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $dotaz_id = apply_filters('widget_otazka',$instance['otazka']); 
        
        //echo $dotaz_id;
        //echo 'test diplay';
   
   
 
        $bg_grafu = $instance['barva_grafu'];
        if (empty($bg_grafu)){
        $bg_grafu = "#FFCC00";
        //echo $bg_grafu;
        } 
           
        $barva_pozadi = $instance['barva_pozadi'];
        $barva_ramu = $instance['barva_ramu'];
        $sirka_ramu = $instance['ramecek']; 
        
     
       
      //echo   $dotaz_id;
        
    // vypis z tabulky 
    // globální proměnná pro připojení databáze   
    global $wpdb;
    // nazvy tabulek
    $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    $rvs_anketa_dotaz_table_nazev = $wpdb->prefix . 'rvs_anketa_dotaz';
    $rvs_anketa_nastaveni_table = $wpdb->prefix . 'rvs_anketa_nastaveni';
    
   

    
    // databazove dotazy
    $fivesdrafts = $wpdb->get_results( "SELECT * FROM $rvs_anketa_dotaz_table_nazev WHERE ID = $dotaz_id ");    
    $zaznam_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table WHERE ID_ANKETY = '$dotaz_id ' " );
    
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
    
    $nastavebi_drafts = $wpdb->get_results( "SELECT * FROM $rvs_anketa_nastaveni_table  WHERE ID >= ' $cislo_id'");
    
  
   /* =======  SETING NASTAVEVENI PARAMETRU ANKETZ ======== */
   foreach ( $nastavebi_drafts as $nastavebi_draft ) 
   {
	 //echo "<strong>".$nastavebi_draft->GRAF."</strong><br/><br/>" ;
   $graf_seting = $nastavebi_draft->GRAF;
   $pocet_seting = $nastavebi_draft->POCET;
   $pocet_celkem_seting = $nastavebi_draft->POCET_CELKEM;
   $casovy_limit_seting = $nastavebi_draft->CASLIMIT;
   }
   
    
    //echo 'xxxxxxxxxx'.$graf_seting;    
    //echo $rvs_anketa_dotaz_table_nazev;   
    //echo $dotaz;
   
   /* ************************************************ */
   /* ************************************************ */
   /* ************************************************ */
   /* ************************************************ */
   $hlasy_celkem_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_dotaz_table_nazev WHERE ID = $dotaz_id " );
   if( $hlasy_celkem_count > 0){
   
   echo $before_widget;
   echo '<div  style=" background:'.$barva_pozadi.'; padding:20px; border:'.$sirka_ramu.'px solid '.$barva_ramu.'; ">';
   
   if ($title)
   echo $before_title .''.$title.''. $after_title ;
   foreach ( $fivesdrafts as $fivesdraft ) 
   {
	 echo "<strong>".$fivesdraft->OTAZKA."</strong><br/><br/>" ;
   }
   
   /* ************************************************ */
   /* ************************************************ */
   /* ************************************************ */
   /* ************************************************ */
   echo ''; 
   echo ' <form method="post" >';
    $pocitadloradku = 1; 
    foreach ( $fivesdrafts as $fivesdraft ) 
   {
   
   // pčet je 5 protože v databazi je tabulka nstavena na pět hodnot
   $pocet_hodnoceni = 5;
   $i = 1;
   while ($i <= 5) {
   //echo $i;
   
   $HODNOTA = HODNOTA.$i;
   $hodnoty = $fivesdraft->$HODNOTA;
    //echo $hodnoty;    
 if (!empty($hodnoty)) {
 echo '<input type="radio" name="hodnota" value="'.$hodnoty.' "> '; 
 echo '<label >'.$hodnoty.''; 
 $user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table WHERE HODNOTA = '$hodnoty' AND ID_ANKETY ='$dotaz_id' " );
 if( $user_count > 0)
 {

 $delka =  round($user_count/$zaznam_count*100);
 
 
 
    //***********************************************
    //********************* MUSI SE DOLADIT**********
    //***********************************************
     //nastaveni verze ankety
       
    if( $casovy_limit_seting == '1'){ $datum_prodleva = date( 'Y-m-d H');}  
    if( $casovy_limit_seting == '24'){ $datum_prodleva = date( 'Y-m-d H:i:s');} 
    if(( $casovy_limit_seting == '0') or ( $casovy_limit_seting == '')){ $datum_prodleva = '';}
     
     
      
  if( $pocet_seting!= 'ano'){
  echo " - <small></small>$delka%<br/></label>";}
  else{
  echo " - <small>počet hl. - </small> {$user_count}<br/></label>"; 
  }
  
 //echo $delka;
 //graf
 if( $graf_seting != 'ne'){ echo '<div  style="margin-left:15px; background:'.$bg_grafu.'; width:'.$delka.'px; height: 4px;"></div>'; }
 
 
 
 
 }
 else{echo '<br/>';}
 }  
   
   $i++;  
   }
                     
}     
        
        
    //echo date( 'Y-m-d H:i:s');
    echo '<input type="hidden" name="id_ankety" value="'.$fivesdraft->ID.'">';
    echo '<input type="hidden" name="otazka" value="'.$fivesdraft->OTAZKA.'">';
    echo '<input type="hidden" name="activace" value="hlas">';
 
 
    /*  
    ====
    ====  NASTAVENI PRO OMEZENE CASOVE HLASOVANI
    ====  NENI NA DEFINOVANO
    ====  PALNOVANE NASTAVENI NA JEDNU HODINU
    ====  NEBO NA JEDDEN DEN
    ====
    */
    
    if(empty($dotaz_id)){
        echo '<p>nyní není žádná anketní otázka k dispozici</p><hr/>';
        }
        else{            
    $rvs_anketa_vysledky_table = $wpdb->prefix . 'rvs_anketa_vysledky';
    $ip = $_SERVER['REMOTE_ADDR'];
    //echo   $ip ;
    
    $datum = $datum_prodleva;
    $ip_count = $wpdb->get_var( "SELECT COUNT(*) FROM $rvs_anketa_vysledky_table WHERE IP = '$ip' AND Time = '$datum'  " );
    // NASTAVIT ČASOVÉ OMEZENÍ HLASOVÁNÍ !!!!!!
    if( $ip_count >= 1){
    echo "<hr/><p>Děkujeme za váš hlas.</p>";  
    //echo "<p><a href='http://statnivlajka.cz' style='font-size:10px;'>sponzor ankety: www.statnivlajka.cz</a></p>";     
    }
    else{
         // NAČTE Z TABUKY STATUS A/N A=AKTIVNÍ N=NEAKTIVNÍ
         //echo "<td>".$fivesdraft->STATUS."</td>";
         if( $fivesdraft->STATUS == 'N'){ echo '<br/>HLASOVÁNÍ UKONČENO';}
         else{
         echo '<br/><input type="submit"  value="hlasuj">'; 
         } 
    }
   
    
    
    
    if($zaznam_count > 0){
    echo ''; 
    
    if($pocet_celkem_seting != 'ano'){ }
    else { 
    echo '<p><u>celkem hlasů :';
    echo $zaznam_count;
    echo '</u></p><hr/>'; 
    }
    
    }
    else{  echo '<p><u>zatím nikdo nehlasoval</u></p><hr/>'; }
       }
       
       
    echo '</form>'; 
 
    /* ************************************************ */
    /* ************************************************ */
    /* ************************************************ */
    /* ************************************************ */ 
    echo '</div>';
    echo $after_widget;
    }     
    }
     
}
 

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX == 5 == XXXXXXXXXXXXXXXXXXXXXXXXXXXX


//++++++++++ Funkce register_widget() je WordPress funkce, která obsahuje pouze jeden parametr a to jméno třídy, kterou jste právě vytvořili.   
    function anketa_register_widget() { 
    register_widget( 'Anketa_Widget' );
    }
//++++++++++ inicializace funkce pomocí widgets_init 
add_action( 'widgets_init', 'anketa_register_widget' );


















 

?>