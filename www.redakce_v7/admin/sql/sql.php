<?php
      // konstatnty skriptu 
      define("PREFIX","ab5_"); //nastaveni prefix 
       


      //////////////////////////////////////////////////////////////////
      // nastaveni pristupovych prav do databaze sql.web4u.czxxxxx
      ////////////////////////////////////////////////////////////////// 
      $jmeno_serveru = "sql.web4u.cz";
      $prihlasovaci_jmeno ="zbraslavh";
      $heslo ="jmcn7636";
      $jmeno_databaze = "zbraslavh";
      
       if($jmeno_serveru == ""){die ( "nejsou vyplnìny pøístupové údaje"); }
      else 
      { 

      // spojeni se serverem
      if (@$spojeni = MySQL_Connect($jmeno_serveru,$prihlasovaci_jmeno,$heslo));
      //echo "spojeni bylo uspesne HURA"
      else die (" spojeni bylo neuspesne");

      // vybere databaze - teto web ma jen jednu datazazi
      if (@$db = mysql_select_db ($jmeno_databaze,@$spojeni));
      //echo "databaze byla otevrena OK"
      else die ("databaze nebyla naleza");    
      /////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////
      }
      
       
      
      
      
?>
