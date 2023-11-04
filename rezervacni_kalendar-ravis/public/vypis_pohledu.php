<?php

// Stránka pro běžné uživatele
function shortcode_pro_vypsani_kalendare($attsproduct)
{
    $vypis = "";
    
    // třída ověří zda byla zadaná hodnota v shortcodu
    $spz = new RVS_over_identifikaci();
    $cisloRz = $spz->productcontrol($attsproduct);

    
    // ověříme zda zadaná hodnota existuje v tabulce
    $spz = new RvsVypisProdukt();
    $vypis .= $spz->overdb($cisloRz);

    // vypíše aktuální datum
    $dnesje = new RVS_kalendar();
    $vypis .= "<h6>" . $dnesje->datumDnes() . "</h6>";
    // třída pro vypsání formuláře pro ověření volného termínu
    $formular = new RVS_kalendar_formular();
    $vypis .= $formular->legenda();
    
    
    $data = new RVS_over_dostupnost_terminu();
    $odemkni = $data->validaceDatumu($cisloRz);
    
    
    $vypis .= $data->validaceDatumu($cisloRz); 
    
    $vstup = $data->validaceNacionale();
    $vypis .= $data->validaceNacionale();
    
    $data = new RVS_insert_db();
    $vypis .= $data->zapisDoTabulky($vstup);
    
    $vypis .= $formular->vypisformular($odemkni,$cisloRz);
    

    // vypíše kalendář pro zadanou hodnotu v shortcodu
    $kalendar = new RVS_kalendar();
    $vypis .= $kalendar->vykreslenikalendare($cisloRz);




    return $vypis;
}
// [kalendar_shortcode]
add_shortcode('kalendar_shortcode', 'shortcode_pro_vypsani_kalendare');



function shortcode_pro_vypsani_legendy_kalendare()
{


/* 
    // Zde můžete zobrazit obsah pro uživatele
    $html = 'možno smazat je to test';
    $html .= '<p class="rvs">legenda: <span style="' . BARVA_NEDOSTUPNE . '; padding:5px">nedostupné</span> | ';
    $html .= '<span style="' . BARVA_REZERVACE . '; padding:5px">rezervováno</span> | ';
    $html .= '<span style="' . BARVA_POPTAVKY . '; padding:5px">poptávka</span>. | ';
    $html .= '<span style="' . BARVA_DNES . '; padding:5px">aktuální den</span>.</p>';

 */



    //return $html;
}
// [kalendar_legenda_shortcode]
add_shortcode('kalendar_legenda_shortcode', 'shortcode_pro_vypsani_legendy_kalendare');
