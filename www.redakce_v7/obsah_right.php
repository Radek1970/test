<?php

if($jazyk==en){
//echo "verze:ES";
   
       $result=mysql_query("select *
                     from at_side_right
                    ");
                   
       while  ($row  =  mysql_fetch_row($result))
       {
       if($row[7]==ano){ 
       if($row[3]==ano){
       echo '<div class="box"><div class="box_title">'.$row[8].'</div>';
 
       obraz($row[4],$row[5],$row[6]); //preda parametry pro obraz do funkce

       echo '<div class="box_content">'.$row[9].'</div></div>';
       }
  
       else{
       echo '<div class="box"><div class="box_title">'.$row[8].'</div>';
       echo '<div class="box_content">'.$row[9].'</div></div>';
       } 
                       }
       else{
       if($row[3]==ano){
       echo '<div class="box"><div class="box_title">'.$row[1].'</div>';
 
       obraz($row[4],$row[5],$row[6]); //preda parametry pro obraz do funkce

       echo '<div class="box_content">'.$row[2].'</div></div>';
       }
  
       else{
       echo '<div class="box"><div class="box_title">'.$row[1].'</div>';
       echo '<div class="box_content">'.$row[2].'</div></div>';
       } 
       }
  }  
    
   




 }
 
 
 
 








 
 
else{
//echo "verze:CZ";
 
         
       $result=mysql_query("select *
                     from ".PREFIX."side_right
                    ");
                    
       while  ($row  =  mysql_fetch_row($result))
       {
       if($row[3]==ano){
       echo '<h1>'.$row[1].'</h1>';
       
      
       
        obrazII($row[4],$row[5],$row[6],$row[7],$row[8]); //preda parametry pro obraz do funkce

       echo '<p>'.$row[2].'</p>';
       }
  
       else{
       echo '<h1>'.$row[1].'</h1>';
       echo '<p>'.$row[2].'</p>';
       } 
       }  
  
 }
  
  
  
  
  
  
  
  
  
  
  
   anketa($hlas,$id,$dotaz,$spojeni,$kontrola);
 
  
  
 
?>
