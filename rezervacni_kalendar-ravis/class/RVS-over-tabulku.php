<?php
class RVS_over_tabulku
{
    public $tabulka;

    public function overExistenciTabulky($tabulka)
    {   // promena ktera nese nazev tabulky
        $this->tabulka = $tabulka;

        // Globální objekt WordPress Database
        global $wpdb;

        // spojeni nazvu tabulky s WP prefixem
        $tabulka = $wpdb->prefix . '' . $this->tabulka;

        // SQL dotaz pro zjištění existence tabulky
        $sql = "SHOW TABLES LIKE '$tabulka'";

        // Zjistíme, zda tabulka existuje
        $existuje_tabulka = $wpdb->get_var($sql);

        if ($existuje_tabulka === $tabulka) {
            // Tabulka existuje, provede se kód vrátíme TRUE
            //return TRUE;
            $existujeTabulka = true; // Předpokládejme, že tabulka existuje

            return $existujeTabulka;
        }
    }
}
