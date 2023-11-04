<?php

// vypíše aktuální datum
$dnesje = new RVS_kalendar();
$vypis = '';
$vypis .= "<h6>" . $dnesje->datumDnes() . "</h6>";
echo $vypis;

echo "<div class='clearfix'>";
echo "<h2><span  class='info-panel-red'>Přehled rezervací</span></h2>";

echo "<div class='box0'>";
//** box A
echo "";
/**
 * vypisuje tabulku do stránky podle hodnty 
 * statutu. Stauty 0, 1, 2
 * statut 0 poptávka
 * statut 1 rezervace
 * statut 2 blokace
 * hodnoty statutu jsou uloženy v DB
 */
$tabulka = new RvsAdminRezervace();
$vypisTabulku = $tabulka->vypisStatut(1);





echo'</div></div></div>';

?>