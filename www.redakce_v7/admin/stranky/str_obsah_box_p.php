
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
 
 
<?

 if(($_SESSION['funkce'] =="redaktor")or($_SESSION['funkce'] =="superredaktor")){   
echo '<div class="tab_obsah_popis" >';
echo '<p>Bo�n� panel str�nek</p></div>';       
    
    
    
    echo '<div class="tab_obsah" >';
    echo '<div class="tab_obsah2" ></div>';
    echo '<div class="tab_obsah1" ><a href="page.php?akc=obsah_vypis&str='.PREFIX.'side_right ">prav� pole</a></div>';
    echo '<div class="tab_obsah3" ><a href="page.php?akc=obsah_vypis&str='.PREFIX.'side_right ">otev��t</a></div>';
    echo '</div>'; 
    
    
    
    
    
    
}    
    
    
 
             
?>
 
 
 
 
		
			     
 
 
        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















