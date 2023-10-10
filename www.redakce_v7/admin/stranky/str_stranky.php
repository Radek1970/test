
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


   /***********************************************************************
    *
    * VLOZENI OBSLUZNYCH FUNKCI
    * FUNKCE MAZANI ZAZNAMU
    * FUNKCE PRO VYTVORENI NOVEHO ZAZNAMU
    * FUNKCE PRO EDITACI ZAZNAMU
    * FUNKCE PRO POSUN NAHORU A DOLU                
    *                
    **********************************************************************/
   
   delet_str($delkompl,$nazev_tabulky);
   nova_str($jmeno,$popis,$key_slova,$formular_kontakt,$galerie);
   editace_str($jmeno_e,$popis_e,$link_e,$id_e,$key_slova_e,$formular_kontakt_e,$galerie_e);
   
   posun_down_str($cislo_radku_minus);
   posun_up_str($cislo_radku_plus);
   
   global   $limit;
   
   
   
   
   
   
  
   
   
   
   
   
   
   
   
   
   
   /***********************************************************************
    *
    * PREFIX.side1 je nazev uvodni stranky a zaroven nazev tabulky v databazi 
    * pro uvodni stranku Tabulka se nesmi v databazi smazat
    *                
    **********************************************************************/
    
  
 
   
   $dotaz ="select * from ".PREFIX."menu ";
   $result=mysql_query($dotaz);
       
                    
 
 
    /**********************************************************************
    *
    * zjisti pocet zaznamu
    *          
    **********************************************************************/
     $vysldot = mysql_num_rows($result);
     
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
     
      
     echo "<div class='admin_info'>v databázi  $kolik</div>";
     
  
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
    if($vysldot < 22) $kroklimit = 6;
 
 
 
     /********************************************************************
      *
      * LISTOVANI
      * 
      *******************************************************************/
    $radku = $vysldot;
    $po = $kroklimit; /* poèet øádkù na stránku */ 
    $max_stranek = ceil($radku / $po); /* poèet stránek */ 
    $url_stranka = ($_GET["stranka"] / $po) + 1; /* Aktuální stránka */
 
 
    if(empty($_GET["stranka"])) {$stranka = 0;} else {$stranka = $_GET["stranka"];} 
    
    if(!isset($limit)) $limit = 0;
    
    echo '<div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=stranky&stranka=".$url_cislo."\">".($i + 1)."</a>"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 

   

  

     /********************************************************************
      *
      * ZACATEK TABULKY
      * 
      *******************************************************************/
   

echo'<form id="myform" class="cssform" action="page.php?akc=stranky" method="post" >';

echo '<div class="tab_admin_menuB">';
echo '<input id="all" type="button" value="zaškrtnout vše" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaèit"  /><input id="del_komplet_button" type="submit" value=" oznaèené záznamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaèené záznamy?\');" /><a class="insert" href="page.php?akc=nova_stranka&str='.$str.'&mujsoubor='.$row[0].'" >vytvoøit stránku</a><a class="insert_foto" href="page.php?akc=nova_stranka_gal&str='.$str.'&mujsoubor='.$row[0].'" >vložit galerii</a>'; 
echo '</div>'; 








$result= mysql_query(  $dotaz." limit $stranka, $po ");

//promene urcene pro posouvani
$radek=0; 
$radek=$radek+$stranka;    
echo '<div class="tab_admin_pole">';
if($vysldot == "0")
{
echo '<div class="tab_admin">';
echo "<h4>&nbsp;&nbsp;&nbsp;není vytvoøena žádná stránka</h4>";
echo '</div>';
}
while  ($row  =  mysql_fetch_row($result)) 
{
$radek++;

 

 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 //if ($row[0]=="1"){
 //echo '';
 //}
 //else{
 echo '<input type="checkbox" value="'.$row[0].'-'.$row[1].'"  name="delkompl[]" /> ';
//}
 echo '</div>'; 
 
 
 
 echo '<div class="tab_2">';
 echo ' název:&nbsp;';
 if($row[6] == ano){
    echo '<a href="page.php?akc=obsah_vypis_galerie&str='.PREFIX.$row[1].'" title="vložit obsah">'.$row[2].'</a>';
    }
    else{
    echo '<a href="page.php?akc=obsah_vypis&str='.PREFIX.$row[1].'" title="vložit obsah">'.$row[2].'</a>';
    }
 
 
 if($row[5] == ano){
    echo '<span>&nbsp;&nbsp;<img src="css/images/formul.png" />&nbsp;&raquo; kontakní formuláø</span>';
    }
    
if($row[6] == ano){
    echo '<span>&nbsp;&nbsp;<img src="css/images/fotka.png" />&nbsp;&raquo; foto galerie</span>';
    }    
 echo '</div>';
 
 
 
 
 
 echo '<div class="tab_3">'; 
 echo '<a class="edit" href="page.php?akc=edit_stranka&mujsoubor='.$row[0].'" >editovat</a>';
 echo '</div>';
 
 echo '<div class="tab_5">';
 echo '<a  href="page.php?akc=stranky&cislo_radku_minus='.$radek.'&stranka='.$stranka.' " title="posun dolu" >&nbsp;<img src="css/images/a2d.gif" /></a>'; 
 
 echo '<a  href="page.php?akc=stranky&cislo_radku_plus='.$radek.'&stranka='.$stranka.' " title="posun dolu" >&nbsp;<img src="css/images/a2u.gif" /></a>'; 
 
 echo '</div>';
 echo '</div>'; 
}
echo '</div>'; 

echo '<div class="tab_admin_menuB2">'; 
echo '<input id="all" type="button" value="zaškrtnout vše" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaèit"  /><input id="del_komplet_button" type="submit" value=" oznaèené záznamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaèené záznamy?\');" /><a class="insert" href="link_form.php?str='.$str.'&mujsoubor='.$row[0].'" >vytvoøit stránku</a><a class="insert_foto" href="page.php?akc=nova_stranka_gal&str='.$str.'&mujsoubor='.$row[0].'" >vložit galerii</a>';   
echo '</div>';    
 echo '</form>';    
   
   
   
   
   
   
     /********************************************************************
      *
      * DOLNI LISTOVANI
      * 
      *******************************************************************/
   
   echo '<div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=stranky&stranka=".$url_cislo."\">".($i + 1)."</a>"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 


  


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















