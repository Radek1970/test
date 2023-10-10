
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
<br/>
<?php
 


  $od = $HTTP_REFERER;
  //Je cesta zpìt?
  if($od != null){
  //Naformátujeme adresu
  $parse = parse_url($od);
  $format = $parse['host'];
  //Vra se tam
   echo "<div class=\"zpet\" ><a  href=\"$od\">Zpìt</a></div>";
  }
   
    // test
    //echo $obr;
 
 
    $dotaz ="select * from ".PREFIX."foto where id = '$obr'";
    $result=mysql_query($dotaz);
    $row  =  mysql_fetch_row($result);
    
    $adr = "../foto/";
    echo "<img src='".$adr."".$row[2]."".$row[3]."' alt='$row[1]' title='$row[1]' /></a>";
    
    
    
      
      
?>
        
</div>
<!-- KONEC PRAVA STRANA -->	

















