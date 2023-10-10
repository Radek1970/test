
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


     $user_old  = $_POST['user_old'];
     $pass_old  = $_POST['pass_old'];
     //echo $user_old;
     //echo $pass_old;
     
     
     $user_edit1         = $_POST['user_edit'];
     $pass_edit1         = $_POST['pass_edit'];
     $email_edit         = $_POST['email_edit'];
     $ev_c               = $_POST['ev_c'];
     $funkce             = $_POST['funkce'];
     $jmeno_osob_edit    = $_POST['jmeno_osob_edit'];
     $prijmeni_osob_edit = $_POST['prijmeni_osob_edit'];
     
     //odstrani mezer na zacatku retezce
     $user_uprav1 = trim($user_edit1);
     $pass_uprav1 = trim($pass_edit1);
     
     // Všechna velká písmena pøevede na malá 
     $user_uprav2 =(strtolower($user_uprav1));
     $pass_uprav2 =(strtolower($pass_uprav1));      
     
     // nahradi mezery spojovnikem _
     $user_uprav3 =(str_replace(" ","_",$user_uprav2));
     $pass_uprav3 =(str_replace(" ","_",$pass_uprav2));
                            
      // odstrani hacky carky 
      $user_uprav  = (StrTr($user_uprav3,  "ìšèøžýáíéúùò", "escrzyaieuun"));                 
      $pass_uprav  = (StrTr($pass_uprav3,  "ìšèøžýáíéúùò", "escrzyaieuun"));                
                     
      //odstrani mezer na zacatku retezce
      $email_uprav = trim($email_edit);  
                          
/* test 
echo $user_uprav;
echo $pass_uprav;
echo $email_uprav;
*/
 
 /****************************************************************************
  * 
  * FORMULAR  
  * validace formulare
  *
  ****************************************************************************/       
 $form = '<form id="myform" class="cssform" action="page.php?akc=edit_hesla_go" method="post">
 <input type="hidden" name="user_old"  value="'.$user_old.'" size=25 />
 <input type="hidden" name="pass_old"  value="'.$pass_old.'" size=25 />
 <input type="hidden" name="ev_c"  value="'.$ev_c.'" size=25 />
 <input type="hidden" name="funkce"  value="'.$funkce.'" size=25 />

 <div class="form_contact">';
//if((!strlen($user_edit))  ){


  if(!strlen($user_uprav))   {
  $form .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >pøihl. jmeno chyba</span></label>
              <input type="text" name="user_edit"  value="" size=25 />
              </div>';
  }
  else{
  $form .= '  <div class="form_row_contact">
              <label class="left">pøihl. jméno: </label>
              <input type="text" name="user_edit"  value="'.$user_uprav.'" size=25 />
              </div>';
  } 
  
  
  
  
  
  if(!strlen($pass_uprav))   {
  $form .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >heslo chyba</span></label>
              <input type="text" name="pass_edit"  value="" size=25 />
              </div>';
  }
  else{
  $form .= '  <div class="form_row_contact">
              <label class="left">heslo: </label>
              <input type="text" name="pass_edit"  value="'.$pass_uprav.'" size=25 />
              </div>';
  }
  
 
 
 
 if(!strlen($email_uprav))   {
  $form .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >email chyba</span></label>
              <input type="text" name="email_edit"  value="" size=25 />
              </div>';




  }
  else{
       if(!ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email_uprav))   {
       $form .= '<div class="form_row_contact">
                 <label class="left"><span style="color:red;" >email chyba špatný formát</span></label>
                 <input type="text" name="email_edit"  value="" size=25 />
                 </div>';
       }
       else{
       $form .= '<div class="form_row_contact">
                 <label class="left">email:</label>
                 <input type="text" name="email_edit"  value="'.$email_uprav.'" size=25 />
                 </div>';
       
       }
  }
 
 
  
