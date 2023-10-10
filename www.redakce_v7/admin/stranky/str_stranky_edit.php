
<!-- LEVA STRANA -->
<div class="column1">
<?php
			// pripojeni sekce konec body..
 include_once('komponenty/info_panel.php');
?>                          
</div>
<!-- KONEC LEVA STRANA -->











<!-- PRAVA STRANA -->
<div class="column4">
<div id="admin_header">
    	<div class="admin_index_title"><? echo $nadpis_stranky; ?></div>    
</div> 
 
 
<?php
   
 /********************************************
   *
   * kod pro zpetny navrat   
   *
   *******************************************/        
    $od = $HTTP_REFERER;
  //Je cesta zpìt?
  if($od != null){
  //Naformátujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vra se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">Zpìt</a></div>";
  }
    




    $result=mysql_query("select *
                     from ".PREFIX."menu
                     where id = '$mujsoubor'
                    ");
                   
       $row  =  mysql_fetch_row($result);
// vyobrazeni piktogramu pro stranku nebo pro fotogalerii       
if($row[6] == ano){ echo "<img src=\"css/images/fotka_big.png\" />";}    
else {echo "<img src=\"css/images/page.png\" />";}       

$form = '<form id="myform" class="cssform" action="page.php?akc=stranky" method="post">

       <div class="contact_tab">	
                    <div class="form_contact">
                    
                    <input type="hidden" name="id_e"  value="'.$row[0].'" size=25 />
                    <input type="hidden" name="link_e"  value="'.$row[1].'" size=25 />
                    
                    <div class="form_row_contact">
                    <label class="left">Název odkazu: </label>
                    <input type="text" name="jmeno_e"  value="'.$row[2].'"  class="form_input_contact"/>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">Název stránky: </label>
                    <input type="text" name="popis_e"   value="'.$row[3].'"  class="form_input_contact"/>
                    </div>';
                    
                   
                    $key_slovo =(str_replace(";"," ",$row[4]));
$form .= '    
                    <div class="form_row_contact">
                    <label class="left">Klíèévá slova: </label>
                    <textarea name="key_slova_e" rows="" cols="" >'.$key_slovo.'</textarea>
                    </div>';
                    
                    
                    
$form .= '          <input type="hidden" name="galerie_e" value="'.$row[6].'"/>';
                    /*
                     * jeli galerie rovna ANO nebudeme vypisovat 
                     * moznost pro vobu kontaktniho formulare
                     *                      
                     */                   
if($row[6] != ano){                     
$form .= '          <div class="form_row_contact">
                    <label class="left">vložit kontakní formuláø: </label>';
                    
                 
                    if($row[5] == ano){
$form .= '          NE: <input type="radio" name="formular_kontakt_e" value="ne" >
                    ANO:<input type="radio" name="formular_kontakt_e" value="ano" checked="checked">';
                    }
                    else
                    {
$form .= '          NE: <input type="radio" name="formular_kontakt_e" value="ne" checked="checked">
                    ANO:<input type="radio" name="formular_kontakt_e" value="ano">';
                    }
                     
                    
                    
$form .= '          </div>';
                    
                  }
                    
                    
                    
$form .= '          <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="editovat" class="form_button" /> 
                    </div>
                    
                    </div>
                    
                    
                    
                    
         </div>

</form>';


echo $form;


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















