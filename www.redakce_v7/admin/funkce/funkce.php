<?

/*.......................................................
.........................................................
...... funkce pro zaslani pristupovych dat na email......
.......................................................*/

function send_password($email){


       ////////////////////////////////////////////////////////////////
       // data z formulare
       ////////////////////////////////////////////////////////////////
       
       //$email    = $_POST['email'];
       //odstrani mezer na zacatku retezce
       $email = trim($_POST['email']);
       
      ///////////////////////////////////////////////////////////////////////
      //kontrola vyplneni povynnych udaju ve formulari
      ///////////////////////////////////////////////////////////////////////
      
      // kontrola zda je vyplneno pole pro prihlasovaci_jmeno   
      if (!strlen($_POST["email"])) {
    
      echo'<div class="send_password_warnnig">
      nezadali jste žádná data</div>';


      return;} 
       
      //////////////////////////////////////////////////////////////////
      // zjisti zda je zadany zpravny format emailu
      /////////////////////////////////////////////////////////////////
        if (ereg("^[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~.]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$",$email)){}
       else {
       
       echo'<div class="send_password_warnnig">
       vaše emailová adresa není v platném formátu.Vaše zadaní: '.$email.'
       </div>';
              
       
        return;}
        
        
        
       
       
        $result=mysql_query("select *
                     from ".PREFIX."heslo
                     where email = '$email'
                    ");
                   
      $row  =  mysql_fetch_row($result);
      $pocet  =  mysql_num_rows($result);  
if($pocet==1){
echo'<div class="send_password_info"> na váš email '.$row[2].' byla automaticky odeslány pøístupové data 
    </div>';
    
     $zprav ="NA VASI ZADOST VAM ZASILAME\n";
     $zprav.="PRISTUPOVA DATA DO ADMINISTRACNIHO ROZHRANI\n";
     $zprav.="VASE PRIHLASOVACI UDAJE\n";
     $zprav.="JMENO:$row[0] - HESLO:$row[1] - \n";
     $zprav.="NA TENTO EMAIL NEODPOVIDEJTE\n";
     //echo  $zprav;
 
  //Mail("admin@admin.cz", "zadost o zaslani hesla", $zprav, "From: $email");
  // @ zabrani vypsani chybove hlasky
  @ Mail("$email", "zadost o zaslani hesla", $zprav, "From: admin@admin.cz");




     

return;}
else{
echo'<div class="send_password_warnnig">
      tento email není registrován</div>';
}

       

}


/*.......................................................
.........................................................
......vlozeni noveho zaznamu do zvolenenstranky..........
.......................................................*/

function insert_text($strana,$dotaz,$spojeni,$ev_c_autora ){

//maximalni rozmery vlozeneho obrazku
$vyska_max_hodnota = "250"; 
$delka_max_hodnota = "250";

  //echo  $strana ;  
  $nazev_tabulky = $strana;
   
  //echo $ev_c_autora;
  
    // vygeneruje iD 24 znaku
    $datumid = Date("YmjHisU", Time());
    //echo($datumid);
 // prenesena data z formulare   
 $id             = $datumid;
 $nadpis         = $_POST['nadpis'];
 $text           = $_POST['text'];
 $obraz          = $_POST['obraz'];
 $foto           = $_POST['foto'];
 $vyska          = $_POST['vyska'];
 $delka          = $_POST['delka'];
 $pozice         = $_POST['pozice'];
 $popis          = $_POST['popis'];
 $ev_c_autora    = $ev_c_autora ;
 
//echo  $vyska;
 // zjisti zda existuje promnena v pripade existence spusti skript
 if (isset($nazev_tabulky))
 {
     
     
      
      
       /******************************************************
       * zjisti zda jsou vyplneny povinne udaje 
       * nejsou-li vypise hlasku jsou-li provede vlozeni data 
       * prikazem INSERT INTO do dabulky
       *******************************************************/
      
        if ((!strlen($nadpis)) or (!strlen($text))) 
      {
       echo "<div class=\"admin_footer_warning\">";
       echo "nejsou vložená povinná data</div>"; 
       echo '
       <form id="myform" class="cssform" action="page.php?akc=obsah_form&str='.$strana.'" method="post">
       <input type="hidden" name="strana" size=35 value="'.$strana.'" />
       <input type="hidden" name="nadpis" value="'.$nadpis.'"/>
       <input type="hidden" name="ev_c_autora" value="'.$ev_c_autora.'"/>
       
       <textarea name="text"  cols="1" rows="1"  style=" visibility:hidden; height:15px; " >'.$text.'</textarea>
       <input type="hidden" name="obraz" value="'.$obraz.'"/>
       
       <input type="hidden" name="foto" value="'.$foto.'"/>
      
       <input type="hidden" name="vyska" value="'.$vyska.'"/>
       <input type="hidden" name="delka" value="'.$delka.'"/>
       
       <input type="hidden" name="pozice" value="'.$pozice.'"/>
       <input type="hidden" name="popis" value="'.$popis.'"/>
       
       
       <input type="submit"  value="vložit znova" class="form_button" /> 
       
</form><br/> <br/> 
       ';
       echo "<div style=\"clear:both;\">";
       
       return;
      }
      
      
      
      
      
       
       
      /********************************************************
       *
       * v pripade ze je pozadavan obrazek zkontroluje zda jsou
       * vyplnena povinna data             
       *             
       ********************************************************/ 
      if ($obraz == "ano") 
      {
       
           /********************************************************
            *
            * jsou-li parametry z formulare pro rozmer obrazku nevyplneny
            * nebo vetsi nez prednastavene parametry nebo neodpovidaji cisloci
            * tak delka vyska budou nastaveny na prednastavene hodnoty                  
            *           
            ********************************************************/
            if ((!strlen($vyska)) or (!strlen($delka))  or ( ($vyska > $vyska_max_hodnota) or ($delka > $delka_max_hodnota) ) ) 
             {
             $vyska = $vyska_max_hodnota;
             $delka = $delka_max_hodnota;
             }
      
            /********************************************************
             *
             *zkontroluje zda je vybrano jmeno pro obrazek 
             *                         
             *******************************************************/             
             if ($foto =="bez"){
             echo "<div class=\"admin_footer_warning\">";
             echo "nejsou vložená povinná data pro obraz</div>"; 
             echo '
             <form id="myform" class="cssform" action="page.php?akc=obsah_form&str='.$strana.'" method="post">
       <input type="submit" value="vložit znova" class="form_button" />
                    
       <input type="hidden" name="strana" size=35 value="'.$strana.'" />
       <input type="hidden" name="nadpis" value="'.$nadpis.'"/>
       <textarea name="text"  cols="1" rows="1"  style=" visibility:hidden; height:15px; " >'.$text.'</textarea>
       <input type="hidden" name="obraz" value="'.$obraz.'"/>
       <input type="hidden" name="foto" value="'.$foto.'"/>
       <input type="hidden" name="vyska" value="'.$vyska.'"/>
       <input type="hidden" name="delka" value="'.$delka.'"/>
       <input type="hidden" name="pozice" value="'.$pozice.'"/>
       <input type="hidden" name="popis" value="'.$popis.'"/>
       
              
              </form><br/> <br/> ';
              return;
              }
      
         }
       
            
            
            
            
    
      
      
      
      
      
      $dotaz="INSERT INTO $nazev_tabulky VALUES ('$id','$nadpis','$text','$obraz','$foto','$vyska','$delka','$pozice','$popis','$ev_c_autora')";
      // spojeni dotazu a cesty - vykonani prikazu
      $result = mysql_query($dotaz,$spojeni);
         
 }


 
      

}






/*.......................................................
.........................................................
......editace zaznamu ze zvolene stranky..........
.......................................................*/

function edit_text($strana_e,$dotaz,$spojeni){



//maximalni rozmery vlozeneho obrazku
$vyska_max_hodnota = "250"; 
$delka_max_hodnota = "250";

  //echo  $strana ;  
  $nazev_tabulky = $strana_e;
   
  
 // prenesena data z formulare   
 $id             = $_POST['id_e'];
 $nadpis        = $_POST['nadpis_e'];
 $text           = $_POST['text_e'];
 $obraz          = $_POST['obraz_e'];
 $foto           = $_POST['foto_e'];
 $vyska          = $_POST['vyska_e'];
 $delka          = $_POST['delka_e'];
 $pozice         = $_POST['pozice_e'];
 $popis          = $_POST['popis_e'];
 
 

 // zjisti zda existuje promnena v pripade existence spusti skript
 if (isset($nazev_tabulky))
 {
     
    
       /******************************************************
       * zjisti zda jsou vyplneny povinne udaje 
       * nejsou-li vypise hlasku jsou-li provede vlozeni data 
       * prikazem UPDATE do dabulky
       *******************************************************/
      
        if ((!strlen($nadpis)) or (!strlen($text)))
      {
       echo "<div class=\"admin_footer_warning\">";
       echo "nejsou vložená povinná data editace</div>"; 
       echo '
       <form id="myform" class="cssform" action="page.php?akc=obsah_editace&str='.$strana_e.'" method="post">
       
       <input type="submit" value="znova editovat" class="form_button" /> 
       <input type="hidden" name="id" value="'.$id.'"/>
       <input type="hidden" name="strana" size=35 value="'.$strana_e.'" />
       
       </form> <br/><br/>
       ';      
       return;
      }
     
      //tato podmínka je nadefinována kvuli texatarea editoru  
      //odstrani html znaky u textu z editoru
      $textx = strip_tags($text);
      // if ($text=="<p>&nbsp;</p>")
      if ($textx == "&nbsp;" )
      {
       echo "<div class=\"admin_footer_warning\">";
       echo "nejsou vložená povinná data editace</div>"; 
       echo '
       <form id="myform" class="cssform" action="page.php?akc=obsah_editace&str='.$strana_e.'" method="post">
       
       <input type="submit" value="znova editovat" class="form_button" /> 
       <input type="hidden" name="id" value="'.$id.'"/>
       <input type="hidden" name="strana" size=35 value="'.$strana_e.'" />
      
       </form> <br/><br/>
       ';     
       echo "<div style=\"clear:both;\">"; 
       return;
      }
       
     
      /********************************************************
       *
       * v pripade ze je pozadavan obrazek zkontroluje zda jsou
       * vyplnena povinna data             
       *             
       ********************************************************/ 
      if ($obraz == "ano") 
      {
       
           /********************************************************
            *
            * jsou-li parametry z formulare pro rozmer obrazku nevyplneny
            * nebo vetsi nez prednastavene parametry nebo neodpovidaji cisloci
            * tak delka vyska budou nastaveny na prednastavene hodnoty                  
            *           
            ********************************************************/
            if ((!strlen($vyska)) or (!strlen($delka))  or ( ($vyska > $vyska_max_hodnota) or ($delka > $delka_max_hodnota) ) ) 
             {
             $vyska = $vyska_max_hodnota;
             $delka = $delka_max_hodnota;
             }
      
            /********************************************************
             *
             *zkontroluje zda je vybrano jmeno pro obrazek 
             *                         
             *******************************************************/             
             if ($foto =="bez"){
             echo "<div class=\"admin_footer_warning\">";
             echo "nejsou vložená povinná data pro obraz</div>"; 
             echo '
             <form id="myform" class="cssform" action="page.php?akc=obsah_editace&str='.$strana_e.'" method="post">
       <input type="submit" value="znova editovat" class="form_button" />
                     
       <input type="hidden" name="id" value="'.$id.'"/>
       <input type="hidden" name="strana" size=35 value="'.$strana_e.'" />
       
       
              
              </form><br/> <br/> ';
              return;
              }
      
         }
    
    
    
    
    
    
    
    
  
      
      
       mysql_query(" 
              UPDATE $nazev_tabulky 
              SET nadpis = '$nadpis'
              , text = '$text'
              , obraz = '$obraz'
              , foto = '$foto'
              , vyska = '$vyska'
              , delka = '$delka'
              , pozice = '$pozice'
              , popis = '$popis'
              
              WHERE id = '$id'
              ");
       
      
     
 }


 
      

}












/*.......................................................
.........................................................
.............posune vybrany zaznam o pozici nize..........
.......................................................*/

function posun_down($cislo_radku_minus,$nazev_tabulky){

//test
//echo"cislo radku je $cislo_radku_minus ";
//echo"nazev tabulky je $nazev_tabulky ";


if(isset($cislo_radku_minus)){  
       $cislo_radku = $cislo_radku_minus;
       $cislo_radku_horni = $cislo_radku;
       $cislo_radku_posouvany = $cislo_radku-1;
       
       //test
       //echo "</p> èíslo øádku  ".$cislo_radkux." </p>";
       //echo "</p> èíslo øádku  ".$nazev_tabulky." </p>";
     


      $dotaz ="select * from $nazev_tabulky ";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_horni, 1 ");
      
      $row  =  mysql_fetch_row($result);
      
      $horni_id = $row[0];
      $horni_nadpis = $row[1];
      $horni_text = $row[2];
      $horni_obraz = $row[3];
      $horni_foto = $row[4];
      $horni_vyska = $row[5];
      $horni_delka = $row[6];
      $horni_pozice = $row[7];
      $horni_popis = $row[8];
      $horni_ev_c_autora = $row[9];
      //test 
      //echo $horni_id;
      //echo "<br><br><br><br>";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_posouvany, 1 ");    
      $row  =  mysql_fetch_row($result); 
      
      $akt_id = $row[0];
      $akt_nadpis = $row[1];
      $akt_text = $row[2];
      $akt_obraz = $row[3];
      $akt_foto = $row[4];
      $akt_vyska = $row[5];
      $akt_delka = $row[6];
      $akt_pozice = $row[7];
      $akt_popis = $row[8];
      $akt_ev_c_autora = $row[9];
      // test
      //echo $akt_id;
      //echo "<br>";
     
      
      
      
      
      if(isset($horni_id)){
      
      // test
      //echo"<h1>ano muzeme provest akci</h1>";
      //echo $horni_id;
      //echo "<br>";
      //echo $akt_id;
      
      
      //nova pozice
      
       mysql_query(" 
              UPDATE $nazev_tabulky 
              SET id = '$horni_id' 
              , nadpis = '$akt_nadpis'
              , text = '$akt_text'
              , obraz = '$akt_obraz'
              , foto = '$akt_foto'
              , vyska = '$akt_vyska'
              , delka = '$akt_delka'
              , pozice = '$akt_pozice'
              , popis = '$akt_popis'
              , ev_c_autora = '$akt_ev_c_autora'
              
              WHERE id = '$horni_id'
              ");
      
      
       // puvodni pozice
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id = '$akt_id'
              , nadpis = '$horni_nadpis'
              , text = '$horni_text'
              , obraz = '$horni_obraz'
              , foto = '$horni_foto'
              , vyska = '$horni_vyska'
              , delka = '$horni_delka'
              , pozice = '$horni_pozice'
              , popis = '$horni_popis'
              , ev_c_autora = '$horni_ev_c_autora'
              
              WHERE id = '$akt_id'
              ");
           
      
      }
      else {
      echo"<div class='admin_warnnig'> nelze provést posun neni žadná nižší pozice</div>";
      }
      
}


}


/*.......................................................
.........................................................
.............posune vybrany zaznam o pozici vyse..........
.......................................................*/

function posun_up($cislo_radku_plus,$nazev_tabulky){

//test
//echo"cislo radku je $cislo_radku_plus ";
//echo"nazev tabulky je $nazev_tabulky ";


if(isset($cislo_radku_plus)){  
       $cislo_radku = $cislo_radku_plus;
       $cislo_radku_horni = $cislo_radku-2;
       $cislo_radku_posouvany = $cislo_radku-1;
       
       //test
       //echo "</p> èíslo øádku  ".$cislo_radkux." </p>";
       //echo "</p> èíslo øádku  ".$nazev_tabulky." </p>";
     


      $dotaz ="select * from $nazev_tabulky ";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_horni, 1 ");
      
      $row  =  mysql_fetch_row($result);
      
      $horni_id = $row[0];
      $horni_nadpis = $row[1];
      $horni_text = $row[2];
      $horni_obraz = $row[3];
      $horni_foto = $row[4];
      $horni_vyska = $row[5];
      $horni_delka = $row[6];
      $horni_pozice = $row[7];
      $horni_popis = $row[8];
      $horni_ev_c_autora = $row[9];
      //test 
      //echo "akt- $horni_ev_c_autora ";
      //echo "<br>";
      //echo $horni_id;
      //echo "<br><br><br><br>";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_posouvany, 1 ");    
      $row  =  mysql_fetch_row($result); 
      
      $akt_id = $row[0];
      $akt_nadpis = $row[1];
      $akt_text = $row[2];
      $akt_obraz = $row[3];
      $akt_foto = $row[4];
      $akt_vyska = $row[5];
      $akt_delka = $row[6];
      $akt_pozice = $row[7];
      $akt_popis = $row[8];
      $akt_ev_c_autora = $row[9];
      // test
      //echo "horni -$akt_nadpis";
      //echo "<br>aaaaaaaaa";
      //echo "horn - $akt_ev_c_autora ";
      //echo "<br>";
      
      
      
      if(isset($horni_id)){
      
      // test
      //echo"<h1>ano muzeme provest akci</h1>";
      //echo $horni_id;
      //echo "<br>";
      //echo $akt_id;
      
      
      //nova pozice
      
       mysql_query(" 
              UPDATE $nazev_tabulky 
              SET id = '$horni_id' 
              , nadpis = '$akt_nadpis'
              , text = '$akt_text'
              , obraz = '$akt_obraz'
              , foto = '$akt_foto'
              , vyska = '$akt_vyska'
              , delka = '$akt_delka'
              , pozice = '$akt_pozice'
              , popis = '$akt_popis'
              , ev_c_autora = '$akt_ev_c_autora'
              
              WHERE id = '$horni_id'
              ");
      
      
       // puvodni pozice
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id = '$akt_id'
              , nadpis = '$horni_nadpis'
              , text = '$horni_text'
              , obraz = '$horni_obraz'
              , foto = '$horni_foto'
              , vyska = '$horni_vyska'
              , delka = '$horni_delka'
              , pozice = '$horni_pozice'
              , popis = '$horni_popis'
              , ev_c_autora = '$horni_ev_c_autora'
              
              WHERE id = '$akt_id'
              ");
           
      
      }
      else {
      
    
    //echo "<script>window.confirm('nelze provést posun neni žádná vyšší pozice')</script>";


    
      echo"<div class='admin_warnnig'> nelze provést posun není žádná vyšší pozice</div>";
      }
      
}







}





/*.......................................................
.........................................................
.............vymaze vybrane zaznamy.....................
.......................................................*/

function delet($delkompl,$nazev_tabulky,$ev_c_autora){

     
        //echo $ev_c_autora;
      
      
        $id_vyrobku            = $_REQUEST['delkompl'];
        //echo count ($id_vyrobku);
        //echo "<br/>";
       
       
       
       
       $pocet    = count ($id_vyrobku);
       //echo "<p id=\"bg_info\">poèet smazaných záznamù: $pocet </p>";
       
       // jeli hodnota pole nulova vypise hlasku
       if ($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0; 
       $a=0;
       while ($i < $pocet)
       {
       
       //if($autor == $ev_c_autora){
       //echo "<p >záznam s id $id_vyrobku[$i] </p>";
       //echo "<br/>";
       
       
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query("DELETE FROM $nazev_tabulky 
               WHERE id = '$id_vyrobku[$i]' ");
       $i++;
      
       }
          }    


       //}
       




}






/*.......................................................
.........................................................
.............vymaze vybrane zaznamy.....................
.......................................................*/

function foto_smazat_gal($foto_delet_kompl,$jmeno_galerie,$dotaz,$spojeni,$ev_c_autora){

     
        //echo $jmeno_galerie;
      
      
        $id_vyrobku            = $_REQUEST['foto_delet_kompl'];
        //echo count ($id_vyrobku);
        //echo "<br/>";
       
       
       
       
       $pocet    = count ($id_vyrobku);
      
       // jeli hodnota pole nulova vypise hlasku
       if ($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0; 
       $a=0;
       while ($i < $pocet)
       {
       
       //if($autor == $ev_c_autora){
       //echo "<p >záznam s id $id_vyrobku[$i] </p>";
       //echo "<br/>";
       
       
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query("DELETE FROM ".PREFIX."$jmeno_galerie 
               WHERE id = '$id_vyrobku[$i]' ");
        
        
       $i++;
      
       }
          }    


       //}
       




}







/*.......................................................
.........................................................
.............vlozi vybrane zaznamy ftogalerie............
.......................................................*/

function foto_do_gal($fotokompl,$jmeno_galerie,$dotaz,$spojeni,$ev_c_autora){

        // test
        //echo $jmeno_galerie;
      
      
        $id_vyrobku            = $_REQUEST['fotokompl'];
        //echo count ($id_vyrobku);
        //echo "<br/>";
       
       
       
       
       $pocet    = count ($id_vyrobku);
      
       // jeli hodnota pole nulova vypise hlasku
       if ($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0; 
       








       
       
      while ($i < $pocet)
       {
        
       
       
        $dotaz = "select * from ".PREFIX."foto where id = '$id_vyrobku[$i]'  ";
        $result = mysql_query($dotaz);
        $row  =  mysql_fetch_row($result);
        
       //test
       /*
       echo "<p >záznam s id $id_vyrobku[$i] </p>";
       echo "<br/>";
       echo "$row[0]";
       echo "<br/>";
       echo "$row[1]";
       echo "<br/>";
       echo "$row[2]";
       echo "<br/>";
       echo "$row[3]";
       echo "<br/>";
       echo "$row[4]";
       echo "<br/>";
       echo "$row[5]";
       echo "<br/>";
       echo "$row[6]";
       */
       
       $id = $row[0];
       $jmeno_orig = $row[1];
       $jmeno_uprav = $row[2];
       $format_obr = $row[3];
       $vyska = $row[4];
       $sirka = $row[5];
       $ev_c_autora = $row[6];
       
      
      
      // vytvoreny dotaz
       $dotazx = "select * from ".PREFIX."$jmeno_galerie where id='$id_vyrobku[$i]' ";
       $resultx = mysql_query($dotazx);

       /****************************************************
       Poèet záznamù, které jsou výsledkem posledního dotazu, 
       mùžeme zjistit pomocí funkce mysql_NumRows($result). 
       ******************************************************/
       $pocetx = mysql_NumRows($resultx);
    
       /***************************************************** 
        v pripade ze je zaznam jiz v databazi vlozen 
        nize uvedeny prikaz se neprovede
       ******************************************************/  
    
       if($pocetx !=1){
       //echo "ano";
       $jmeno_tabulky = PREFIX.$jmeno_galerie;
       
       $dotaz="INSERT INTO $jmeno_tabulky VALUES ('$id','$jmeno_orig','$jmeno_uprav','$format_obr','$vyska','$sirka','$ev_c_autora')";
      // spojeni dotazu a cesty - vykonani prikazu
      $result = mysql_query($dotaz,$spojeni);
       }
      
       
       $i++;
      
       }
          }    


      
       




}




















/*.......................................................
.........................................................
.............vymaze vybrane ucet.....................
.......................................................*/

function delet_ucet($delkompl){

        


        $id_vyrobku            = $_REQUEST['delkompl'];
        //echo count ($id_vyrobku);
        //echo "<br/>";
       
       
       
       
       $pocet    = count ($id_vyrobku);
       //echo "<p id=\"bg_info\">poèet smazaných záznamù: $pocet </p>";
       
       // jeli hodnota pole nulova vypise hlasku
       if ($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0; 
       $a=0;
       while ($i < $pocet)
       {
       
       //if($autor == $ev_c_autora){
       //echo "<p >záznam s id $id_vyrobku[$i] </p>";
       //echo "<div class='admin_info'>záznam byl vymazán </div>";
       //echo "<br/>";
       
       $nazev_tabulky = PREFIX."heslo";
       //echo $nazev_tabulky;
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query("DELETE FROM $nazev_tabulky 
               WHERE ev_c = '$id_vyrobku[$i]' ");
       $i++;
      
       }
          }    


       //}
       




}



/*.......................................................
.........................................................
.............vymaze vybrane ankety.....................
.......................................................*/

function delet_anketa($delanketa){

        


        $id_vyrobku            = $_REQUEST['delanketa'];
        //echo count ($id_vyrobku);
        //echo "<br/>";
       
       
       
       
       $pocet    = count ($id_vyrobku);
       
       // jeli hodnota pole nulova neprovede akci mazani
       if ($pocet != 0)
          {
       // funkce while vypise prislusny pocet poli 
       $i=0; 
       $a=0;
       while ($i < $pocet)
       {
       
       //echo "<p >záznam s id $id_vyrobku[$i] </p>";
       //echo "<br/>";
       
        $nazev_tabulky = PREFIX."anketa";
       //echo $nazev_tabulky;
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query("DELETE FROM $nazev_tabulky 
               WHERE id_ankety = '$id_vyrobku[$i]' ");
            
       
       
            
            
       $i++;
      
       }
          }  
       




}



/*.......................................................
.........................................................
.............aktivuje vybranou anketu.....................
.......................................................*/

function aktivace_anketa($aktivace,$dotaz,$spojeni){

        
    if(isset ($aktivace)){
        //echo "aktivuj id $aktivace ";
        
        $nazev_tabulky = PREFIX."anketa";
       //echo $nazev_tabulky;
       
        
        // zjisti aktivni anketu a deaktivujeji
        $result=mysql_query("select *
                     from $nazev_tabulky
                     where aktivace = 'aktivni'
                    ");       
               
        $row  =  mysql_fetch_row($result);  
        $deaktivace_ankety =   $row[0];       
        
      
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id_ankety = '$row[0]'
              , otazka = '$row[1]'
              , pocet_otazek = '$row[2]'
              , otazka_text_1 = '$row[3]'
              , otazka_text_2 = '$row[4]'
              , otazka_text_3 = '$row[5]'
              , otazka_pocet_1 = '$row[6]'
              , otazka_pocet_2 = '$row[7]'
              , otazka_pocet_3 = '$row[8]'
              , pocet_celkem = '$row[9]'
              , aktivace = 'neaktivni'
              
              where id_ankety = '$deaktivace_ankety'
              ");


        // vybrane id ankety aktivuje
        $result=mysql_query("select *
                     from $nazev_tabulky
                     where id_ankety = '$aktivace'
                    ");       
               
        $row  =  mysql_fetch_row($result);
        
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id_ankety = '$row[0]'
              , otazka = '$row[1]'
              , pocet_otazek = '$row[2]'
              , otazka_text_1 = '$row[3]'
              , otazka_text_2 = '$row[4]'
              , otazka_text_3 = '$row[5]'
              , otazka_pocet_1 = '$row[6]'
              , otazka_pocet_2 = '$row[7]'
              , otazka_pocet_3 = '$row[8]'
              , pocet_celkem = '$row[9]'
              , aktivace = 'aktivni'
              
              where id_ankety = '$aktivace'
              ");

         }
        
}



/*.......................................................
.........................................................
.............deaktivuje vzbranou anketu..................
.......................................................*/

function deaktivace_anketa($deaktivace,$dotaz,$spojeni){

        
    if(isset ($deaktivace)){
        //echo "aktivuj id $aktivace ";
        
        $nazev_tabulky = PREFIX."anketa";
       //echo $nazev_tabulky;
       
        
        // zjisti aktivni anketu a deaktivujeji
        $result=mysql_query("select *
                     from $nazev_tabulky
                     where id_ankety = '$deaktivace'
                    ");       
               
        $row  =  mysql_fetch_row($result);  
        $deaktivace_ankety =   $row[0];       
        
      
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id_ankety = '$row[0]'
              , otazka = '$row[1]'
              , pocet_otazek = '$row[2]'
              , otazka_text_1 = '$row[3]'
              , otazka_text_2 = '$row[4]'
              , otazka_text_3 = '$row[5]'
              , otazka_pocet_1 = '$row[6]'
              , otazka_pocet_2 = '$row[7]'
              , otazka_pocet_3 = '$row[8]'
              , pocet_celkem = '$row[9]'
              , aktivace = 'neaktivni'
              
              where id_ankety = '$deaktivace_ankety'
              ");



         }
        
}








/*.......................................................
.........................................................
......vlozeni noveho zaznamu do zvolenenstranky..........
.......................................................*/

function nova_anketa($form_nova_anketa,$dotaz,$spojeni ){


  
    //
 $otazka                   = $_POST['otazka'];
 //echo $otazka;
 
 $pocet_otazek                   = $_POST['tmp_souhlasim'];
 //echo $pocet_otazek;


 $otazka_text_1                = $_POST['odpoved_1'];
 //echo $otazka_text_1;
 $otazka_text_2                = $_POST['odpoved_2'];
 //echo $otazka_text_2;
 $otazka_text_3               = $_POST['odpoved_3'];
 //echo $otazka_text_3;
 
 $otazka_pocet_1          = $_POST['odpoved_pocet_1'];
 //echo $otazka_pocet_1;
 $otazka_pocet_2         = $_POST['odpoved_pocet_2'];
 //echo $otazka_pocet_2;
 $otazka_pocet_3         = $_POST['odpoved_pocet_3'];
 //echo $otazka_pocet_3;
 
 $pocet_celkem             = $_POST['pocet_celkem'];
 //echo $pocet_celkem;
 
 $aktivace                 = $_POST['nova_aktivace'];
 //echo $aktivace;
 
if(isset ($_POST['otazka'])) 
{
  if ((!strlen($_POST['otazka'])) or (!strlen($_POST['odpoved_1'])) or (!strlen($_POST['odpoved_2']))  ) 
      {
       echo "<div class=\"admin_footer_warning\">";
       echo "nejsou vložená povinná data</div>"; 
      }
   else
   {
       if(!isset($pocet_otazek)){$pocet_otazek="2";
       //echo $pocet_otazek; 
       }
       else{$pocet_otazek;
       //echo $pocet_otazek;
       }
       $jmeno_tabulky = PREFIX.'anketa';
       
       $dotaz="INSERT INTO $jmeno_tabulky VALUES ('','$otazka','$pocet_otazek','$otazka_text_1','$otazka_text_2','$otazka_text_3','$otazka_pocet_1','$otazka_pocet_2','$otazka_pocet_3','$pocet_celkem','$aktivace')";
      // spojeni dotazu a cesty - vykonani prikazu
      $result = mysql_query($dotaz,$spojeni);
   
   
   
   }   
} 
 
 
 
}



/*.......................................................
.........................................................
.............vymaze vybrane obrazky.....................
.......................................................*/

function delet_obr($delkompl){


    $nazev_tabulky = PREFIX."foto";
 
 
       // prenesena data z formulare prevedeme do pole
       $id_vyrobku            = $_REQUEST['delkompl'];
       
       // spocita pocet predanych prvku do pole
       //echo count ($id_vyrobku);
       //echo "<br/>";
       $pocet = count ($id_vyrobku);
       //echo "<p id=\"bg_info\">poèet smazaných záznamù: $pocet </p>";
       
       
       
       // jeli hodnota pole nulova vypise hlasku
       if($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0;
       while($i < $pocet) 
       {
       //echo "<p >záznam s id $id_vyrobku[$i] byl smazán </p>";
       //echo "<br/>";
       
       
       
      
       
        $result=mysql_query("select *
                     from $nazev_tabulky
                     where id = '$id_vyrobku[$i]'
                    ");
                   
        $row  =  mysql_fetch_row($result);           
        //echo "<h2>název: $row[1]$row[3]</h2>";
       
       $prom1 = $row[1]."".$row[3];
       
      // @zabrani vypsani chybove hlasky system
       $myFile = "../foto/".$prom1; 
      @ unlink($myFile); 
       $myFile = "../foto_min/".$prom1; 
      @ unlink($myFile); 
       
       
       // spojeni dotazu a cesty - vykonani prikazu
       mysql_query("DELETE FROM $nazev_tabulky 
               WHERE id = '$id_vyrobku[$i]' ");
              
       
       
              
       $i++;
       }
          }    

    

}






/*.......................................................
.........................................................
.............vymaze vybrane stranky.....................
.......................................................*/

function delet_str($delkompl,$nazev_tabulky){
      // prenesena data z formulare prevedeme do pole
       $id_vyrobku            = $_REQUEST['delkompl'];
       
       // spocita pocet predanych prvku do pole
       //echo count ($id_vyrobku);
       //echo "<br/>";
       $pocet = count ($id_vyrobku);
       
       // jeli hodnota pole nulova vypise hlasku
       if($pocet != 0){
       // funkce while vypise prislusny pocet poli 
       $i=0;
     
       while($i < $pocet) 
       {
      
       
       //rozdeli retezec na dve casti na cast s ID a cast s NAZVEM
       $dilky = explode("-", "$id_vyrobku[$i]");
       $dilky[0]; # vypise: id
       $dilky[1]; # vypise: nazev 
       
       

       
       
      // vymaze zaznam z tabulky
       mysql_query("DELETE FROM ".PREFIX."menu 
               WHERE id = '$dilky[0]' ");
               
               //pridame prefix 
               $nazev_tabulky_str = PREFIX.$dilky[1];
               
       // vymaze tabulku z databaze       
      mysql_query(" DROP TABLE $nazev_tabulky_str ");       
         //DROP TABLE `at_zadost
       
       
          
     
       $i++;
       }
          }  

}









/*.......................................................
.........................................................
.............vytvori novou stranku.......................
.......................................................*/

function nova_str($jmeno,$popis,$key_slova,$formular_kontakt,$galerie){




       // vytvoreny dotaz
       $dotaz = "SELECT * FROM ".PREFIX."menu WHERE jmeno='$jmeno' ";
       // spojeni dotazu a cesty
       $result = mysql_query($dotaz);

       //Poèet záznamù, které jsou výsledkem posledního dotazu, 
       //mùžeme zjistit pomocí funkce mysql_NumRows($result). 
     
       $pocet = mysql_NumRows($result);
       
       
       //varovne hlaseni
    if (isset($jmeno)){
       if ($pocet == 1){
       echo "<div class=\"admin_footer_warning\">duplicitní název</div>";
       return;
       }    
       if ((!strlen($jmeno)) or (!strlen($popis))) {
       echo "<div class=\"admin_footer_warning\">nekompletní vložená data</div>"; 
       }
    }


   


   // upravy slova nahradi mezery carkou
   $key_slovo = trim ($_POST['key_slova']);
   $key_slovo1 =(str_replace(" ",",",$key_slovo));
   
   //echo "xxx";
   //echo $key_slovo1;
   //echo "xxx";
  
  
  
    // vygeneruje iD 24 znaku
    $datumid = Date("YmjHisU", Time());
    //echo($datumid);
  $id = $datumid;
 
 
 //odstrani mezer na zacatku retezce
 $jmeno = trim($_POST['jmeno']);
 //echo $jmeno_uprav;
 $popis = trim($_POST['popis']);
 
 
 $uprav_link   = $jmeno;
  
 // nar´hradi mezery spojovnikem _
 $uprav_link1 =(str_replace(" ","_",$uprav_link));
 
 // Všechna velká písmena pøevede na malá 
 $uprav_link2 =(strtolower($uprav_link1));
 
 // odstrani hacky carky 
 $uprav_link3  = (StrTr($uprav_link2,  "ìšèøžýáíéúùò", "escrzyaieuun")); 
 $link         = $uprav_link3;
 
 
 
 $jmeno            = $jmeno;
 $jmeno_title      = $popis;
 $key_sl           = $key_slovo1;
 $formul_kontakt   = $formular_kontakt;
 /*
 echo "<br>";
 echo $id;
 echo "<br>cesta";
 echo $link;
 echo "<br>";
 echo $jmeno;
 echo "<br>nazev";
 echo $jmeno_title;
 echo "<br>";
 echo  $formul_kontakt;
 */
 

        
    //nejsou-li kompletne vyplnena data ve formulari ukonci skript a neprovede vlozeni
    if (!strlen($jmeno)){return;}
    if (!strlen($popis)){return;}
    
    
    
    
    
 
      // vlozeni hodnot z formulare do tabulky menu
       MySQL_Query(" INSERT INTO ".PREFIX."menu
       VALUES ('$id','$link','$jmeno','$jmeno_title','$key_sl','$formul_kontakt','$galerie') ");
        
        
        $new_tab = PREFIX.$link; 
        //echo $new_tab;
        
      
       //$result=mysql_query(CREATE TABLE at_test like at_side1 );


     
      /********************************************************************
       *
       * vytvoreni nove tabulky se stejnym nazvem jako je link
       * rozsireny o prefix at_       
       * vytvorime tabulku pro text nebo pro fotogalerii
       *        
       ********************************************************************/  
       
if($galerie == "ne") {                         
mysql_query("CREATE TABLE $new_tab(
  `id` varchar(100) NOT NULL default '',
  `nadpis` varchar(200) NOT NULL default '',
  `text` text NOT NULL,
  `obraz` varchar(100) NOT NULL default '',
  `foto` varchar(100) NOT NULL default '',
  `vyska` char(3) NOT NULL default '',
  `delka` char(3) NOT NULL default '',
  `pozice` varchar(10) NOT NULL default '',
  `popis` varchar(200) NOT NULL default '',
  `ev_c_autora` varchar(200) NOT NULL default ''
)")
or die("Nelze vykonat definièní dotaz: " . mysql_error());
   }
   else{
mysql_query("CREATE TABLE $new_tab(
  `id` varchar(100) NOT NULL default '',
  `jmeno_orig` varchar(200) NOT NULL default '',
  `jmeno_uprav` varchar(200) NOT NULL default '',
  `format_obr` varchar(20) NOT NULL default '',
  `vyska` varchar(20) NOT NULL default '',
  `sirka` varchar(20) NOT NULL default '',
  `ev_c_autora` varchar(200) NOT NULL default ''
)")
or die("Nelze vykonat definièní dotaz: " . mysql_error());
    }





}



/*.......................................................
.........................................................
.............  editace stranky  .....................
.......................................................*/

function editace_str($jmeno_e,$popis_e,$link_e,$id_e,$key_slova_e,$formular_kontakt_e,$galerie_e){
    
          $id            = $_POST['id_e'];
 $stara_cesta            = $_POST['link_e'];
 
   $key_slovo = trim ($_POST['key_slova_e']);
   $key_slovo1 =(str_replace(" ",",",$key_slovo));
   //echo  $key_slovo1;


//odstrani mezer na zacatku retezce
 $jmeno = trim($_POST['jmeno_e']);
 //echo $jmeno_uprav;
 $popis = trim($_POST['popis_e']);
 
 
 $uprav_link   = $jmeno;
  
 // nar´hradi mezery spojovnikem _
 $uprav_link1 =(str_replace(" ","_",$uprav_link));
 
 // Všechna velká písmena pøevede na malá 
 $uprav_link2 =(strtolower($uprav_link1));
 
 // odstrani hacky carky 
 $uprav_link3  = (StrTr($uprav_link2,  "ìšèøžýáíéúùò", "escrzyaieuun")); 
 $link         = $uprav_link3;
 
 
 
 $jmeno          = $jmeno;
 $jmeno_title    = $popis;
 $key_sl         = $key_slovo1;
 $formul_kontakt = $formular_kontakt_e;
 $galerie        = $galerie_e;
 //nejsou-li kompletne vyplnena data ve formulari ukonci skript a neprovede vlozeni
    if (!strlen($jmeno_e)){ return;} 
    if (!strlen($popis_e)){ return;} 
 
 /*   
 echo "<br>";
 echo $id;
 echo "<br>link";
 echo $link;
 echo "<br>nazev";
 echo $jmeno;
 echo "<br>title";
 echo $jmeno_title;
 echo "<br>stary link";
 echo $stara_cesta;
 */
  


 if($id != 1){
      // spojeni dotazu a cesty - vykonani prikazu
       mysql_query(" 
              UPDATE ".PREFIX."menu 
              SET id = '$id'
              , link = '$link'
              , jmeno = '$jmeno'
              , jmeno_title = '$jmeno_title'
              , key_sl = '$key_sl'
              , formul_kontakt = '$formul_kontakt'
              , galerie = '$galerie'
              
              WHERE id = '$id'
              ");
       
             // pridame do retezce prefix 
             
              $stary_nazev_tabulky = PREFIX."$stara_cesta";
              //echo $stary_nazev_tabulky;
              $novy_nazev_tabulky = PREFIX."$link";
              //echo $novy_nazev_tabulky;
              
              // funkce prejmenuje puvodni nayev tabulky na novy
        mysql_query(" ALTER TABLE  $stary_nazev_tabulky RENAME $novy_nazev_tabulky ")
        or die("Nelze vykonat definièní dotaz: " . mysql_error());
        }
        else{
        // provede se v pripade ze je editovan nazev strank side1
        // spojeni dotazu a cesty - vykonani prikazu
       mysql_query(" 
              UPDATE ".PREFIX."menu 
              SET id = '1'
              , link = 'side1'
              , jmeno = '$jmeno'
              , jmeno_title = '$jmeno_title'
              
              
              
              WHERE id = '$id'
              ");
        
        }
       


















}

/*.......................................................
.................funkce pro posun stranky................
.............posune vybrany zaznam o pozici nize..........
.......................................................*/

function posun_down_str($cislo_radku_minus){

//test
//echo"cislo radku je $cislo_radku_minus ";

$nazev_tabulky = PREFIX."menu";
//echo"nazev tabulky je $nazev_tabulky ";



if(isset($cislo_radku_minus)){  
       $cislo_radku = $cislo_radku_minus;
       $cislo_radku_horni = $cislo_radku;
       $cislo_radku_posouvany = $cislo_radku-1;
       
       //test
       //echo "</p> èíslo øádku  ".$cislo_radku." </p>";
       //echo "</p> èíslo øádku  ".$nazev_tabulky." </p>";
     


      $dotaz ="select * from $nazev_tabulky ";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_horni, 1 ");
      
      $row  =  mysql_fetch_row($result);
      
      $dolni_id = $row[0];
      $dolni_link = $row[1];
      $dolni_jmeno = $row[2];
      $dolni_jmeno_title = $row[3];
      $dolni_key_sl = $row[4];
      $dolni_formul_kontakt = $row[5];
      $dolni_galerie = $row[6];
      //test 
      //echo $horni_id;
      //echo "<br><br><br><br>";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_posouvany, 1 ");    
      $row  =  mysql_fetch_row($result); 
      
      $akt_id = $row[0];
      $akt_link = $row[1];
      $akt_jmeno = $row[2];
      $akt_jmeno_title = $row[3];
      $akt_key_sl = $row[4];
      $akt_formul_kontakt = $row[5];
      $akt_galerie = $row[6];
      
      // test
      //echo $akt_id;
      //echo "<br>";
     
      
      
      
      
      if((isset($dolni_id)) and ($akt_id > 1)){
      
      // test
      //echo"<h1>ano muzeme provest akci</h1>";
      //echo $horni_id;
      //echo "<br>";
      //echo $akt_id;
      
      
      //nova pozice
      
       mysql_query(" 
              UPDATE $nazev_tabulky 
              SET id = '$dolni_id' 
              , link = '$akt_link'
              , jmeno = '$akt_jmeno'
              , jmeno_title = '$akt_jmeno_title'
              , key_sl = '$akt_key_sl' 
              , formul_kontakt = '$akt_formul_kontakt' 
              , galerie = '$akt_galerie' 
              
              WHERE id = '$dolni_id'
              ");
      
      
       // puvodni pozice
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id = '$akt_id'
              , link = '$dolni_link'
              , jmeno = '$dolni_jmeno'
              , jmeno_title = '$dolni_jmeno_title'
              , key_sl = '$dolni_key_sl' 
              , formul_kontakt = '$dolni_formul_kontakt' 
              , galerie = '$dolni_galerie'
              
              WHERE id = '$akt_id'
              ");
           
      
      }
      
      
}


}







/*.......................................................
......................funkce pro posun stranky...........
.............posune vybrany zaznam o pozici vyse..........
.......................................................*/

function posun_up_str($cislo_radku_plus){

//test
//echo"cislo radku je $cislo_radku_minus ";

$nazev_tabulky = PREFIX."menu";
//echo"nazev tabulky je $nazev_tabulky ";


if(isset($cislo_radku_plus)){  
       $cislo_radku = $cislo_radku_plus;
       $cislo_radku_horni = $cislo_radku-2;
       $cislo_radku_posouvany = $cislo_radku-1;
   

       
       //test
       //echo "</p> èíslo øádku  ".$cislo_radku." </p>";
       //echo "</p> èíslo øádku  ".$nazev_tabulky." </p>";
     


      $dotaz ="select * from $nazev_tabulky ";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_horni, 1 ");
      
      $row  =  mysql_fetch_row($result);
      
      $horni_id = $row[0];
      $horni_link = $row[1];
      $horni_jmeno = $row[2];
      $horni_jmeno_title = $row[3];
      $horni_key_sl = $row[4];
      $horni_formul_kontakt = $row[5];
      $horni_galerie = $row[6];
      
      //test 
      //echo $horni_id;
      //echo "<br><br><br><br>";
      
      
      $result= mysql_query(  $dotaz." limit $cislo_radku_posouvany, 1 ");    
      $row  =  mysql_fetch_row($result); 
      
      $akt_id = $row[0];
      $akt_link = $row[1];
      $akt_jmeno = $row[2];
      $akt_jmeno_title = $row[3];
      $akt_key_sl = $row[4];
      $akt_formul_kontakt = $row[5];
      $akt_galerie = $row[6];
      
      // test
      //echo $akt_id;
      //echo "<br>";
     
      
      
      
      
      if((isset($horni_id)) and ($horni_id > 1))   {
      
      // test
      //echo"<h1>ano muzeme provest akci</h1>";
      //echo $horni_id;
      //echo "<br>";
      //echo $akt_id;
      
      
      //nova pozice
      
       mysql_query(" 
              UPDATE $nazev_tabulky 
              SET id = '$horni_id' 
              , link = '$akt_link'
              , jmeno = '$akt_jmeno'
              , jmeno_title = '$akt_jmeno_title'
              , key_sl = '$akt_key_sl' 
              , formul_kontakt = '$akt_formul_kontakt' 
              , galerie = '$akt_galerie'
              
              WHERE id = '$horni_id'
              ");
      
      
       // puvodni pozice
        mysql_query(" 
              UPDATE $nazev_tabulky 
              SET  id = '$akt_id'
              , link = '$horni_link'
              , jmeno = '$horni_jmeno'
              , jmeno_title = '$horni_jmeno_title'
              , key_sl = '$horni_key_sl' 
              , formul_kontakt = '$horni_formul_kontakt' 
              , galerie = '$horni_galerie'
              
              WHERE id = '$akt_id'
              ");
           
      
      }
      
      
}


}