/*  
if (ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email))
*/



      if(!strlen($jmeno_osob_edit))   {
  $form .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >jméno chyba</span></label>
              <input type="text" name="jmeno_osob_edit"  value="" size=25 />
              </div>';
  }
  else{
  $form .= '  <div class="form_row_contact">
              <label class="left">jméno</label>
              <input type="text" name="jmeno_osob_edit"  value="'.$jmeno_osob_edit.'" size=25 />
              </div>';
  }





      if(!strlen($prijmeni_osob_edit))   {
  $form .= '  <div class="form_row_contact">
              <label class="left"><span style="color:red;" >pøijmení chyba</span></label>
              <input type="text" name="prijmeni_osob_edit"  value="" size=25 />
              </div>';
  }
  else{
  $form .= '  <div class="form_row_contact">
              <label class="left">pøijmení</label>
              <input type="text" name="prijmeni_osob_edit"  value="'.$prijmeni_osob_edit.'" size=25 />
              </div>';
  }







$form .= '
          <div style="float:right; padding:10px 25px 0 0;">
          <input type="submit" value="vložit nový" class="form_button" /> 
          </div>
          </div><br/><br/><br/><br/>
</form>';


  //echo $form;
 /****************************************************************************
  * 
  * KONEC
  * FORMULAR  
  * validace formulare
  *
  ****************************************************************************/       










      // zjistime zda zadane nove heslo neni jiz registrovane
      $result=mysql_query("select * from ".PREFIX."heslo ");
                    
      //Poèet záznamù, zjistit pomocí funkce mysql_NumRows($result). 
      $pocet = mysql_NumRows($result);
      $id= 0;
      while ($id<$pocet){  
      if (mysql_Result($result, $id, "pass") == $pass_uprav){
      
      $tabulka = "<div class='admin_warnnig'>";    
      $tabulka .= "<br/><small>heslo:</small>&nbsp; $pass_uprav &nbsp; je již registrované. Zvolte jiné heslo</br/>";
      $tabulka .= "</div></div>";
 
      // vlastní výpis tabulky
      echo $tabulka;
      return;
      }
      $id++;
      }











  if ( (!strlen($user_uprav))  || (!strlen($pass_uprav)) || (!strlen($email_uprav)) || (!ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email_uprav)) || (!strlen($jmeno_osob_edit)) || (!strlen($prijmeni_osob_edit)) ){
  
  echo $form; }
     
 if ( (strlen($user_uprav))   and  (strlen($pass_uprav)) and (strlen($email_uprav)) and (ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email_uprav)) and (strlen($jmeno_osob_edit)) and (strlen($prijmeni_osob_edit)) )  { 
 
   
   $orig = '
<fieldset><legend>pùvodní data</legend>
<h3>vložená data:  [prihl.jmeno: '.$user_uprav.' ][heslo: '.$pass_uprav.' ][email: '.$email_uprav.' ] [heslo: '.$jmeno_osob_edit.' ] [heslo: '.$prijmeni_osob_edit.' ]</h3>
</fieldset>';

//echo $orig ;
     
     
    
     
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query(" 
              UPDATE ".PREFIX."heslo 
              SET user = '$user_uprav'
              , pass = '$pass_uprav'
              , email = '$email_uprav'
              , ev_c = '$ev_c'
              , funkce = '$funkce'
              , jmeno = '$jmeno_osob_edit'
              , prijmeni = '$prijmeni_osob_edit'
              
              WHERE pass = '$pass_old'
              ");
       

       
     
          $result=mysql_query("select *
                     from ".PREFIX."heslo
                     where pass = '$pass_uprav'
                    ");
                    
while  ($row  =  mysql_fetch_row($result))
{

 $orig_new = '
<div class="admin_warnnig">
nová data:<br/>
<h3><small> prihl.jméno:</small>&nbsp;'.$row[0].'  &nbsp;  <small>heslo:</small>&nbsp;'.$row[1].'</br/><small>email:</small>&nbsp;'.$row[2].'&nbsp;</br/><small>jméno:</small>&nbsp;'.$row[5].'&nbsp;</br/><small>pøijmení:</small>&nbsp;'.$row[6].'</h3></div>';
echo $orig_new;
 
} 
   
     
     
     }
 
     
   
        
 


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















