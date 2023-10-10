<?php
      
      /************************************************************
       pristupova data  spojeni se serverem a vyber databaze 
       nacteme ze souboru sql.php
       
       kontrola pristupovych prav do databaze
       
       **********************************************************/  
       
       
       
   
   
       // nazev tabulky kde jsou ulozena pristupova prava
       $nazev_tabulky = PREFIX."heslo";

 
   
       
       // data z formulare
       $optimalizace_jmeno  = $_POST['jmeno']; 
       $optimalizace_heslo  = $_POST['heslo']; 
     
       //prevede velka pismena na mala
       $jmeno_user  = (StrTr($optimalizace_jmeno,  "ABCDEFGHIJKLMNOPQRSTUVWXYZÌŠÈØŽÝÁÍÉÚÙ", "abcdefghijklmnopqrstuvwxyzìšèøžýáíéúù"));
       $pass  = (StrTr($optimalizace_heslo,  "ABCDEFGHIJKLMNOPQRSTUVWXYZÌŠÈØŽÝÁÍÉÚÙ", "abcdefghijklmnopqrstuvwxyzìšèøžýáíéúù"));
     
    


       /****************************************************
       kontrola zadanych vstupnich dat z formulare s 
       tabulkou v databazi
       *****************************************************/
       
       // vytvoreny dotaz
       $dotaz = "SELECT * FROM $nazev_tabulky WHERE user='$jmeno_user' AND pass='$pass'";
       // spojeni dotazu a cesty
       $result = mysql_query($dotaz,$spojeni);

       /****************************************************
       Poèet záznamù, které jsou výsledkem posledního dotazu, 
       mùžeme zjistit pomocí funkce mysql_NumRows($result). 
       ******************************************************/
       $pocet = mysql_NumRows($result);
    
       /***************************************************** 
        v pripade uspechu vykona prikaz
       ******************************************************/  
    
       if($pocet==1){ 
       $_SESSION['authuser'] = 1;
       $_SESSION['data'] = true;
       $_SESSION['jmeno_user'] = $jmeno_user;
       $_SESSION['pass'] = $pass;
       
       
       /******************************************************
        * naformatovany dotaz vypise z tabulky sloupec EV_C
        * a hodnoutu zaregistrojeme do session pro dalsi pouziti        
        *
        ******************************************************/                       
       $result=mysql_query("select *
                     from $nazev_tabulky
                     where pass = '$pass' and user = '$jmeno_user'
                    ");
                   
       $row  =  mysql_fetch_row($result);
       if(isset($row[3])){$_SESSION['ev_c'] = $row[3]; }
       if(isset($row[4])){$_SESSION['funkce'] = $row[4]; }
       
       
           
      
      return ;}

      
      /********************************************************  
       v pripade neuspechu vykonna prikaz
      *********************************************************/
     
      else{
      $_SESSION['data'] = false;
      $_SESSION['jmeno'] = '';
      $_SESSION['pass'] = ''; 
      
      include_once('komponenty/hlaska_ko.php');
		//echo "<p>Nemáte oprávnìní k prohlížení této stránky</p>\n";
		exit(); 
      } 
      //zavre databazi
      mysql_Close();   
     
    
   
   


?>
