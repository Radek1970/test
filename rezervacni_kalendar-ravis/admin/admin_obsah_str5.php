<?php

// vypíše aktuální datum
$dnesje = new RVS_kalendar();
$vypis = '';
$vypis .= "<h6>" . $dnesje->datumDnes() . "</h6>";
echo $vypis;

echo "<div class='clearfix'>";
echo "<h2><span  class='info-panel-grey'>Přehled produktů</span></h2>";

echo "<div class='box0'>";
$tabulka = new RvsAdminProduktu();

$vypis = $tabulka->formularVlozeni();
echo $vypis;




$vypis = $tabulka->adminTabulkaProduktu();
echo $vypis;

echo'</div></div></div>';

?>