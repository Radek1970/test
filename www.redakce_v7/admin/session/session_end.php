<?php
//session_destroy ;			
//session_unset($heslox) ;

session_start();
   // ukonci sezeni prihlaseneho do vip zony
  session_unset($_SESSION['authuser']);
  session_unset($_SESSION['heslox']);
  session_unset($_SESSION['hlaska']);

//$_SESSION['heslox'] = "promena vymazana";
//$_SESSION['authuser'] = 0;
//exit();



?>
