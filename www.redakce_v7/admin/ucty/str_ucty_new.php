

<div class="column1">
        
<?php
			// pripojeni sekce konec body..
 include_once('komponenty/info_panel.php');
?>        
        	
                    
                          
</div>
<!-- KONEC LEVA STRANA -->











<!-- PRAVA STRANA -->
<div class="column4">

<?php 

    
    echo'<div id="admin_header">';
    	echo'<div class="admin_index_title">'.$nadpis_stranky .'  </div>';  
      echo'</div>';
  
     
     $od = $HTTP_REFERER;
  //Je cesta zpÏt?
  if($od != null){
  //Naform·tujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vraù se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">ZpÏt</a></div>";
  }


  


  // vygeneruje heslo
  $mozne_znaky = 'abcdefghijklmnopqrstuvwxyz123456789';
  $hesl = '';
  $pocet_moznych_znaku = strlen($mozne_znaky);
  for ($i=0;$i<6;$i++) {
    $hesl .= $mozne_znaky[mt_rand(0,$pocet_moznych_znaku)];
  }
 
 //echo $hesl;
 $datum = Date("YmjHis", Time());
 $datum2 = Date("m", Time());
 $heslo_new = $hesl;
 $ev_c_new = $datum.''.$hesl;
 //echo "<br>";
 //echo $ev_c_new;
 //echo "<br>";
 
  
  
  
/****************************************************************************
  * 
  * FORMULAR  
  * naformatovai formulare
  *
  ****************************************************************************/ 
$form = '<form id="myform" class="cssform" action="page.php?akc=ucet_nov" method="post">
<input type="hidden" name="zapis"  value="ano" size=25 />
<input type="hidden" name="ev_c_new"  value="'.$ev_c_new.'" size=25 />
<input type="hidden" name="heslo_new"  value="'.$heslo_new.'" size=25 />


                 <div class="form_contact">
                  
                  

                    <div class="form_row_contact">
                    <label class="left">email: </label>
                    <input type="text" name="email_new"  value="" class="form_input_contact" />
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">JmÈno: </label>
                    <input type="text" name="jmeno_new"  value="" class="form_input_contact" />
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left">P¯ÌjmenÌ: </label>
                    <input type="text" name="prijmeni_new"  value="" class="form_input_contact" />
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">funkce: </label>  
                    <select name="funkce_new">
                    <option value="dopisovatel">dopisovatel</option>
                    <option value="redaktor">redaktor</option>
                    </select> 
                    </div>';
                    
 
                    
                    
$form .= '                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vloûit nov˝" class="form_button" /> 
                    </div>
                  </div>

</form>';




 




 /****************************************************************************
  * 
  * FORMULAR  
  * validace formulare
  *
  ****************************************************************************/       
 $form_val = '<form id="myform" class="cssform" action="page.php?akc=ucet_nov" method="post">
<input type="hidden" name="zapis"  value="ano" size=25 />
<input type="hidden" name="ev_c_new"  value="'.$ev_c_new.'" size=25 />
<input type="hidden" name="heslo_new"  value="'.$heslo_new.'" size=25 />

 <div class="form_contact">';
