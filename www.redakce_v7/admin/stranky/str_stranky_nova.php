
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
  //Je cesta zp�t?
  if($od != null){
  //Naform�tujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vra� se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">Zp�t</a></div>";
  }
    
// piktogram stranky
echo "<img src=\"css/images/page.png\" />";     



$form = '<form id="myform" class="cssform" action="page.php?akc=stranky" method="post">
<input type="hidden" name="galerie" value="ne"/>

       <div class="contact_tab">	
                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">N�zev odkazu: </label>
                    <input type="text" name="jmeno" class="form_input_contact"/>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">N�zev str�nky: </label>
                    <input type="text" name="popis" class="form_input_contact"/>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">Kl���v� slova: </label>
                    <textarea name="key_slova" rows="" cols="" ></textarea>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">vlo�it kontakn� formul��: </label>
                    NE: <input type="radio" name="formular_kontakt" value="ne" checked="checked">
                    ANO:<input type="radio" name="formular_kontakt" value="ano">

                    </div>
                    
                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vlo�it nov�" class="form_button" /> 
                    <input type="reset" value="vymazat" class="form_button" />
                    </div>
                    
                    </div>
                    
                    
                    
                    
         </div>

</form>';


echo $form;


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















