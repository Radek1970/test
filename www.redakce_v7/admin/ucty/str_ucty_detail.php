

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

    
    echo'<div id="admin_header">';
    	echo'<div class="admin_index_title">'.$nadpis_stranky .'  </div>';  
      echo'</div>';
  
     
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
                     from ".PREFIX."heslo
                     where ev_c = '$mujsoubor'
                    ");
                    
while  ($row  =  mysql_fetch_row($result))
{

 $orig_new = '
<div class="admin_warnnig">
detail:<br/>
<h3><small> ev.Ë:</small>&nbsp;'.$row[3].'&nbsp;  </br/><small>email:</small>&nbsp;'.$row[2].'&nbsp;<small>jmÈno:</small>&nbsp;'.$row[5].'&nbsp;<small>p¯ijmenÌ:</small>&nbsp;'.$row[6].'&nbsp;<small>funkce:</small>&nbsp;'.$row[4].'&nbsp;</h3></div>';
echo $orig_new;
 
} 
 



?>

</div>
