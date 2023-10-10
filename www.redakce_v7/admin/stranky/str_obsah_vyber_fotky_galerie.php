

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

    //foto_do_gal($fotokompl,$jmeno_galerie);


 
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
    	echo'<div class="admin_index_title_foto">'.$nadpis_stranky .' '.$row[2].'</div>';  
      echo'</div>';
      
      
     //preneseno z url
       $name_gal;



    
    
    
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
  $kolik = " nenÌ vloûen û·dn˝ z·znam";
 break;
 case 1:
  $kolik = " je jeden z·znam.";
 break;
 case 2:
  $kolik = "jsou uloûeny $vysldot z·znamy.";
 break;
 case 3:
  $kolik = "jsou  uloûeny $vysldot z·znamy.";
 break;
 case 4:
  $kolik = "jsou  uloûeny $vysldot z·znamy.";
 break;
 default:
  $kolik = "je uloûeno $vysldot z·znam˘.";
endswitch;
     
      echo "<div class='admin_info'>v datab·zi  $kolik</div> ";
      
      /********************************************
      *
      * kod pro zpetny navrat   
      *
      *******************************************/        
     
     $cesta_zpet = PREFIX.$name_gal;
     //echo $cesta_zpet;
     //Vraù se tam
     echo "<div class=\"zpet\" ><a  href=\"page.php?akc=obsah_vypis_galerie&str=$cesta_zpet\">ZpÏt</a></div>";
      
      
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
    $po = $kroklimit; /* poËet ¯·dk˘ na str·nku */ 
    $max_stranek = ceil($radku / $po); /* poËet str·nek */ 
    $url_stranka = ($_GET["stranka"] / $po) + 1; /* Aktu·lnÌ str·nka */
 
 
 
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
   echo "<a href=\"page.php?akc=obr_vyber_do_galerie&name_gal=$name_gal&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div></div>'; 
   //******************************** KONEC LISTOVANI





   
echo '<form action="page.php?akc=obr_vloz_do_galerie&name_gal='.$name_gal.'" method="post" >';     
echo '<input  type="hidden"  name="jmeno_galerie" value="'.$name_gal.'" />';

echo '<div class="gallery_admin_menu_vlozeni">';
echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" />

<input id="del" type="reset" value="odznaËit"  />

<input class="insert"  type="submit" value=" vloûit foto " title="vloûit" />

'; 
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
   echo '<input type="checkbox" value="'.$row[0].'"  name="fotokompl[]" /> ';
   echo '<div class="nazev_fota"><p>n·zev: '.$row[1].'</p></div>';
   //id prihlaseneho
   //echo ''.$row[6].'';
   echo '</div>'; 
   echo'</div>';
        
    
  
}
  }
  else {
 
  echo "<div class='admin_warnnig'>&nbsp;&nbsp;&nbsp; û·dnÈ z·znamy</div>";
  
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
   echo "<a href=\"page.php?akc=obr_vyber_do_galerie&name_gal=$name_gal&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div></div>'; 
  //**********************************KONEC LISTOVANI














    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    











?>
	
</div>
