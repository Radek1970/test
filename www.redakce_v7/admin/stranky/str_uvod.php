
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
  
 
<h1>�VODN� STR�NKA</h1>
		<p>p�ehled</p>
    
			<?php
			$result=mysql_query("select * from ".PREFIX."menu");            
      $row  =  mysql_fetch_row($result);
      $pocet  =  mysql_num_rows($result);  
      
      $result=mysql_query("select * from ".PREFIX."menu where galerie = 'ano' ");            
      $row  =  mysql_fetch_row($result);
      $pocetx  =  mysql_num_rows($result); 
      
			
			
			
			 
     switch($pocet):
 case 0:
  $pocet_str = " nen� vytvo�ena ��dn� str�nka";
 break;
 case 1:
  $pocet_str = " je vytvo�ena jedna str�nka";
 break;
 case 2:
  $pocet_str = "jsou vytvo�eny $pocet str�nky";
 break;
 case 3:
  $pocet_str = "jsou vytvo�eny $pocet str�nky";
 break;
 case 4:
  $pocet_str = "jsou vytvo�eny $pocet str�nky";
 break;
 default:
  $pocet_str = "je vytvo�eno $pocet str�nek";
endswitch;
     
     
switch($pocetx):
 case 0:
  $pocet_gal = "a nen� vytvo�ena ��dn� fotogalerie";
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
  $pocet_gal = "z toho $pocetx fotogaleri�";
endswitch;			
			
			
			
			
			
			echo "<p>$pocet_str $pocet_gal</p>";
      ?>			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















