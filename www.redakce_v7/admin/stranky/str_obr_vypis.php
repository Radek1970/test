
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


     //funkce pro mazani obrazku
     delet_obr($delkompl);






    /**********************************************************************
     *
     * dotaz pro vypis z tabuly
     * 
     **********************************************************************/  
     //echo $ev_c_autora;
    
    
    if(($_SESSION['funkce'] =="redaktor")or($_SESSION['funkce'] =="superredaktor")){                                         
    $dotaz ="select * from ".PREFIX."foto ";
    }
    else{
    $dotaz ="select * from ".PREFIX."foto
                       where ev_c_autora = '$ev_c_autora'  ";
    } 
                   
     $result=mysql_query($dotaz);
 
    /**********************************************************************
    *
    * zjisti pocet zaznamu
    *          
    **********************************************************************/
     $vysldot = @ mysql_num_rows($result);
    
     switch($vysldot):
 case 0:
  $kolik = " není vložen žádný záznam";
 break;
 case 1:
  $kolik = " je jeden záznam.";
 break;
 case 2:
  $kolik = "jsou uloženy $vysldot záznamy.";
 break;
 case 3:
  $kolik = "jsou  uloženy $vysldot záznamy.";
 break;
 case 4:
  $kolik = "jsou  uloženy $vysldot záznamy.";
 break;
 default:
  $kolik = "je uloženo $vysldot záznamù.";
endswitch;
     
      echo "<div class='admin_info'>v databázi  $kolik</div> ";
      
      
      
      
     /********************************************************************
      *
      * podle poctu zaznamu v tabulce na stavi pocet zobrazeni na  srtance
      * pro listovani
      * 
      *******************************************************************/                             
     $kroklimit = 70;
    if($vysldot < 500) $kroklimit = 51;
    if($vysldot < 176) $kroklimit = 23;
    if($vysldot < 133) $kroklimit = 20;
    if($vysldot < 97) $kroklimit = 17;
    if($vysldot < 76) $kroklimit = 14;
    if($vysldot < 30) $kroklimit = 9;
    if($vysldot < 20) $kroklimit = 6;
 
    // listovani 
    $radku = $vysldot;
    $po = $kroklimit; /* poèet øádkù na stránku */ 
    $max_stranek = ceil($radku / $po); /* poèet stránek */ 
    $url_stranka = ($_GET["stranka"] / $po) + 1; /* Aktuální stránka */
 
 
 
    /*********************************************************************
     *
     * zjisti zda existuje promena stranka 
     * v pripade neexistence na stavi promenou
     * na hodnutu nula
     * 
     *********************************************************************/
    // listovani verze                        
    
      if(empty($_GET["stranka"])) {$stranka = 0;} else {$stranka = $_GET["stranka"];} 



    /*********************************************************************
    *    
    *  listovani horni
    *    
    *********************************************************************/  
   
   echo '<div class="listovani"><div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=obr_vypis&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div></div>'; 
   //******************************** KONEC LISTOVANI





   
echo '<form action="page.php?akc=obr_vypis&stranka='.$stranka.'" method="post" >';     

echo '<div class="gallery_admin_menu">';
echo '<input id="all" type="button" value="zaškrtnout vše" onclick="return zaskrtnoutVse();" />

<input id="del" type="reset" value="odznaèit"  />

<input id="del_komplet_button" type="submit" value=" oznaèené záznamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaèené záznamy?\');" />

<a class="insert" href="page.php?akc=obr_upload" >vložit nový obrázek</a>'; 
echo '</div>'; 





$adr = "../foto_min/";


echo '<div class="gallery">';
//$result= mysql_query(  $dotaz." limit $limit, $kroklimit "); 
$result= mysql_query(  $dotaz." limit $stranka, $po ");

//promene urcene pro posouvani
$radek=0; 
$radek=$radek+$stranka;    
if($vysldot != 0){
while  ($row  =  mysql_fetch_row($result)) 
{
$radek++;

 

 
   echo'<div class="photo">'; 
   
   echo "<a href=\"page.php?akc=obr_detail&str=$str&stranka=".$url_cislo."&obr=$row[0]\" >"  ; 
   
   echo "<img src='".$adr."".$row[2]."".$row[3]."' alt='foto' title='$row[1]' /></a>";
   
 echo '<div class="tab_1">';
 echo '<input type="checkbox" value="'.$row[0].'"  name="delkompl[]" /> ';
 echo '<div class="nazev_fota"><p>název: '.$row[1].'</p></div>';
 echo '</div>'; 
 echo'</div>';
        
    
  
}
  }
  else {
 
  echo "<div class='admin_warnnig'>&nbsp;&nbsp;&nbsp; žádné záznamy</div>";
  
  }
echo '</div>';



   
   
   
echo '</form>';   
   

   /*********************************************************************
    *    
    *  listovani dolni
    *    
    *********************************************************************/  
    
   echo '<div class="listovani"><div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=obr_vypis&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div></div>'; 
  //**********************************KONEC LISTOVANI
















?>
        
</div>
<!-- KONEC PRAVA STRANA -->	

















