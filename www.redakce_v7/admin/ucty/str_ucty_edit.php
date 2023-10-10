

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

  
 
  
 $result=mysql_query("select *
                     from ".PREFIX."heslo
                     where ev_c = '$mujsoubor'
                    ");
                    
while  ($row  =  mysql_fetch_row($result))
{


 
  
  
/****************************************************************************
  * 
  * FORMULAR  
  * naformatovai formulare
  *
  ****************************************************************************/ 
$form = '<form id="myform" class="cssform" action="page.php?akc=ucet_edit" method="post">
<input type="hidden" name="zapis"  value="ano" size=25 />
<input type="hidden" name="ev_c_edit"  value="'.$mujsoubor.'" size=25 />';


 if($ev_c_autora == "200901"){
$form .= '<div class="form_row_contact"><label class="left">heslo: </label><input  class="form_input_contact type="text" name="pass_edit"  value="'.$row [1].'" size=25 /></div>

          <div class="form_row_contact"><label class="left">jmeno: </label><input type="text"  class="form_input_contact" name="user_edit"  value="'.$row [0].'" size=25 /></div>
          
          <div class="form_row_contact"><label class="left">jmeno: </label>
          <input type="text" name="email_edit"  value="'.$row [2].'" class="form_input_contact" /></div>';

     }
     else {
$form .= '<input type="hidden" name="pass_edit"  value="'.$row [1].'" size=25 />
          <input type="hidden" name="user_edit"  value="'.$row [0].'" size=25 />';

     }


$form .= '           <div class="form_contact">
                  
                    <div class="form_row_contact">
                    <label class="left">ev.Ë.: </label>'.$mujsoubor.'
                    
                    </div>

                    <div class="form_row_contact">
                    <label class="left">email: </label>'.$row [2].'
                    <input type="hidden" name="email_edit"  value="'.$row [2].'" class="form_input_contact" />
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">JmÈno: </label>'.$row [5].'
                    <input type="hidden" name="jmeno_edit"  value="'.$row [5].'" class="form_input_contact" />
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left">P¯ÌjmenÌ: </label>'.$row [6].'
                    <input type="hidden" name="prijmeni_edit"  value="'.$row [6].'" class="form_input_contact" />
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">funkce: </label>  
                    <select name="funkce_edit">
                    <option value="'.$row [4].'">aktualnÌ funkce &nbsp;&nbsp;>>&nbsp;'.$row [4].'</option>
                    <option value="dopisovatel">dopisovatel</option>
                    <option value="redaktor">redaktor</option>
                    </select> 
                    </div>';
                    
 
                    
                    
$form .= '                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="editova" class="form_button" /> 
                    </div>
                  </div>

</form>';




 






  echo $form;


}

















  if($zapis == "ano"){
  
  $jmeno_edit     = $_POST['jmeno_edit'];
  $prijmeni_edit  = $_POST['prijmeni_edit'];
  $email_edit     = $_POST['email_edit'];
  $ev_c_edit      = $_POST['ev_c_edit'];
  $funkce_edit    = $_POST['funkce_edit'];
  
  
  $user_edit     = $_POST['user_edit'];
  $pass_edit     = $_POST['pass_edit'];
  
  
   $hlaska_ok = '<div class="admin_info"><br/> ˙Ëet byl editov·n &nbsp;<br/></div>';
   echo $hlaska_ok;
   
   
  
   mysql_query(" 
              UPDATE ".PREFIX."heslo 
              SET user = '$user_edit'
              , pass = '$pass_edit'
              , email = '$email_edit'
              , ev_c = '$ev_c_edit'
              , funkce = '$funkce_edit'
              , jmeno = '$jmeno_edit'
              , prijmeni = '$prijmeni_edit'
              
              
               where ev_c = '$ev_c_edit'
              
              ");
 
 
   }










?>

</div>
