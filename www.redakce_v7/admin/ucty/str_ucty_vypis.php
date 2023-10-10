

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

   //funkce pro mazani obrazku
     delet_ucet($delkompl);


   
   
   /***********************************************************************
    *
    * at_side1 je nazev uvodni stranky a zaroven nazev tabulky v databazi 
    * pro uvodni stranku Tabulka se nesmi v databazi smazat
    *     
    * hodnota promene $Str je prenesena v url odkaze   
    * nazev tabulky v databazi do ktere ma byt vlozen zaznam
    *   
    * uvodni stranky             
    **********************************************************************/
    
    $nazev_tabulky = "".PREFIX."heslo  ";
   
    /***********************************************************************
    *
    *formatovani nadpisu
    *        
    ***********************************************************************/    
    $dotaz = "select * from ".PREFIX."heslo  ";
    $result=mysql_query($dotaz);            
    $row  =  mysql_fetch_row($result);
    
    
    
      echo'<div id="admin_header">';
    	echo'<div class="admin_index_title">'.$nadpis_stranky .'  </div>';  
      echo'</div>';
     
    
    
    
   /********************************************
   *
   * kod pro zpetny navrat   
   *
    $od = $HTTP_REFERER;
  //Je cesta zpÏt?
  if($od != null){
  //Naform·tujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vraù se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">ZpÏt</a></div>";
  } 
    
    *******************************************/        
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**********************************************************************
     *
     * dotaz pro vypis z tabuly
     * 
     **********************************************************************/                       
    $dotaz ="select * from $nazev_tabulky ";
    $result=mysql_query($dotaz);
       
                    
 
 
    /**********************************************************************
    *
    * zjisti pocet zaznamu
    *          
    **********************************************************************/
     $vysldot = mysql_num_rows($result);
     
     
     if($ev_c_autora == "200901"){
     $vysldotx = $vysldot;
     }
     else{
     $vysldotx = $vysldot-3;// odecteme -3 aby nebyl pocitan i ucet programatora, test a administrator
     }
     
     //$vysldotx = $vysldot;
     
     switch($vysldotx):
 case 0:
  $kolik = " nenÌ vloûen û·dn˝ z·znam";
 break;
 case 1:
  $kolik = " je jeden z·znam.";
 break;
 case 2:
  $kolik = "jsou uloûeny $vysldotx z·znamy.";
 break;
 case 3:
  $kolik = "jsou  uloûeny $vysldotx z·znamy.";
 break;
 case 4:
  $kolik = "jsou  uloûeny $vysldotx z·znamy.";
 break;
 default:
 
  $kolik = "je uloûeno $vysldotx z·znam˘.";
endswitch;
     
      echo "<div class='admin_info'>v datab·zi  $kolik</div>";
     
      
      
      
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
   
   echo '<div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=ucty&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 
   //******************************** KONEC LISTOVANI





   
if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka == $cislo) { 
  
echo'<form id="myform" class="cssform" action="page.php?akc=ucty" method="post" >';
}
}
}
else{
echo'<form id="myform" class="cssform" action="page.php?akc=ucty" method="post" >';
}

/*******************************************************************************************************
 *
 *  ovladaci menu tabulky budeme zobrazovat podle toho kde je prihlase , administrator nebo uzivatel
 *  
 ******************************************************************************************************/  
if(($ev_c_autora != "200903")and($ev_c_autora != "200902") and($funkce == "redaktor")){
echo '<div class="tab_admin_menu">';
//echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="page.php?akc=ucet_nov" >vloûit nov˝ z·znam</a>'; 
echo '</div>'; 
}
else{
echo '<div class="tab_admin_menu">';
echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="page.php?akc=ucet_nov" >vloûit nov˝ z·znam</a>'; 
echo '</div>';
}










echo '<div class="tab_admin_polex">';
//$result= mysql_query(  $dotaz." limit $limit, $kroklimit "); 
$result= mysql_query(  $dotaz." limit $stranka, $po ");

//promene urcene pro posouvani

if($ev_c_autora == "200901"){
     $radek=0;
     }
     else{
     $radek = $radek-3;// odecteme -3 aby nebyl pocitan i ucet programatora, test a administrator
     }

      
 //$radek=0;     
