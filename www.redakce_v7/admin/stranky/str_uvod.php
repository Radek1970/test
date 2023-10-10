
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
    	<div class="admin_addoffer_title"><? echo $nadpis_stranky; ?></div>    
</div> 
  
 
<h1>ÚVODNÍ STRÁNKA</h1>
		<p>pøehled</p>
    
			<?php
			$result=mysql_query("select * from ".PREFIX."menu");            
      $row  =  mysql_fetch_row($result);
      $pocet  =  mysql_num_rows($result);  
      
      $result=mysql_query("select * from ".PREFIX."menu where galerie = 'ano' ");            
      $row  =  mysql_fetch_row($result);
      $pocetx  =  mysql_num_rows($result); 
      
			
			
			
			 
     switch($pocet):
 case 0:
  $pocet_str = " není vytvoøena žádná stránka";
 break;
 case 1:
  $pocet_str = " je vytvoøena jedna stránka";
 break;
 case 2:
  $pocet_str = "jsou vytvoøeny $pocet stránky";
 break;
 case 3:
  $pocet_str = "jsou vytvoøeny $pocet stránky";
 break;
 case 4:
  $pocet_str = "jsou vytvoøeny $pocet stránky";
 break;
 default:
  $pocet_str = "je vytvoøeno $pocet stránek";
endswitch;
     
     
switch($pocetx):
 case 0:
  $pocet_gal = "a není vytvoøena žádná fotogalerie";
 break;
 case 1:
 $pocet_gal = " z toho $pocetx fotogalerie";
 break;
 case 2:
  $pocet_gal = "z toho $pocetx fotogalerie";
 break;
 case 3:
  $pocet_gal = "z toho $pocetx fotogalerie";
 break;
 case 4:
  $pocet_gal = "z toho $pocetx fotogalerie";
 break;
 default:
  $pocet_gal = "z toho $pocetx fotogalerií";
endswitch;			
			
			
			
			
			
			echo "<p>$pocet_str $pocet_gal</p>";
      ?>			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















