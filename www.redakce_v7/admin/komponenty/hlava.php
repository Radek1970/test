
<div id="header">

       <div id="logo">
      
       </div>
           
       <div class="banner_adds"><h1>administrace verze 2.06.10</h1></div> 
<?php        
                   $send = '<form id="formular" action="send_password.php" method="post">';
                    $send .= '<div id="send_password">';
                    $send .= '<p>ádost o zaslání zapomenutého hesla </p>';
                    $send .= '<div style="float:left; padding:1px 5px 0 0;">';
                    $send .= '<label>email: </label>';
                    $send .= '<input type="text"  name="email"  />';
                    $send .= '</div>';
                    $send .= '<div style="float:right; padding:1px 20px 0 0;">';
                    $send .= '<input type="image" title="vstup" src="css/images/send_password.gif" />';
                    $send .= '</div>';
                    $send .= '</div></form>';
                    
                    
      
       if((isset($_SESSION['jmeno_user'])) and (isset($_SESSION['pass']))){ 
       
       			// pripojeni sekce menu..
            include_once('komponenty/menu_line.php');   

      }
      else{
      echo $send;
      }
      
      
      
      
      
      
      
?>
</div>

