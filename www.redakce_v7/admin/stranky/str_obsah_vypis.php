

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



 // funkce pro pusun a mazani vkladani
 posun_up($cislo_radku_plus,$nazev_tabulky);
 posun_down($cislo_radku_minus,$nazev_tabulky);
 delet($delkompl,$nazev_tabulky,$ev_c_autora);
 insert_text($strana,$dotaz,$spojeni,$ev_c_autora);
 edit_text($strana_e,$dotaz,$spojeni);
 
   
   global   $str; $stranka;
   //global   $limit;
   
   
   /***********************************************************************
    *
    * at_side1 je nazev uvodni stranky a zaroven nazev tabulky v databazi 
    * pro uvodni stranku Tabulka se nesmi v databazi smazat
    *     
    * hodnota promene $Str je prenesena v url odkaze   
    * nazev tabulky v databazi do ktere ma byt vlozen zaznam
    *   
    * isset zjisti zda hodnota existuje a pokud ne nastvi ji na nazev tabulky
    * uvodni stranky             
    **********************************************************************/
    if(!isset($str)) $str = PREFIX."side1";
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
    	echo'<div class="admin_index_title">P¯ehled str·nky bonËnÌ box</div>';  
      echo'</div>';
     
    }
     else
     {
      echo'<div id="admin_header">';
    	echo'<div class="admin_index_title">'.$nadpis_stranky .' <span style="color:#ff6600";>'.$row[2].'</span> </div>';  
      echo'</div>';
     
     
     }
    
    
    
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
     * v pripade ze prihlaseny nema funkci redaktor nebo superredaktor
     * vypisou se zaznamy jen s evidecnim cislem autora
     * vypisou se jen clanky ktere vytvoril prihlasen autor          
     **********************************************************************/ 
     
     
      $dotaz ="select * from $nazev_tabulky  ";
    
     //$dotaz ="select * from $nazev_tabulky,".PREFIX."heslo
     //                  where (ev_c_autora = ev_c) ";
                                     
     //$dotaz ="select * from $nazev_tabulky ";
      $result=mysql_query($dotaz);
     
     
                       // dotaz i s vypsanim jmena autor  z druehe tabulky heslo
                       //$dotaz ="select * from $nazev_tabulky,".PREFIX."heslo
                       //where (ev_c_autora = '$ev_c_autora') and (ev_c_autora = ev_c) ";
       //$dotaz ="select * from $nazev_tabulky where ev_c_autora = '$ev_c_autora' ";  
       //$result=mysql_query($dotaz);
     
     
       
                    
 
 
    /**********************************************************************
    *
    * zjisti pocet zaznamu
    *          
    **********************************************************************/
     $vysldot = mysql_num_rows($result);
    
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
 
    // listovani verze 2
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
   echo "<a href=\"page.php?akc=obsah_vypis&str=$str&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 
   //******************************** KONEC LISTOVANI





   
     
echo'<form id="myform" class="cssform" action="page.php?akc=obsah_vypis&str='.$str.'" method="post" >';

echo '<input name="nazev_tabulky" type="hidden" value="'.$str.'" />';

echo '<div class="tab_admin_menu">';
echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="page.php?akc=obsah_form&str='.$str.'" >vloûit nov˝ z·znam</a>'; 
echo '</div>'; 












echo '<div class="tab_admin_polex">';
//$result= mysql_query(  $dotaz." limit $limit, $kroklimit "); 
$result= mysql_query(  $dotaz." limit $stranka, $po ");

