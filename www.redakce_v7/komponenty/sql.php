<?php

      /*
       pripojeni a nastaveni pristupovych prav do databaze 
      */ 
       include_once('admin/sql/sql.php');
       
       
      
 
      
    
    
    /* funkce pro nacteni uvodniho obsahu
    neni-li promena $side naplnena provedeme naplneni 
    nactenim prvniho radku z tabulky menu ze sloupce 
    pro nazev stranky nacteme nazev a vloyimeho do romene $side
    
    stranka ktera je naprvni miste v tabulce menu je brana jako uvodni
    */
      
    $dotaz = "select * from ".PREFIX."menu ";
    $result=mysql_query($dotaz);            
    
    //zjisti poce zaznamu v databazi    
    $pocet_stranek = mysql_num_rows($result);
   
    if($pocet_stranek >= "1")
    { 
    for ($i = 1; $i <= 1; $i++)
      {
    $row  = @  mysql_fetch_row($result);
    $uvodni_stranka = "".PREFIX.$row[1]."";
      } 
    //echo $uvodni_stranka;
    if(!isset($side)) $side = $uvodni_stranka;
    }  
   
 
 
 
 
 
 
      
?>
