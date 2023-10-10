
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


  // nazev tabulky v databazi do ktere ma byt vlozen zaznam
   //$nazev_tabulky = "at_side1";
     
  
      
          $jmeno_admin   = $_POST['jmeno'];
          $pass_admin    = $_POST['pass'];
      
          // echo $pass_admin;
          // echo $jmeno_admin;
      
      $result=mysql_query("select *
                     from ".PREFIX."heslo
                     where pass = '$pass_admin' and user = '$jmeno_admin'
                    ");
                   
       $row  =  mysql_fetch_row($result);
       if(isset($row[0])){        
       
$orig = '
<fieldset class="fieldset_warning"><legend class="legend_warning">pùvodní data</legend>
<h3><small> prihl.jméno:</small>&nbsp;'.$row[0].'  &nbsp;  <small>heslo:</small>&nbsp;'.$row[1].'</br/><small>email:</small>&nbsp;'.$row[2].'&nbsp;</br/><small>jméno:</small>&nbsp;'.$row[5].'&nbsp;</br/><small>pøijmení:</small>&nbsp;'.$row[6].'</h3>
</fieldset>';
echo $orig;







$form = '<form id="myform" class="cssform" action="page.php?akc=edit_hesla_go" method="post">
<input type="hidden" name="user_old"  value="'.$jmeno_admin.'" size=25 />
<input type="hidden" name="pass_old"  value="'.$pass_admin.'" size=25 />
<input type="hidden" name="ev_c"  value="'.$row[3].'" size=25 />
<input type="hidden" name="funkce"  value="'.$row[4].'" size=25 />


                 <div class="form_contact">
                    <div class="form_row_contact">
                    <label class="left">pøihl. jméno: </label>
                    <input type="text" name="user_edit" value="'.$row[0].'" class="form_input_contact"/>
                    </div>

                    <div class="form_row_contact">
                    <label class="left">heslo</label>
                    <input type="text" name="pass_edit" value="'.$row[1].'" class="form_input_contact" />
                    </div>

                    <div class="form_row_contact">
                    <label class="left">email</label>
                    <input type="text" name="email_edit"  value="'.$row[2].'" class="form_input_contact" />
                    </div>
                    
                    <div class="form_row_contact">
                    <label class="left">jméno</label>
                    <input type="text" name="jmeno_osob_edit"  value="'.$row[5].'" class="form_input_contact" />
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left">pøijmení</label>
                    <input type="text" name="prijmeni_osob_edit"  value="'.$row[6].'" class="form_input_contact" />
                    </div>';
                    
                    
                    
 
                    
                    
$form .= '                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vložit nový" class="form_button" /> 
                    </div>
                  </div>

</form>';



echo $form;
}
else
{
$orig = '
<fieldset class="fieldset_warning"><legend class="legend_warning">data</legend>
<h3>Tyto data byla aktualizována</h3>
</fieldset>';
echo $orig;
}
  


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















