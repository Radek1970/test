
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
    
// piktogram stranky
echo "<img src=\"css/images/page.png\" />";     



$form = '



<form method="post" name="form_nova_anketa" action="page.php?akc=anketa" >





       <div class="contact_tab">	
                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">otazka: </label>
                    <input type="text" name="otazka" class="form_input_contact"/>
                    </div>
                    
                   
   
                    
                    
                    <div class="form_row_contact">
                    <label class="left">odpoveï 1: </label>
                    <input type="text" name="odpoved_1" class="form_input_contact" /> 
                    </div>
                    <div class="form_row_contact">
                    <label class="left">odpoveï 2: </label>
                    <input type="text" name="odpoved_2" class="form_input_contact" /> 
                    </div>
                    
                    &nbsp;3. odpovìï<input type="checkbox" name="tmp_souhlasim" id="tmp_souhlasim" value="3" onClick="if (document.form_nova_anketa.tmp_souhlasim.checked) { document.form_nova_anketa.finish_submit.disabled=false; } else { document.form_nova_anketa.finish_submit.disabled=true; }" />ano<br />
                   
                    <div class="form_row_contact">
                    <label class="left">odpoveï 3: </label>                  
<input type="text" name="odpoved_3" id="finish_submit" class="form_input_contact" disabled /> 
                    </div>
                    
                    <input type="hidden" name="odpoved_pocet_1" value="0" />
                    <input type="hidden" name="odpoved_pocet_2" value="0" />
                    <input type="hidden" name="odpoved_pocet_3" value="0" />
                    
                    <input type="hidden" name="pocet_celkem" value="0" />
                    <input type="hidden" name="nova_aktivace" value="neaktivni" />
                    
                    
                    
                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vložit nový" class="form_button" /> 
                    <input type="reset" value="vymazat" class="form_button" />
                    </div>
                    
                    </div>
                    
                    
                    
                    
         </div>

</form>';


echo $form;


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