//promene urcene pro posouvani
$radek=0; 
$radek=$radek+$stranka;    
if($vysldot != 0){
while  ($row  =  mysql_fetch_row($result)) 
{
$radek++;

$delak_vypisu = "150";// urcuje delku vypisu
$texty = (strip_tags("$row[2]")) ;// ostrani html znaky
 // vypÌöe 'text'

$text = (substr("$texty",0,$delak_vypisu));//vypise prvnich 160 znaku retezce
//echo "$text";
 
$znak = " ";// hledany znak mezera
$posledni_vyskyt = StrRPos($text, $znak); //najde posledni znak v retezci tedy tecku a vypise cislo pozice
$pozice = $delak_vypisu - $posledni_vyskyt; //odecte cislo pozice tecky od delky retezce
$konec = $delak_vypisu - $pozice;//vysledek odecte od 160 - vysledek je delka vypisovaneho retezce
$vypis = (substr("$text",0,$konec));// na zaklade vypoctu urci delku vypisovaneho retezce


//echo "$vypis";














 echo '<div class="tab_admin">';
 echo '<div class="tab_1">';
 if(($row[9] == $ev_c_autora)or($funkce =="redaktor")or($funkce =="superredaktor")){ 
 echo '<input type="checkbox" value="'.$row[0].'"  name="delkompl[]" /> ';
 }
  echo '</div>'; 
 
 

 


if(($row[9] == $ev_c_autora)or($funkce =="redaktor")or($funkce =="superredaktor")){ 

 echo '<div class="tab_2">';
 echo '';
 echo ''.$radek.'. Ël·nek s nadpisem: &nbsp;';
  
  //jeli nadpis prazdny napise hlasku
  if( ($row[1] == " ") or (!strlen ($row[1]) ) ){
       echo '<em><b>bez nadpisu</b></em><br/>';
      }
  else{
       echo '<em><u>'.$row[1].'</u></em><br/>';
      }
 
 echo ''.$vypis.'...<br/><p> <a class="detail_small" href="page.php?akc=obsah_detail&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="detail" ></a></p><br/>';
 echo '</div>';

 echo '<div class="tab_3">'; 
 echo '<a class="edit" href="page.php?akc=obsah_editace&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="editovat" >editovat</a>';
 echo '</div>';
 echo '<div class="tab_4">'; 
 echo '<a class="detail" href="page.php?akc=obsah_detail&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="detail" >detail</a>';
 echo '</div>';
}
else{

 echo '<div class="tab_2">';
 echo '';
 echo ''.$radek.'. Ël·nek s nadpisem: &nbsp;';
 echo '<em>'.$row[1].'</em><br/>';
 echo '<em>'.$vypis.'</em><br/> <p> <a class="detail_small" href="page.php?akc=obsah_detail&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="detail" >[&nbsp;.... vÌce v detilu] </a></p><br/>';
 echo '</div>';

 echo '<div class="tab_3">'; 
 //echo '<a class="edit" href="page.php?akc=obsah_editace&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="editovat" >editovat</a>';
 echo '</div>';
 echo '<div class="tab_4">'; 
 echo '<a class="detail" href="page.php?akc=obsah_detail&str='.$str.'&mujsoubor='.$row[0].'&stranka='.$stranka.'" title="detail" >detail</a>';
 echo '</div>';

}










 
 echo '<div class="tab_5">';  
 echo '&nbsp;posun&nbsp;<a href="page.php?akc=obsah_vypis&str='.$str.'&cislo_radku_plus='.$radek.'&nazev_tabulky='.$nazev_tabulky.'&stranka='.$stranka.' " title="posun nahoru" ><img src="css/images/a2u.gif" /></a>';
 
 echo '<a  href="page.php?akc=obsah_vypis&str='.$str.'&cislo_radku_minus='.$radek.'&nazev_tabulky='.$nazev_tabulky.'&stranka='.$stranka.' " title="posun dolu" >&nbsp;<img src="css/images/a2d.gif" /></a>';
 echo '</div>';
 echo '</div>'; 
}
  }
  else {
  echo '<div class="tab_admin">';
  echo "<h4>&nbsp;&nbsp;&nbsp;V tÈto str·nce nenÌ vloûen û·dn˝ z·znam</h4>";
  echo '</div>';
  }
echo '</div>'; 




echo '<div class="tab_admin_menu2">'; 
echo '<input id="all" type="button" value="zaökrtnout vöe" onclick="return zaskrtnoutVse();" /><input id="del" type="reset" value="odznaËit"  /><input id="del_komplet_button" type="submit" value=" oznaËenÈ z·znamy smazat" title="smazat" onclick="return confirm(\'Opravdu chcete smazat oznaËenÈ z·znamy?\');" /><a class="insert" href="clanek_insert_form.php?str='.$str.'&mujsoubor='.$row[0].'" >vloûit nov˝ z·znam</a>';   
echo '</div>';    
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
   echo "<a href=\"page.php?akc=obsah_vypis&str=$str&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
   } else { 
   echo "<span class=\"current\">".($i + 1)."</span>"; 
   } 
   }
   } 
   echo '</div>'; 
  //**********************************KONEC LISTOVANI


?>
	
</div>
