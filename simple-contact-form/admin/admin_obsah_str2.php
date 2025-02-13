<?php
require_once(KONTAKTNI_MODUL_DIR.'inc/verze_pluginu.php'); 

echo "<div class='clearfix'>";
echo "<div class='box0'>";

$tabulka = new RvsAdminContact();

$vypis= $tabulka->vypisTabulkudb();
echo $vypis;

$vypis = $tabulka->update();
echo $vypis;

echo '</div></div>';



?>