//if((!strlen($user_edit))  ){





  if(!strlen($email_new))   {
  $form_val .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >email chyba</span></label>
              <input type="text" name="email_new"  value="" class="form_input_contact" />
              </div>';
  }
  else{
  
      if(!ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email_new))   {
       $form_val .= '<div class="form_row_contact">
                 <label class="left"><span style="color:red;" >email chyba nespr·vn˝ form·t</span></label>
                 <input type="text" name="email_new"  value="" class="form_input_contact" />
                 </div>';
       }
       else{
       
                 $dotaz = "SELECT * FROM ".PREFIX."heslo WHERE email='$email_new'";
                 // spojeni dotazu a cesty
                 $result = mysql_query($dotaz,$spojeni);

                /****************************************************
                 PoËet z·znam˘, kterÈ jsou v˝sledkem poslednÌho dotazu, 
                 m˘ûeme zjistit pomocÌ funkce mysql_NumRows($result). 
                 ******************************************************/
                 $pocet_emalu = mysql_NumRows($result);
                  //test
                  //echo $pocet_emalu;
                 /***************************************************** 
                  v pripade uspechu vykona prikaz
                 ******************************************************/  
    
                 if($pocet_emalu == 1){ 
                 $form_val .= '<div class="form_row_contact">
                 <label class="left"><span style="color:red;" >email jiû existuje, zadejte jin˝</span></label>
                 <input type="text" name="email_new"  value="" class="form_input_contact" />
                 </div>';
                 }
                 else{$form_val .= '<div class="form_row_contact">
                 <label class="left">email</label>
                 <input type="text" name="email_new"  value="'.$email_new.'" class="form_input_contact" />
                 </div>';
                 
                 } 
                 
       
                 
       
       }
  } 






  if(!strlen($jmeno_new))   {
  $form_val .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >jmÈno chyba</span></label>
              <input type="text" name="jmeno_new"  value="" class="form_input_contact" />
              </div>';
  }
  else{
  $form_val .= '  <div class="form_row_contact">
              <label class="left">jmÈno: </label>
              <input type="text" name="jmeno_new"  value="'.$jmeno_new.'" class="form_input_contact" />
              </div>';
  } 
  
  
  


  if(!strlen($prijmeni_new))   {
  $form_val .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >p¯ijmenÌ chyba</span></label>
              <input type="text" name="prijmeni_new"  value="" class="form_input_contact" />
              </div>';
  }
  else{
  $form_val .= '  <div class="form_row_contact">
              <label class="left">p¯ijmenÌ: </label>
              <input type="text" name="prijmeni_new"  value="'.$prijmeni_new.'" class="form_input_contact" />
              </div>';
  } 






     $form_val .= ' <div class="form_row_contact">
                    <label class="left">funkce: </label>  
                    <select name="funkce_new">
                    <option value="'.$funkce_new.'">'.$funkce_new.'</option>
                    <option value="dopisovatel">dopisovatel</option>
                    <option value="redaktor">redaktor</option>
                    </select> 
                    </div>';





$form_val .= '
          <div style="float:right; padding:10px 25px 0 0;">
          <input type="submit" value="vloûit nov˝" class="form_button" /> 
          </div>
          </div><br/><br/><br/><br/>
</form>';






if ( ($zapis == "ano") and  (!strlen($jmeno_new)) || (!strlen($prijmeni_new)) || ($pocet_emalu == 1) || (!strlen($email_new)) || (!ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email_new)) ) {
  
  echo $form_val; }


else{

  echo $form;




















  if($zapis == "ano"){
  
  $jmeno_new     = $_POST['jmeno_new'];
  $prijmeni_new  = $_POST['prijmeni_new'];
  $email_new     = $_POST['email_new'];
  $ev_c_new      = $_POST['ev_c_new'];
  $funkce_new    = $_POST['funkce_new'];
  $heslo_new     = $_POST['heslo_new'];
  
       //prevede velka pismena na mala
       $jmeno_mala  = (StrTr($jmeno_new,  "ABCDEFGHIJKLMNOPQRSTUVWXYZÃä»ÿé›¡Õ…⁄Ÿ", "abcdefghijklmnopqrstuvwxyzÏöË¯û˝·ÌÈ˙˘"));
       $jmeno_bez  = (StrTr($jmeno_mala,  "ÏöË¯û˝·ÌÈ˙˘", "escrzyaieuu"));
       $user = $jmeno_bez;
  
  /**
  echo "<br>";
  echo "JmÈno: $jmeno_new";
  echo "<br>";
  echo "P¯ÌjmenÌ: $prijmeni_new";
  echo "<br>";
  echo "email: $email_new";
  echo "<br>";
  echo "evidenËnÌ ËÌslo: $ev_c_new";
  echo "<br>";
  echo "P¯ihlaöovacÌ jmÈno: $user";
  echo "<br>";
  echo "heslo: $heslo_new";
  echo "<br>";
  echo "Funkce: $funkce_new";
  **/
  
   $hlaska_ok = '<div class="admin_info"><br/>Byl vytvo¯en nov˝ ˙Ëet &nbsp;<br/></div>';
   echo $hlaska_ok;
   
   
 $dotaz="INSERT INTO ".PREFIX."heslo VALUES ('$user','$heslo_new','$email_new','$ev_c_new','$funkce_new','$jmeno_new','$prijmeni_new')";
      // spojeni dotazu a cesty - vykonani prikazu
      $result = mysql_query($dotaz,$spojeni);
      
     $zprav ="PRISTUPOVA DATA DO ADMINISTRACNIHO ROZHRANI\n";
     $zprav.="VASE PRIHLASOVACI UDAJE\n";
     $zprav.="JMENO:$user - HESLO:$heslo_new - \n";
     $zprav.="NA TENTO EMAIL NEODPOVIDEJTE\n";
     //echo "$email_new";
    //odeslani pristupovych dat na zadany email v nove registraci
    @ Mail("$email_new", "prihlasovaci data", $zprav, "From: admin@admin.cz");
  
      
   }

}








?>

</div>
