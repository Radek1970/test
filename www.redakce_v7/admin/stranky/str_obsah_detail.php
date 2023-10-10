

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
    
  
    //echo "<h2>detail str·nky ".$row[2]."</h2> ";
    if($row[2] ==""){
      echo'<div id="admin_header">';
    echo'<div class="admin_index_title">detail textu ze str·nky boËnÌ panel</div>';  
    echo'</div>';
     }
     else
     {
     echo'<div id="admin_header">';
     echo'<div class="admin_index_title"> detail textu ze str·nky '.$row[2].' </div>';  
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

  
  
  
  
  
  
  
  
  
  
  
  
  
  
      
     $result=mysql_query("select *
                     from $nazev_tabulky
                     where id = '$mujsoubor'
                    ");
                   
    $row  =  mysql_fetch_row($result);
        
    if($row[3]==ano){
 
 
  
  
 
 
 echo '<div class="promo'.$row[7].'">';
 echo "<h2>n·zev: $row[1]</h2>";
 echo '<p>';
 echo '<img   src="../foto/'.$row[4].'.jpg"  alt="foto" title="foto" width="'.$row[6].'" height="'.$row[5].'" />'.$row[2].'</p>';

 echo '<q>';
 echo 'popis obr·zku:'.$row[8].'</q>';
 echo '</div>';
 
 } 
 else{
  
  
  
 echo '<div class="promo">';
 
 echo "<h2>n·zev: $row[1]</h2>";
 echo '<p>';
 echo ''.$row[2].'</p>';

 echo '</div>';
 
 } 



?>

</div>
