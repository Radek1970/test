
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
   
   delet_anketa($delanketa);
   aktivace_anketa($aktivace,$dotaz,$spojeni);
   deaktivace_anketa($deaktivace,$dotaz,$spojeni);
   nova_anketa($form_nova_anketa,$dotaz,$spojeni );
   
  
   global   $limit;
   
   
   
   
   
   
  
   
   
   
   
   
   
   
   
   
   
   /***********************************************************************
    *
    * PREFIX.side1 je nazev uvodni stranky a zaroven nazev tabulky v databazi 
    * pro uvodni stranku Tabulka se nesmi v databazi smazat
    *                
    **********************************************************************/
    
  
 
   
   $dotaz ="select * from ".PREFIX."anketa ";
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
   echo "<a href=\"page.php?akc=anketa&stranka=".$url_cislo."\">".($i + 1)."</a>"; 
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
   

echo'<form id="myform" class="cssform" action="page.php?akc=anketa&stranka='.$url_cislo.'" method="post" >';

echo '<div class="tab_admin_menuB">';
echo '<input id="all" type="button" value="zaškrtnout vše" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaèit"  /><input id="del_komplet_button" type="submit" value=" oznaèené záznamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaèené záznamy?\');" />

<a class="insert" href="page.php?akc=nova_anketa&str='.$url_cislo.'&mujsoubor='.$row[0].'" >vložit nový záznam</a>'; 
echo '</div>'; 








$result= mysql_query(  $dotaz." limit $stranka, $po ");

//promene urcene pro posouvani
$radek=0; 
$radek=$radek+$stranka;    
echo '<div class="tab_admin_pole">';
while  ($row  =  mysql_fetch_row($result)) 
{
$radek++;



 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 
 echo '<input type="checkbox" value="'.$row[0].'"  name="delanketa[]" /> ';

 echo '</div>'; 
 echo '<div class="tab_2">';
 echo 'id'.$row[0].'-';
 echo 'anketní otázka:&nbsp;&nbsp;'.$row[1].'<br/> celkem hlasù: &nbsp;'.$row[9].'';
     
 echo '</div>';
 
 
 echo '<div class="tab_3">'; 
 //echo '<a class="edit" href="page.php?akc=edit_stranka&mujsoubor='.$row[0].''. $row[1].''. $row[2].'" >editovat</a>';
 echo '</div>';
 
 echo '<div class="tab_5">';
 
 if ($row[10] == "aktivni"){
 echo ''.$row[10].'<input type="radio" name="deaktivace" value="'.$row[0].'"  > '; 
 echo '<input type="submit" name="finish_active" value="deaktivuj"  />';
 }
 else{
 echo ''.$row[10].'<input type="radio" name="aktivace" value="'.$row[0].'" > ';
 
 echo '<input type="submit" name="finish_active" value="aktivuj"  />';
 }

 echo '</div>';
 echo '</div>'; 
}
echo '</div>'; 

echo '<div class="tab_admin_menuB2">'; 
echo '<input id="all" type="button" value="zaškrtnout vše" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaèit"  /><input id="del_komplet_button" type="submit" value=" oznaèené záznamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaèené záznamy?\');" />

<a class="insert" href="page.php?akc=nova_anketa&str='.$url_cislo.'&mujsoubor='.$row[0].'" >vložit nový záznam</a>'; echo '</div>';    
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
   echo "<a href=\"page.php?akc=anketa&stranka=".$url_cislo."\">".($i + 1)."</a>"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 


  


?>
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















