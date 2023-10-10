

<div class="column1">
        
<?php
			// pripojeni sekce konec body..
 include_once('komponenty/info_panel.php');
?>        
        	
                    
                          
</div>
<!-- KONEC LEVA STRANA -->











<!-- PRAVA STRANA -->
<div class="column4">

<p>xxxxxxxxxxxxxxxxx</p>



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
    

 



$form = '<form id="myform" class="cssform" action="page.php?akc=stranky" method="post">


       <div class="contact_tab">	
                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">Název odkazu: </label>
                    <input type="text" name="jmeno" class="form_input_contact"/>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">Název stránky: </label>
                    <input type="text" name="popis" class="form_input_contact"/>
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">Klíèévá slova: </label>
                    <textarea name="key_slova" rows="" cols="" ></textarea>
                    </div>
                    
                    
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
