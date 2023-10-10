

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
    
    echo'<div id="admin_header">';
    echo'<div class="admin_index_title"> vloûenÌ Ël·nku do str·nky '.$row[2].' </div>';  
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


 $nadpis         = $_POST['nadpis'];
 $text           = $_POST['text'];
 $obraz          = $_POST['obraz'];
 $foto           = $_POST['foto'];
 $vyska          = $_POST['vyska'];
 $delka          = $_POST['delka'];
 $pozice         = $_POST['pozice'];
 $popis          = $_POST['popis'];
 

$cesta = "radek";
echo $cesta;


$form = '<form id="myform" class="cssform" action="page.php?akc=obsah_vlozit&str='.$str.'" method="post">

<input type="hidden" name="strana" size=35 value="'.$str.'" />

<div class="contact_tab">	


                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">nadpis: </label>
                    <input type="text" name="nadpis" value="'.$nadpis.'" class="form_input_contact"/>
                    </div>
                    </div>';
                    
$form .="</div>";


// editor wyzz
$form .='<div class="contact_tab"><textarea id="textfield" name="text" style="height: 270px; width: 650px;" >'.$text.'</textarea>';

$form .='<script language="javascript1.2">';
$form .="make_wyzz('textfield');";
$form .='</script></div>';




//$form .='<script language="javascript1.2">';
//$form .="generate_wysiwyg('textarea1');";
//$form .="</script></div>";


// tiny editor
//$form .='<div class="contact_tab"><textarea id="input" name="text" style="height: 270px; width: 650px;" >'.$text.'</textarea>';
//$form .='<script type="text/javascript"  src="tinyeditor/editor_area.js"></script>';
//$form .="</div>";

//$form .='<div class="contact_tab"><textarea id="noise" name="text" class="widgEditor nothing" style="height: 270px; width: 650px;" >'.$text.'</textarea></div>';


$form .='
<div class="contact_tab">	


                    <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">vloûit obr·zek: </label>';
                    
                    
                    
                    
          if ($obraz == "ano"){          
          $form .=' 
          NE: <input type="radio" name="obraz"  value="ne"  /> 
          ANO: <input type="radio" name="obraz" checked="checked" value="ano" />';
          $form .='</div>';
          $form .= '<div class="form_row_contact">';
          $form .= '<label class="left" >n·zev obr·zku: </label>';
          $form .= '<select name="foto">';
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
                    <input type="text" name="vyska" value="'.$vyska.'"  size="5"/>
                    öÌ¯ka
                    <input type="text" name="delka" value="'.$delka.'" size="5"/>
                     max. rozmÏry 250x250
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left" >pozice: </label>
                    <select name="pozice" class="form_input_contact">
                    <option value="prava">do prava</option>
                    <option value="leva">do leva</option>

                    </select>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form_row_contact">
                    <label class="left">popis: </label>
                    <input type="text" name="popis" value="'.$popis.'" class="form_input_contact"/>
                    </div>';
          
          
          }          
          
           
           
           
           
           
           
           
           
           
           
                   
                    else{
                   $form .=' 
                   NE: <input type="radio" name="obraz" checked="checked" value="ne"  /> 
                   ANO: <input type="radio" name="obraz"  value="ano" />';
                    
$form .='                    </div>';



$form .= '<div class="form_row_contact">';
$form .= '<label class="left">n·zev obr·zku: </label>';
$form .= '<select name="foto" >';
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
                    <input type="text" name="vyska"  size="5"/>
                    öÌ¯ka
                    <input type="text" name="delka" size="5"/>
                    max. rozmÏry 250x250
                    </div>
                    
                    
                    <div class="form_row_contact">
                    <label class="left" >pozice: </label>
                    <select name="pozice" class="form_input_contact">
                    <option value="prava">do prava</option>
                    <option value="leva">do leva</option>

                    </select>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form_row_contact">
                    <label class="left">popis: </label>
                    <input type="text" name="popis" class="form_input_contact"/>
                    </div>';
             }//konec else 
             
                   
$form .='           <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vloûit nov˝" class="form_button" /> 
                    </div>
                    
                    </div>
                    
                    
                    
                    
</div>
</form>';


echo $form;


?>


</div>
