<?php 

//if ($authuser == 1) {
if((isset($_SESSION['jmeno_user'])) and (isset($_SESSION['pass'])) ){

  $ev_c = $_SESSION['ev_c'];
  $funkce = $_SESSION['funkce'];
  //test
  //echo $ev_c;
  //echo $funkce;
  
 echo'<div class="left_box">';
 echo'<div class="top_left_box"></div>';
 echo'<div class="center_left_box">';
 
 echo'<div style="float:right; padding: 0px 76px 0 0;">';
 echo'<div class="button2"  >
 <a href="odhlaseni.php">ODHLÁŠENÍ</a></div></div>';
 echo'</div><div class="bottom_left_box"></div></div>';







    /***************************************************
     * promena ev_c je registrovana v session
     **************************************************/         
    $result=mysql_query("select *
                     from  ".PREFIX."heslo
                     where ev_c = '$ev_c' 
                    ");
                   
       $row  =  mysql_fetch_row($result);
       
 echo'<div class="left_box">';
 echo'<div class="top_left_box"></div>';
 echo'<div class="center_left_box">';
 echo'<div class="box_title">Vaše <span>pøihlašovací údaje</span>:</div>';
 echo'<div class="form">';
   
   echo' <form id="myform" class="cssform" action="page.php?akc=edit_hesla" method="post">
   
         <div class="form_row"><label class="left">jméno: </label>'.$row[0].'
         <input type="hidden" name="jmeno"  value="'.$row[0].'" size=25 /></div>
         
         <div class="form_row"><label class="left">heslo: </label>'.$row[1].'
         <input type="hidden" name="pass"  value="'.$row[1].'" size=25 /></div>
         
         
         <div style="float:right; padding:10px 25px 0 0;">
         <input type="submit" class="button2" value="editovat"  /> 
         </div>
        </form>';
        
 echo'</div></div><div class="bottom_left_box"></div></div>';
 
 
	}
  





 if(($funkce =="redaktor")or($funkce =="superredaktor")){
 echo'<div class="left_box">';
 echo'<div class="top_left_box"></div>';
 echo'<div class="center_left_box">'; 
 echo'<div style="float:right; padding: 0px 26px 0 0;">';
 echo'<div class="button2"  >
 <a href="page.php?akc=ucty">všechny úèty</a></div></div>';
 echo'</div><div class="bottom_left_box"></div></div>';
 }

		
		
?>
