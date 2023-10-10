<?











/*.......................................................
.........................................................
.............funkce pro anketu.....................
.......................................................*/

function anketa($hlas,$id,$dotaz,$spojeni,$kontrola){
/** test **/
//echo "<h1>$hlas</h1>";



       $result=mysql_query("select * from ".PREFIX."anketa where id_ankety = '$id'");                    
       while  ($row  =  mysql_fetch_row($result))
       {
       /** test **/
       //echo 'pocet otazek '.$row[2].'</br></br>';
       for ($i = 1; $i <= $row[2]; $i++) 
                        {
                          /*
                          promenna $hlas_otazky   $i + 5 protoze 
                          pole pro ukladani poctu hlasu yacina na 6 pozici
                          */
                          $hlas_otazky = $i + 5;
                          
                          
                          if ($i == $hlas){
                          $ip = $_SERVER['REMOTE_ADDR'];
                          /*naète ip adresu návštìvníka*/
                          //echo $ip;
                          
                          
                           $kontrola = "hlasoval";
                           $_SESSION['kontrola'] = $kontrola;
                          
                          
                          $pridej_hlas = $row[$hlas_otazky]+1;
                          /**testovani**/
                          //echo $pridej_hlas;
                          //echo $i.'pozice: '.$hlas_otazky.'ma hodnotu'.$pridej_hlas;
                          //echo '</br>'; 
                          
                         $row[$hlas_otazky] = $pridej_hlas;
                         
                          /**test**/
                          //echo $row[6];echo $row[7];echo $row[8];
                          
                          $celkem = $row[6]+ $row[7] + $row[8];
                          $row[9] = $celkem;
                          
                         
                  $nazev_tabulky = PREFIX."anketa";
                       
                           mysql_query(" 
              UPDATE $nazev_tabulky 
              SET id_ankety = '$id'
              , otazka = '$row[1]'
              , pocet_otazek = '$row[2]'
              , otazka_text_1 = '$row[3]'
              , otazka_text_2 = '$row[4]'
              , otazka_text_3 = '$row[5]'
              , otazka_pocet_1 = '$row[6]'
              , otazka_pocet_2 = '$row[7]'
              , otazka_pocet_3 = '$row[8]'
              , pocet_celkem = '$row[9]'
              , aktivace = '$row[10]'
              
              WHERE id_ankety = '$id'
              ");
                          
                         
                           }
                        }       
       }





       /*********************************************************************
        *********************************************************************
        *************************** vypis ankety ****************************
        ********************************************************************* 
        ********************************************************************/ 
        


if (!isset ($_SESSION['kontrola']))
{                                                                                
       $result=mysql_query("select * from ".PREFIX."anketa");  
                   
       while  ($row  =  mysql_fetch_row($result))
       {
         if($row[10]==aktivni)
         {
         echo '<h1>'.$row[1].'</h1>';
         //echo 'pocet otazek '.$row[2].'</br></br>';
       
       
         $stranka = $_SERVER[REQUEST_URI];
         //echo $stranka;
      
      for ($i = 1; $i <= $row[2]; $i++) 
      {
                          $cislo_otazky = $i + 2;
                          $hlas_otazky = $i + 5;
                          
       $sirka = $row[$hlas_otazky] / 2 * ($row[$hlas_otazky] / 100) * 2.1;
      //echo   $sirka;                       
      echo '<span class="anketa" ><a  href="index.php?side=ab5_side1&hlas='.$i.'&id='.$row[0].' " >';
      echo '&nbsp;&nbsp;'.$row[$cislo_otazky].' - '.$row[$hlas_otazky].'';
      echo "<br/><img src='css/images/prouzek.jpg' height='7px' width='$sirka px' alt='hlasuj' />";
      echo '</a></span></br>';
                
                
      }
      
     
  
          
      echo "<pre>";
      
      echo 'celkem '.$row[9].'';
      echo "</pre>";
        }       
       }
       
       
}
else
{ 

       $result=mysql_query("select * from ".PREFIX."anketa");  
                   
       while  ($row  =  mysql_fetch_row($result))
       {
         if($row[10]==aktivni)
         {
         echo '<h1>'.$row[1].'</h1>';
         //echo 'pocet otazek '.$row[2].'</br></br>';
       
       
         $stranka = $_SERVER[REQUEST_URI];
         //echo $stranka;
      
      for ($i = 1; $i <= $row[2]; $i++) 
      {
                          $cislo_otazky = $i + 2;
                          $hlas_otazky = $i + 5;
                          
       $sirka = $row[$hlas_otazky] / 2 * ($row[$hlas_otazky] / 100) * 2.1;
      //echo   $sirka;                       
      echo '<span class="anketa" >';
      //echo '<a  href="index.php?side=ab5_side1&hlas='.$i.'&id='.$row[0].' " >';
      echo '&nbsp;&nbsp;'.$row[$cislo_otazky].' - '.$row[$hlas_otazky].'';
      echo "<br/><img src='css/images/prouzek.jpg' height='7px' width='$sirka px' alt='hlasuj' />";
      //echo '</a>';
      echo '</span></br>';  
                                      
      
                
                
      }
      
     
  
          
      echo "<pre>";
      echo 'celkem '.$row[9].'';
      echo '</br>';
      echo "dìkujeme za váš hlas";
      echo "</pre>";
        }       
       }




}


}





/*.......................................................
.........................................................
.............funkce pro vypis slogan.....................
.......................................................*/
function slogan_fy($slogan_fy){
 
 	//otevreni souboru a jeho vypsani na hlavni stranku 
 $soubor = @ fopen("slogan/slogan_fy.txt", "r") or die("Soubor nelze otevøít.");

 //vypsani obsahu s 1500 znaky
 while (! feof($soubor))
 {
  $radek1 = fgets($soubor, 1500);
  print "$radek1";
 }
 fclose ($soubor);


}
 
 
 
 
function slogan($slogan){
  
 
 	//otevreni souboru a jeho vypsani na hlavni stranku 
 $soubor2 = @ fopen("slogan/slogan_text.txt", "r") or die("Soubor nelze otevøít.");

 //vypsani obsahu s 1500 znaky
 while (! feof($soubor2))
 {
  $radek2 = fgets($soubor2, 1500);
  print "$radek2";
  
 }
 fclose ($soubor2);


}









/*.......................................................
.........................................................
.............naformatovani menu........................
.......................................................*/
function menu($menu){


//if(!isset($side)) $side = "at_side1";

 
    $dotaz = "select * from ".PREFIX."menu ";
    $result=mysql_query($dotaz);            
    
    //zjisti poce zaznamu v databazi    
    $pocet_stranek = mysql_num_rows($result);
   
    if($pocet_stranek >= "1"){                
 while  ($row  = @  mysql_fetch_row($result))
 {
 $jmeno_odk =(strtolower("$row[2]")); // prevede na mala pismena
 echo '<li>';
 echo '<a href="index.php?side='.PREFIX.$row[1].'">'.$jmeno_odk.'</a>';
 echo '</li>';
 }
        }
        else
        {
        echo '<li>';
        echo 'není vytvoøena žádná stránka';
        echo '</li>';
        }
 
 
 
 


}





/*.......................................................
.........................................................
.............naformatovani nadpisu........................
.......................................................*/
function meta($meta,$side){

 $side = (substr("$side",4)); // odstrani tzv prefix  prvni 4 pozice

 //echo $side;
 
  
    $dotaz = "select * from ".PREFIX."menu where link = '$side' ";
    $result=mysql_query($dotaz);            
        
                 
 while  ($row  = @  mysql_fetch_row($result))
 {
 $meta =$row[4]; 


 echo '<meta name="keywords" content="';
 echo ''.$meta.'' ;
 echo'">';
 }



}


/*.......................................................
.........................................................
.............naformatovani title........................
.......................................................*/
function title($title,$side){

 $side = (substr("$side",4)); // odstrani tzv prefix  prvni 4 pozice

 //echo $side;
 
  
    $dotaz = "select * from ".PREFIX."menu where link = '$side' ";
    $result=mysql_query($dotaz);            
        
                 
 while  ($row  = @  mysql_fetch_row($result))
 {
 $title =$row[2]; 

 echo $title ;
 
 }



}


/*.......................................................
.........................................................
.............naformatovani nadpisu........................
.......................................................*/
function nadpis($nadpis,$side){

 $side = (substr("$side",4)); // odstrani tzv prefix  prvni 4 pozice

 //echo $side;
 
  
    $dotaz = "select * from ".PREFIX."menu where link = '$side' ";
    $result=mysql_query($dotaz);            
        
                 
 while  ($row  = @  mysql_fetch_row($result))
 {
 $jmeno_odk =(strtolower($row[3])); // prevede na mala pismena

 echo $jmeno_odk ;
 
 }



}



/*.......................................................
.........................................................
.............naformatovani obsahu........................
.......................................................*/
function obsah($obsah,$side){
    
    
    /************************************************************************
     * dotaz do tabulky menu zda se bude vypisovat fotogalerie
     * ve slupci galerie je ANO nebo NE
     * pole 6
     * *********************************************************************/
      
    // odstrani tzv prefix  prvni tri pozice 
    $nazev_stranky = (substr("$side",4));     
    //echo $nazev_stranky;
    
    $dotaz = "select * from ".PREFIX."menu where link = '$nazev_stranky' ";
    $result=mysql_query($dotaz);            
    $row  =  mysql_fetch_row($result);
    $spustit_galerie = $row[6];
    //echo $spustit_galerie;
    


if($spustit_galerie == ano) 
{
    $nazev_stranky = (substr("$side",4)); // odstrani tzv prefix  prvni tri pozice   
    //$dotaz = "select * from ".PREFIX."$nazev_stranky  ";
    $dotaz = "select id, jmeno_orig, jmeno_uprav, format_obr from ".PREFIX."$nazev_stranky  ";

    $result = @ mysql_query($dotaz);            
    $row  =  mysql_fetch_row($result);
    //echo $nazev_stranky;
    
    
    /*****************************************
     *
     * zjisti pocet zaznamu pro listovani
     *          
     *****************************************/
      $vysldot = @ mysql_num_rows($result);
      
       $kroklimit = 70;
    if($vysldot < 500) $kroklimit = 51;
    if($vysldot < 176) $kroklimit = 23;
    if($vysldot < 133) $kroklimit = 20;
    if($vysldot < 97) $kroklimit = 17;
    if($vysldot < 76) $kroklimit = 14;
    if($vysldot < 30) $kroklimit = 12;
    if($vysldot < 20) $kroklimit = 9;
      
      
     //echo $vysldot;

     // listovani */ 
     $radku = $vysldot;
     $po = $kroklimit; /* poèet øádkù na stránku */ 
     $max_stranek = ceil($radku / $po); /* poèet stránek */ 
     $url_stranka = ($_GET["stranka"] / $po) + 1; /* Aktuální stránka */

     /* pro listovani  */ 
     if(empty($_GET["stranka"])) {$stranka = 0;} else {$stranka = $_GET["stranka"];} 

     /* dotaz pro listovani  */
     $result= @ mysql_query( $dotaz. "limit $stranka, $po"); 





    $powet = 0;
    
    $adr = "foto_min/";    
    echo '<div class="gallery">';
    while  ($row  = @ mysql_fetch_row($result)) 
    {
    $powet++; 
    echo'<div class="photo">';
       
    echo "<a href=\"foto/$row[2]$row[3]\" title=\"$row[1]\" rel=\'lightbox[1]\' >"  ;  
    echo "<img src='".$adr."".$row[2]."".$row[3]."'  title='$row[1]' /></a>";
                                                                    
    echo '</div>';   
   
    
    } 
    echo'</div>';


}
else
{

 $dotaz = "select id, nadpis, text, obraz, foto, vyska, delka, pozice, popis from $side  ";
 //order by id asc 
 //asc
 //desc
 //$dotaz = "select * from '$page' order by id ";  
  
 $result = @ mysql_query($dotaz);
 
 
 
 /*****************************************
  *
  * zjisti pocet zaznamu pro listovani
  *          
  *****************************************/
  $vysldot = @ mysql_num_rows($result);
  //echo $vysldot;

     $kroklimit = 70;
    if($vysldot < 500) $kroklimit = 51;
    if($vysldot < 176) $kroklimit = 23;
    if($vysldot < 133) $kroklimit = 20;
    if($vysldot < 97) $kroklimit = 17;
    if($vysldot < 76) $kroklimit = 14;
    if($vysldot < 30) $kroklimit = 9;
    if($vysldot < 20) $kroklimit = 6;


  // listovani */ 
  $radku = $vysldot;
  $po = $kroklimit; /* poèet øádkù na stránku */ 
  $max_stranek = ceil($radku / $po); /* poèet stránek */ 
  $url_stranka = ($_GET["stranka"] / $po) + 1; /* Aktuální stránka */

  /* pro listovani  */ 
  if(empty($_GET["stranka"])) {$stranka = 0;} else {$stranka = $_GET["stranka"];} 

  /* dotaz pro listovani  */
  $result= @ mysql_query( $dotaz. "limit $stranka, $po"); 





  /*****************************************
  *
  * vypis obsahu
  *          
  *****************************************/
  $powet = 0;
   while  ($row  = @ mysql_fetch_row($result)) 
  {
  $powet++; 





      if($row[3]==ano)
            {
            echo '<div class="promo'.$row[7].'">';
 
            if(!isset($row[1]) or($row[1] == "")){}
            else{echo "<h1> $row[1]</h1>";}
 
            echo '<span>';
 
            obraz($row[4],$row[5],$row[6],$row[7],$row[8]); //preda parametry pro obraz do funkce

             echo $row[2].'</span></div>';
            } 
      else  {
            echo '<div class="promo'.$row[7].'">';
 
            if(!isset($row[1]) or($row[1] == "")){}
            else{echo "<h1> $row[1]</h1>";}
 
            echo ''.$row[2].'</div>';
            } 
  
   
             // vypisuje reklamu u prostred vypisu
             //$pocet = $po;
             $pocet = $vysldot; 
             if ($powet == IntVal($pocet/2))
             {
		         // pripojeni sekce reklama..
             //include_once('reklama/reklama.php');
             //echo '<div class="'.$row[7].'"><h4>test místo pro BANNEROVOU reklamu</h4></div>';
             }

}
} 

 
 
 
    /*****************************************
    *
    * vypisuje formular podle hotnoty z tabulky menu
    * ano = vypsat formular
    * ne = nevypisovat    
    *          
    *****************************************/
    //vypis kontaktniho formulare
    $dotaz  = "select * from ".PREFIX."menu ";
    $result = mysql_query($dotaz);                  
    //echo $side;
    //$result = @ mysql_query($dotaz);
              
     while  ($row  = @  mysql_fetch_row($result))
          {
              if(($row[5] == ano) and (PREFIX.$row[1]==$side))
              {   
              // pripojeni  formulare..
              include_once('formular.php');
              }
          }







 
        /**************  listovani dolni varianta  *********************/ 
         if($radku >= $po)
         {
          echo '<div class="listovani">';
            for($i=0; $i < $max_stranek; $i++) 
            { 
            $cislo = ($i + 1); 
            $url_cislo = ($cislo * $po) - $po; 
                if($url_stranka != $cislo) 
                { 
                echo "<a href=\"?side=$side&stranka=".$url_cislo."\">".($i + 1)."</a>\n"; 
                } 
                else 
                { 
                echo "<strong>&raquo;".($i + 1)."&laquo;</strong>\n"; 
                } 
            }
           echo '</div>';
          } 
        

}



























/*.......................................................
.........................................................
.............naformatovani obrazek........................
.......................................................*/
function obraz($nazev,$vyska,$sirka,$pozice,$popis)
{

if(($vyska>250 or $sirka>250 ) or ( $vyska == false or $sirka == false )){
$vyska=200;
$sirka=200;
}
else{
$vyska;
$sirka;
}



echo '<div class="promo'.$pozice.'img"><a href="foto/'.$nazev.'.jpg" title="foto" rel=\'lightbox[1]\' ><img   src="foto/'.$nazev.'.jpg"  alt="fotoxx" title="'.$popis.'" width="'.$sirka.'" height="'.$vyska.'" /></a></div>';

return;
}


/*.......................................................
.........................................................
.............naformatovani obrazek pro bocni panel........................
.......................................................*/
function obrazII($nazev,$vyska,$sirka,$pozice,$popis)
{

if(($vyska>190 or $sirka>190 ) or ( $vyska == false or $sirka == false )){
$vyska=200;
$sirka=200;
}
else{
$vyska;
$sirka;
}



echo '<a href="foto/'.$nazev.'.jpg" title="foto" rel=\'lightbox[1]\' ><img   src="foto/'.$nazev.'.jpg"  alt="fotoxx" title="'.$popis.'" width="'.$sirka.'" height="'.$vyska.'" /></a>';

return;
}









/*.......................................................
.........................................................
............. kontaktni formular ........................
.......................................................*/



function formular($kontrola,$jmeno,$telefon,$email,$zprava,$antispam){

$stranka = $_SERVER[REQUEST_URI];
//echo $stranka;
 
    // predana data z formulare
       $jmeno     = $_POST['jmeno']; 
       $telefon   = $_POST['telefon']; 
       $email     = $_POST['email']; 
       $zprava    = $_POST['zprava']; 
       $antispam  = $_POST['antispam']; 
       $kontrola  = $_POST['kontrola']; 
       
       //test
       /***
       echo $jmeno;
       echo "<br />";
       echo $telefon;
       echo "<br />";
       echo $email;
       echo "<br />";
       echo $zprava;
       echo "<br />";
       echo $antispam;
       echo "<br />";
       echo $kontrola;
       ***/
 



  $formular  = '<form action="'.$stranka.'" method="post">';
	$formular .= '<table class="form"><tr>';
  $formular .= '<th><label class="invisible"></label></th>';
	$formular .= '<td><input class="inp-text" name="kontrola" value="aktivace" type="hidden" size="30" /></td>';
  $formular .= '</tr><tr>';
  
  /*****************************************************
   *****************************************************  
   ******** KROK 1
   *****************************************************    
   ****************************************************/     
  
//validace retezce jmeno;
if (($kontrola == "aktivace") and (!strlen($jmeno)))
      {
      $formular .= '<th><label >JMÉNO:</label></th>';
	    $formular .= '<td><input class="inp-text_chyba" name="jmeno" value="'.$jmeno.'" type="text" size="30" /><small>chyba</small></td>';
	    
      }
else
      {
      $formular .= '<th><label >JMÉNO:</label></th>';
	    $formular .= '<td><input class="inp-text" name="jmeno" value="'.$jmeno.'" type="text" size="30" /></td>';
      } 


      $formular .= '</tr><tr>';





  /*****************************************************
   *****************************************************  
   ******** KROK 2
   *****************************************************    
   ****************************************************/     
  
//validace reteyce telefon;
if (($kontrola == "aktivace") and (!strlen($telefon)))
      {
      $formular .= '<th><label for="input-two">TELEFON:</label></th>';
	    $formular .= '<td><input class="inp-text_chyba" name="telefon" value="'.$telefon.'" type="text" size="30" /><small>chyba</small></td>';			
      }
else
      {
        
      //validace formatu tel. cisla. Kontrola zda je retezec z 9 cisel  
      if (($kontrola == "aktivace") and(!ereg("^[1-9]{1}[0-9]{8}$",$telefon)))
              {
              $formular .= '<th><label for="input-two">TELEFON:</label></th>';
	            $formular .= '<td><input class="inp-text_chyba" name="telefon" value="'.$telefon.'" type="text" size="30" /><small> zadejte formát telefonu xxxXXXxxx</small></td>';	            
              }      
      else
              {
              $formular .= '<th><label for="input-two">TELEFON:</label></th>';
	            $formular .= '<td><input class="inp-text" name="telefon" value="'.$telefon.'" type="text" size="30" /></td>';
              }
	    } 
      


      $formular .= '</tr><tr>';




  /*****************************************************
   *****************************************************  
   ******** KROK 3
   *****************************************************    
   ****************************************************/     
  
//validace retezce email;
if (($kontrola == "aktivace") and (!strlen($email)))
      {
      $formular .= '<th><label for="input-two">EMAIL:</label></th>';
	    $formular .= '<td><input class="inp-text_chyba" name="email" value="'.$email.'" type="text" size="30" /><small>chyba</small></td>';			
      }
else
      {
        
      //validace formatu EMAILU. Kontrola zda je retezec v pozadoavanem formatu 
                                         //ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email 
      if (($kontrola == "aktivace") and(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$email)))
              {
              $formular .= '<th><label for="input-two">EMAIL:</label></th>';
	            $formular .= '<td><input class="inp-text_chyba" name="email" value="'.$email.'" type="text" size="30" /><small>chyba špatný formát emailu</small></td>';	            
              }      
      else
              {
              $formular .= '<th><label for="input-two">EMAIL:</label></th>';
	            $formular .= '<td><input class="inp-text" name="email" value="'.$email.'" type="text" size="30" /></td>';
              }
	    } 
      


      $formular .= '</tr><tr>';


  /*****************************************************
   *****************************************************  
   ******** KROK 4
   *****************************************************    
   ****************************************************/     
  
//validace retezce zprava;
if (($kontrola == "aktivace") and (!strlen($zprava)))
      {
      $formular .= '<th class="message-up"><label for="message">ZPRÁVA:</label></th>';
	    $formular .= '<td><textarea name="zprava" class="area-text_chyba" cols="30" rows="5">'.$zprava.'</textarea><small>chyba</small></td>';
      }
else
      {
      $formular .= '<th class="message-up"><label for="message">ZPRÁVA:</label></th>';
	    $formular .= '<td><textarea name="zprava" class="area-text" cols="30" rows="5">'.$zprava.'</textarea></td>';
	    } 


      $formular .= '</tr><tr>';



  /*****************************************************
   *****************************************************  
   ******** KROK 5
   *****************************************************    
   ****************************************************/     
  
  
  
  
//kontrola antispam ochrany;
if (($kontrola == "aktivace") and (!strlen($antispam)))
      {
      
      
      $formular .= '<th><label for="question" class="invisible">Question:</label></th>';
	    $formular .= '<td id="samp" ><samp>&nbsp;qwxc&nbsp;</samp> &nbsp; <input class="answer_chyba" name="antispam"  type="text" size="5" /> <span><strong>(opište kód do pole&nbsp; - ochrana proti spamu není vyplnìna)</strong><small>chyba</small></span></td>';
			
      }
else
      {
          $antispam_small =(strtolower("$antispam")); // prevede velka pismana na mala'
      if (($kontrola == "aktivace") and($antispam_small !== "qwxc"))
          {
          $formular .= '<th><label for="question" class="invisible">Question:</label></th>';
	        $formular .= '<td id="samp" ><samp>&nbsp;qwxc&nbsp;</samp> &nbsp; <input class="answer_chyba" name="antispam"  type="text" size="5" /> <span><strong>(opište kód do pole&nbsp; - ochrana proti spamu  neni = qwxc)</strong><small>chyba</small></span></td>';
			
          }
      else
          {
          $formular .= '<th><label for="question" class="invisible">Question:</label></th>';
	        $formular .= '<td id="samp" ><samp>&nbsp;qwxc&nbsp;</samp> &nbsp; <input class="answer" name="antispam"  type="text" size="5" /> <span><strong>(opište kód do pole&nbsp; - ochrana proti spamu)</strong></span></td>';  
          }
      
      
      
      
	    
	    
			} 


      $formular .= '</tr><tr>';




  $formular .= '<td class="submit-button-right" colspan="2"><input class="submit-text" type="submit" value="ODESLAT" /></td>';
			
      
  $formular .= '</tr></table>';
	$formular .= '</form>';

  
  
  
  
  
  
  
  
 // v pripade ze jsou splneny podminky provede se odeslani emailu v opacnem pripade se akce neproved 
 if (($kontrola == "aktivace") and (strlen($jmeno))and (ereg("^[1-9]{1}[0-9]{8}$",$telefon)) and (strlen($email)) and (ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$email)) and (strlen($zprava)) and ($antispam_small == "qwxc") ) 
 {
 
 
     $datum = Date("j/m/Y H:i:s", Time());
     //echo($datum);

     $zprav_text ="odeslaná poptávka z web stránek\n<br/>";
     $zprav_text.="JMÉNO:$jmeno\n<br/>";
     $zprav_text.="TELEFON:$telefon\n<br/>";
     $zprav_text.="EMAIL:$email\n<br/>";
     $zprav_text.="ZPRÁVA:$zprava\n<br/>";
     $zprav_text.="DATUM:$datum\n";
 //echo  $zprav_text;
 
  
    $dotaz = "select * from ".PREFIX."heslo  ";
    $result=mysql_query($dotaz);            
    $row  =  mysql_fetch_row($result);
    // id emailu v tabulce heslo - email na ktery sebude zasilt zprava   
    $id_email = "200903";
    while  ($row  =  mysql_fetch_row($result)) 
    {
     if($row[3] == $id_email)
     {
     //echo $row[2];
     $dorucit_na_email = $row[2];
     }
    }
    //echo $dorucit_na_email;
   Mail( $dorucit_na_email , "poptávka", $zprav_text, "From: $email");
 
 
 echo"<p><span class=\"red\">Vaše zpráva byla odeslána</span></p>";
  
  
  $formularII  = '<form action="'.$stranka.'" method="post">';
	$formularII .= '<table class="form"><tr>';
	
	$formularII .= '<th><label class="invisible"></label></th>';
	$formularII .= '<td><input class="inp-text" name="kontrola" value="aktivace" type="hidden" size="30" /></td>';
  $formularII .= '</tr><tr>';
	
	$formularII .= '<th><label for="input-onexx">JMÉNO:</label></th>';
	$formularII .= '<td><input class="inp-text" name="jmeno"  type="text" size="30" /></td>';
	
	$formularII .= '</tr><tr>';

	$formularII .= '<th><label for="input-two">TELEFON:</label></th>';
	$formularII .= '<td><input class="inp-text" name="telefon"  type="text" size="30" /></td>';
			
  $formularII .= '</tr><tr>';
				
  $formularII .= '<th><label for="input-three">EMAIL:</label></th>';
	$formularII .= '<td><input class="inp-text" name="email"  type="text" size="30" /></td>';
			
  $formularII .= '</tr><tr>';
				
  $formularII .= '<th class="message-up"><label for="message">ZPRÁVA:</label></th>';
	$formularII .= '<td><textarea name="zprava"  cols="30" rows="5" class="area-text"></textarea></td>';
	
	$formularII .= '</tr><tr>';
	
	$formularII .= '<th><label for="question" class="invisible">Question:</label></th>';
	$formularII .= '<td id="samp"><span >qwxc</span> &nbsp; <input class="answer" name="antispam"  type="text" size="5" /> <span><strong>(opište kód do pole&nbsp; - ochrana proti spamu)</strong></span></td>';
			
  $formularII .= '</tr><tr>';
  
	$formularII .= '<td class="submit-button-right" colspan="2"><input class="submit-text" type="submit" value="ODESLAT" /></td>';
			
      
  $formularII .= '</tr></table>';
	$formularII .= '</form>';
	
	echo $formularII;
 }
 else{
 //echo'<span class="red">NELZE ODESLAT</span>';
 echo $formular;
 }
  
  

}













/*.......................................................
.........................................................
.............naformatovani datumu........................
.......................................................*/
function czechDate($sqldatum) {
 return EReg_Replace("([0-9]{4})-([0-9]{2})-([0-9]{2})","\\3.\\2.\\1",$sqldatum);
}

