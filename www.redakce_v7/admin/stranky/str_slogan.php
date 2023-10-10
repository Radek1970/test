
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
    	<div class="admin_addoffer_title"><? echo $nadpis_stranky; ?></div>    
</div> 
  
<?

// naformatovani  formulare
$form = '<form id="myform" class="cssform" action="page.php?akc=slogan" method="post">

<input type="hidden" name="ok"  value="ano" size=25 />


                 <div class="form_contact">
                    
                    <div class="form_row_contact">
                    <label class="left">název firmy: </label>
                    <input type="text" name="jmeno_fy"  class="form_input_contact" />
                    </div>

                    <div class="form_row_contact">
                    <label class="left">slogan: </label>
                    <input type="text" name="slogan"  class="form_input_contact" />
                    </div>
                    
                    <div style="float:right; padding:10px 25px 0 0;">
                    <input type="submit" value="vložit nový" class="form_button" /> 
                    </div>
                  </div>

</form>';







 // vypis povodniho textu jmeno firmy
 	//otevreni souboru a jeho vypsani na hlavni stranku 
 $soubor = @ fopen("../slogan/slogan_fy.txt", "r") or die("Soubor nelze otevøít.");

 //vypsani obsahu s 1500 znaky
 while (! feof($soubor))
 {
  $radek = fgets($soubor, 1500);
  //print "$radek";
  
 }
 //fclose ($soubor);






  // vypis povodniho textu  slogan
 	//otevreni souboru a jeho vypsani na hlavni stranku 
 $soubor2 = @ fopen("../slogan/slogan_text.txt", "r") or die("Soubor nelze otevøít.");

 //vypsani obsahu s 1500 znaky
 while (! feof($soubor2))
 {
  $radek2 = fgets($soubor2, 1500);
  //print "$radek";
  
 }
 fclose ($soubor);



$vlozeny_text = "<div class='admin_warnnig'>PÙVODNÍ TEXT:<br/>Název firmy:&nbsp; $radek <br/>slogan:&nbsp;&nbsp; $radek2</div>";




// kontrola dat z formulare

if($ok == "ano"){

// validace formulare kontrola zda pole neni prazdne
if (($slogan == "")AND ($jmeno_fy == "")){ 
 echo "<div class='admin_warnnig'>není vyplnìny žádný text!</div>"; }
else{ 
 
// zjisti delku nazvu
$delka_nazvu = (strlen($slogan));
//echo $delka_nazvu;
$nazev_max_delka = "50";

// kontrola zda text neni prilis dlouhy
if ($delka_nazvu > $nazev_max_delka){ 
 echo "<div class='admin_warnnig'>Slogan má dlouhý název!</div>"; }
else{


// otevreni souboru
$soubor = fopen("../slogan/slogan_fy.txt", "w"); 
// zapis do souboru
fwrite($soubor, "$jmeno_fy"); 
// zavreni souboru
fclose($soubor);

// otevreni souboru
$soubor = fopen("../slogan/slogan_text.txt", "w"); 
// zapis do souboru
fwrite($soubor, "$slogan"); 
// zavreni souboru
fclose($soubor);




//vypis hlasky s vlozenym textem
$vlozeny_text = "<div class='admin_info'>vložený text: $jmeno_fy &nbsp;&nbsp; $slogan</div> ";

}


}
}

 echo $vlozeny_text;
 echo $form;
 
 
?>        
        
</div>
<!-- KONEC PRAVA STRANA -->	

