$radek=$radek+$stranka;    
if($vysldot != 0){
while  ($row  =  mysql_fetch_row($result)) 
{
//echo $radek;
$radek++;

/***************************************************
 * vypisovani pro superredaktora = programator webu
 **************************************************/ 
if($ev_c_autora == "200901") { if($funkce = "superredaktor"){
 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 echo '<input type="checkbox" value="'.$row[3].'"  name="delkompl[]" /> ';
 echo '</div>'; 
 echo '<div class="tab_2">';
 echo ''.$radek.'.'.$row[3].'';
 
 if($row[4] == "redaktor"){
 echo 'funkce:&nbsp;<em><span style="color:red; font-weight:bold;">'.$row[4].'';
         if($row[3] == "200903"){echo '&nbsp;&nbsp;admin';}
         if($row[3] == "200902"){echo '&nbsp;&nbsp;test';}
 echo '</span></em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'';}
 else{
 echo 'funkce:&nbsp;<em>'.$row[4].'</em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'';}
 if($row[3] == "200903"){echo '&nbsp;&nbsp;admin';}
 
 echo '</div>';
 echo '<div class="tab_3">'; 
 echo '<a class="edit" href="page.php?akc=ucet_edit&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="editovat" >editovat</a>';
 echo '</div>';
 echo '<div class="tab_4">'; 
 echo '<a class="detail" href="page.php?akc=ucet_detail&str='.$str.'&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="detail" >detail</a>';
 echo '</div>';
 echo '<div class="tab_5">';  
 echo '&nbsp;';
 echo '&nbsp;';
 echo '</div>';
 echo '</div>'; 
}}

/***************************************************
 * vypisovani pro administrator a testovani
 **************************************************/
 if(($ev_c_autora == "200903")or($ev_c_autora == "200902")) { 
 if(($row[3] != "200901") and ($row[3] != "200902") and ($row[3] != "200903"))
 {
 
 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 echo '<input type="checkbox" value="'.$row[3].'"  name="delkompl[]" /> ';
 echo '</div>'; 
 echo '<div class="tab_2">';
 echo ''.$radek.' . ';
 
 
 if($row[4] == "redaktor"){
 echo 'funkce:&nbsp;<em><span style="color:red; font-weight:bold;">'.$row[4].'</span></em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'<br/><span style="color:#DB7417; font-size:10px;">p¯ihl. jmÈno:&nbsp;'.$row[0].'&nbsp;&nbsp;heslo:&nbsp;'.$row[1].'&nbsp;</span>';}
 else{
 echo 'funkce:&nbsp;<em>'.$row[4].'</em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'<br/><span style="color:#DB7417; font-size:10px;">p¯ihl. jmÈno:&nbsp;'.$row[0].'&nbsp;&nbsp;heslo:&nbsp;'.$row[1].'&nbsp;</span>';}
 
 
 
 
 echo '</div>';
 echo '<div class="tab_3">'; 
 echo '<a class="edit" href="page.php?akc=ucet_edit&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="editovat" >editovat</a>';
 echo '</div>';
 echo '<div class="tab_4">'; 
 echo '<a class="detail" href="page.php?akc=ucet_detail&str='.$str.'&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="detail" >detail</a>';
 echo '</div>';
 echo '<div class="tab_5">';  
 echo '&nbsp;';
 echo '&nbsp;';
 echo '</div>';
 echo '</div>'; 
}


}

/***************************************************
 * vypisovani pro redaktora
 **************************************************/
 if(($ev_c_autora != "200903")and($ev_c_autora != "200902") and($funkce == "redaktor")) { if(($row[3] != "200901")and ($row[3] != "200902" ) and ($row[3] != "200903" )){
 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 //echo '<input type="checkbox" value="'.$row[3].'"  name="delkompl[]" /> ';
 echo '</div>'; 
 echo '<div class="tab_2">';
 echo ''.$radek.'.';
 if($row[4] == "redaktor"){
 echo 'funkce:&nbsp;<em><span style="color:red; font-weight:bold;">'.$row[4].'</span></em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'';}
 else{
 echo 'funkce:&nbsp;<em>'.$row[4].'</em><br/>JmÈno:&nbsp;'.$row[5].'&nbsp;&nbsp;P¯ijmenÌ:&nbsp;'.$row[6].'';}
 echo '</div>';
 echo '<div class="tab_3">'; 
 //echo '<a class="edit" href="page.php?akc=ucet_edit&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="editovat" >editovat</a>';
 echo '</div>';
 echo '<div class="tab_4">'; 
 echo '<a class="detail" href="page.php?akc=ucet_detail&str='.$str.'&mujsoubor='.$row[3].'&stranka='.$stranka.'" title="detail" >detail</a>';
 echo '</div>';
 echo '<div class="tab_5">';  
 echo '&nbsp;';
 echo '&nbsp;';
 echo '</div>';
 echo '</div>'; 
}}



 }
  }
  if($radek <= 0) {
  echo '<div class="tab_admin">';
  echo "<h4>&nbsp;&nbsp;&nbsp;V tÈto str·nce nenÌ vloûen û·dn˝ z·znam</h4>";
  echo '</div>';
  }
echo '</div>'; 




/*******************************************************************************************************
 *
 *  ovladaci menu tabulky budeme zobrazovat podle toho kde je prihlase , administrator nebo uzivatel
 *  
 ******************************************************************************************************/  
if(($ev_c_autora != "200903")and($ev_c_autora != "200902") and($funkce == "redaktor")){
echo '<div class="tab_admin_menu2">'; 
//echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="page.php?akc=ucet_nov" >vloûit nov˝ z·znam</a>';   
echo '</div>'; 
}
else{
echo '<div class="tab_admin_menu2">'; 
echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="page.php?akc=ucet_nov" >vloûit nov˝ z·znam</a>';   
echo '</div>';
}
   
 echo '</form>';    
   
   
   
   
   
   

   /*********************************************************************
    *    
    *  listovani dolni
    *    
    *********************************************************************/  
    
   echo '<div class="pagination">';
   if($radku >= $po){
   for($i=0; $i < $max_stranek; $i++) { 
   $cislo = ($i + 1); 
   $url_cislo = ($cislo * $po) - $po; 
   if($url_stranka != $cislo) { 
   echo "<a href=\"page.php?akc=ucty&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 
  //**********************************KONEC LISTOVANI


?>
	
</div>
