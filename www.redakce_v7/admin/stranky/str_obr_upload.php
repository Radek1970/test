
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

<?php
/*
skript pro nahraní souboru do zadane slozky
*/

$formular ='
<fieldset class="fieldset_warning"><legend class="legend_warning">vložit foto</legend>
<form action="page.php?akc=obr_upload" method="post" enctype="multipart/form-data">
<div class="form_contact">
<div class="form_row_contact">
<label class="left">soubor: </label>
  <input name="soubor" type="file" class="form_input_contact"/>
  
<div style="float:right; padding:10px 25px 0 0;">
<input type="submit" value="nahrát" class="form_button" /> 
</div>
  
  <input type="hidden" name="odeslano" value="ano" />
</div></div>  
</form>
</fieldset>';

$max_s = "550";
$max_v = "600";
$nazev_max_delka = "100";

// zjisti delku nazvu
$delka_nazvu = (strlen($_FILES["soubor"]["name"]));
//echo $delka_nazvu;

$zob = "ne"; 
if($_POST["odeslano"] == "ano") { 
/* ochrana */ 

if ($delka_nazvu > $nazev_max_delka){ $zob = "ano"; echo "<div class='admin_warnnig'>Obrázek má dlouhý název!</div>"; }
else{




   if($_FILES["soubor"]["error"]) { $zob = "ano"; 
   echo "<div class='admin_warnnig'>Nebyl vybrán žádný obrázek!</div>"; 
   } 
     else { 
     
     
  $rozmer_av = getimagesize($_FILES["soubor"]["tmp_name"]); 
  
  
  
      if($_FILES["soubor"]["type"] != "image/jpeg" AND $_FILES["soubor"]["type"] != "image/jpg" AND $_FILES["soubor"]["type"] != "image/pjpeg" ) { $zob = "ano"; 
      echo "<div class='admin_warnnig'>Obrázek mùže být jen ve formátu JPEG!</div>"; 
       } 
       
        
       if(($rozmer_av[0] > $max_s) and ($rozmer_av[1] > $max_v) )
       
       { $zob = "ano"; 
        echo "<div class='admin_warnnig'>Obrázek mùže mít maximální šíøku ".$max_s."px a výšku ".$max_v."px <br/> skuteèné rozmìry jsou:".$rozmer_av[0]."px x ".$rozmer_av[1]."px</div>"; 
        } 


        } 
} 
}
else {$zob = "ano";} 




if($zob == "ano") { 
echo $formular;

} 

else { 
$miniatura_s = 145; /* šíøka zmenšené fotky */ 
$miniatura_v = 145; /* šíøka zmenšené fotky */

$rozmery = getimagesize($_FILES["soubor"]["tmp_name"]); 
$pomer = $rozmery[0]/$rozmery[1]; 
$obr = imagecreatetruecolor($miniatura_s, $miniatura_v); 
$image = imagecreatefromjpeg($_FILES["soubor"]["tmp_name"]); 
imagecopyresampled($obr, $image, 0, 0, 0, 0, $miniatura_s, $miniatura_v, $rozmery[0], $rozmery[1]); 









// prenesena data z formulare budeme formatovat na odpovidajici nazev
$jmeno = ( $_FILES['soubor']['name']);

//Všechna velká písmena pøevede na malá 
$jmeno_male_znaky = (strtolower("$jmeno"));
 
//odstrani hacky carky mezery nahradi pomlkou
$jmeno_bez_hacku  = (StrTr($jmeno_male_znaky,  "ìšèøžýáíéúùò ", "escrzyaieuun_"));

//Vypoèítá délku øetìzce a odeète ètyri posledni znaky typu souboru napr. (.jpg)
$jmeno_delka =(strlen("$jmeno"));
$do = $jmeno_delka - 4;

//Vrátí vybranou èást øetìzce 
$upraveny_nazev = (substr($jmeno_bez_hacku,0,$do));

//vrati cast retezce stypem formatu obrazu
$format = (substr($jmeno_bez_hacku,$do));

// test vypsani
//echo $format;
//echo $upraveny_nazev;










imagejpeg($obr, "../foto_min/".$upraveny_nazev."".$format); /* Uložime miniaturu do složky */ 
imagedestroy($obr); /* A odstranime z Cache */ 



/* A uložime oroginál */ 
move_uploaded_file($_FILES["soubor"]["tmp_name"], "../foto/".$upraveny_nazev."".$format); 
/* Zde mùže být zapis do databáze */ 
echo "<div class='admin_info'>Foto  $jmeno bylo nahráno na server</div>"; 
echo $formular;












/*
skript vypisuje foto v zadané složce
*/

$adr ="../foto_min/";
$handle=opendir($adr); 

    if ($file != "." && $file != "..") 
    { 
    echo'	<div style="border:1px solid #dddddd; float:left;" >'; 
   
    echo "<img src='".$adr."".$upraveny_nazev."".$format."' alt='foto' title='foto' style='border:none; float:left;' /></a>";
     
     echo'</div>';   
    } 
  





closedir($handle);



        //Vypoèítá délku øetìzce a odeète ètyri posledni znaky typu souboru napr. (.jpg)
         $delka_jmena_orig = (strlen($_FILES["soubor"]["name"]));
         $do = $delka_jmena_orig - 4;// -4 odebere 4 znaky coz je delka formatu vcetne tecky
        //Vrátí vybranou èást øetìzce 
         $uprava_jmena_orig = (substr(($_FILES["soubor"]["name"]),0,$do));
         
         $nazev_tabulky = PREFIX."foto";
         //test
         /*
         echo $nazev_tabulky;
         echo "<br/>";
         echo $upraveny_nazev;
         echo "<br/>";
         echo $format;
         echo "<br/>";
         echo $uprava_jmena_orig;
         echo "<br/>";
         echo $rozmery[0];
         echo "<br/>";
         echo $rozmery[1];
         */
         $id = Date("jmYHis", Time());
         $jmeno_orig = $uprava_jmena_orig;
         $jmeno_uprav = $upraveny_nazev;
         $format_obr = $format;
         $vyska = $rozmery[0];
         $sirka = $rozmery[1];
         $ev_c_autora = $ev_c_autora;
         
         //vlozeni udaju do tabulkz v databzzi
         $dotaz="INSERT INTO $nazev_tabulky VALUES ('$id','$jmeno_orig','$jmeno_uprav','$format_obr','$vyska','$sirka','$ev_c_autora')";
      // spojeni dotazu a cesty - vzkonani prikazu
      $result = mysql_query($dotaz,$spojeni);
        





















}// konec else
?>
        
</div>
<!-- KONEC PRAVA STRANA -->	

















