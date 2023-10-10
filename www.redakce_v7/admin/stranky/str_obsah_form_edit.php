

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

        //echo $str;
        //spoËit· poËet znak˘ v ¯etÏzci   
    if(!isset($str)) $str = "at_side1";
    $nazev_tabulky = $str;
   
    /***********************************************************************
    *
    *formatovani nadpisu
    *        
    ***********************************************************************/    
    $nadpis = (substr("$str",4)); // odstrani tzv prefix  prvni tri pozice   
    $dotaz = "select * from ".PREFIX."menu where link = '$nadpis' ";
    $result=mysql_query($dotaz);            
    $row  =  mysql_fetch_row($result);
    
    
    
    if($row[2] ==""){
      echo'<div id="admin_header">';
    	echo'<div class="admin_index_title">editace Ël·nku ze str·nky  bonËnÌ panel</div>';  
      echo'</div>';
     
    }
     else
     {
     
     
     
    
    echo'<div id="admin_header">';
    echo'<div class="admin_index_title"> editace Ël·nku ze str·nky '.$row[2].' </div>';  
    echo'</div>';
    }



     $od = $HTTP_REFERER;
  //Je cesta zpÏt?
  if($od != null){
  //Naform·tujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vraù se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">ZpÏt</a></div>";
  }
  
 //prenesena data z validace 
 $id_edit             = $_POST['id'];
 $strana_edit         = $_POST['strana'];
 
 
 if(!isset($mujsoubor)){
 $nazev_tabulky = $strana_edit;
 $mujsoubor = $id_edit;
 //echo "xxx $nazev_tabulky xx  $mujsoubor  ";

 }
 
  $result=mysql_query("select *
                     from $nazev_tabulky
                     where id = '$mujsoubor'
                    ");
                   
       $row  =  mysql_fetch_row($result);
       
        




$form = '<form id="myform" class="cssform" action="page.php?akc=obsah_vlozit&str='.$str.'&stranka='.$stranka.'" method="post">

<input type="hidden" name="strana_e" size=35 value="'.$str.'" />
<input type="hidden" name="id_e" size=35 value="'.$mujsoubor.'" />

<div class="contact_tab">	


                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">nadpis: </label>
                    <input type="text" name="nadpis_e" value="'.$row[1].'" class="form_input_contact"/>
                    </div>
                    </div>';
                    
$form .="</div>";


// editor wyzz
$form .='<div class="contact_tab"><textarea id="textfield" name="text_e" style="height: 270px; width: 650px;" >'.$row[2].'</textarea>';
$form .='<script language="javascript1.2">';
$form .="make_wyzz('textfield');";
$form .='</script></div>';

//$form .='<script language="javascript1.2">';
//$form .="generate_wysiwyg('textarea1');";
//$form .="</script></div>";

//$form .='<div class="contact_tab"><textarea id="input" name="text_e" style="height: 270px; width: 650px;" >'.$row[2].'</textarea>';
//$form .='<script type="text/javascript" src="tinyeditor/editor_area.js"></script>';
//$form .="</div>";

// editor 1
//$form .='<div class="contact_tab"><textarea id="noise" name="text_e" class="widgEditor nothing" style="height: 270px; width: 650px;" >'.$row[2].'</textarea></div>';


$form .='
<div class="contact_tab">	
   <div class="form_contact">
                    <div class="form_row_contact">
          <label class="left">vloûit obr·zek: </label>';
          
          if($row[3]== 'ano'){
          $form .='
          NE: <input type="radio" name="obraz_e"  value="ne"  /> 
          ANO: <input type="radio" name="obraz_e" checked="checked" value="ano" />';
          $form .='</div>';

          $form .= '<div class="form_row_contact">';
          $form .= '<label class="left">n·zev obr·zku: </label>';
          $form .= '<select name="foto_e">';
          
       //VYPIS ADRESARE FOTO
       $form .= '<option value="'.$row[4].'">zachovat p˘vodnÌ obr·zek - '.$row[4].'</option>';

       $adr ="../foto/";
       $handle=opendir($adr); 
       while (false!==($file = readdir($handle))) 
       { 
         //spocita pocet znaku v nazvu pred teckou
         $pocet_znaku = StrPos ($file,".");
         $nazev=substr($file, 0, $pocet_znaku);

    if ($file != "." && $file != "..") 
    { 
    $form .= '<option value="'.$nazev.'">'.$nazev.'</option>';    
    } 
       }
       closedir($handle);  
 
         $form .='</select></div>';
         
         
         
         $form .='	
                    
                    
                    <div class="form_row_contact">
                    <label class="left">rozmÏry: </label>
                    v˝öka
                    <input type="text" name="vyska_e" value="'.$row[5].'"  size="5"/>
                    öÌ¯ka
                    <input type="text" name="delka_e" value="'.$row[6].'" size="5"/>
                    max. rozmÏry 250x250
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left" >pozice: </label>
                    <select name="pozice_e" class="form_input_contact">
                    <option value="'.$row[7].'">zachovat p˘vodnÌ zarovn·nÌ do '.$row[7].'</option>
                    <option value="prava">do prava</option>
                    <option value="leva">do leva</option>

                    </select>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form_row_contact">
                    <label class="left">popis: </label>
                    <input type="text" name="popis_e" value="'.$row[8].'" class="form_input_contact"/>
                    </div>
                    </div>
                    
                    
                    <div class="form_row_foto">
<img   src="../foto/'.$row[4].'.jpg"  alt="foto" title="foto" width="'.$row[6].'" height="'.$row[5].'" />
                    </div>';
         
         
          }//konec IF
          
          else
          {
          $form .='
          NE: <input type="radio" name="obraz_e" checked="checked" value="ne"  /> 
          ANO: <input type="radio" name="obraz_e"  value="ano" />';
                  
          $form .='</div>';

          $form .= '<div class="form_row_contact">';
          $form .= '<label class="left">n·zev obr·zku: </label>';
          $form .= '<select name="foto_e">';
          $form .= '<option value="bez"></option>';

       //VYPIS ADRESARE FOTO
       $adr ="../foto/";
       $handle=opendir($adr); 
       while (false!==($file = readdir($handle))) 
       { 
         //spocita pocet znaku v nazvu pred teckou
         $pocet_znaku = StrPos ($file,".");
         $nazev=substr($file, 0, $pocet_znaku);

    if ($file != "." && $file != "..") 
    { 
    $form .= '<option value="'.$nazev.'">'.$nazev.'</option>';    
    } 
       }
       closedir($handle);  
 
         $form .='</select></div></div>';
          





$form .='	
                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">rozmÏry: </label>
                    v˝öka
                    <input type="text" name="vyska_e"  size="5"/>
                    öÌ¯ka
                    <input type="text" name="delka_e" size="5"/>
                    max. rozmÏry 250x250
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left" >pozice: </label>
                    <select name="pozice_e" class="form_input_contact">
                    <option value="prava">do prava</option>
                    <option value="leva">do leva</option>

                    </select>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form_row_contact">
                    <label class="left">popis_e: </label>
                    <input type="text" name="popis" class="form_input_contact"/>
                    </div>';
                    
                 }//konec else
   
                    
                    
                    
$form .='             

       
       <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="editovat" class="form_button" /> 
                    </div>
                    
                    </div>
                    
                    
                    
                    
</div>
</form>';


echo $form;


?>


</div>
