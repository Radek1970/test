<?php
class RvsOverTabulku
{
    public $tabulka;

     // Definice konstant
    
     const ZADANA_HODNOTA = '1';
     const COLUMN_NAME = 'statut';
     
     /**
      * SQL_TABULKA_PRODUCT je konstanta názvu tabulky kterou chceme zpracovat
      * jedná se o hlavni tabulku pro rezervace v kalendaři 
      **/
     const TABULKA = SQL_TABULKA_CONTACT_MODUL;

    public function overExistenciTabulky()
    {   // promena ktera nese nazev tabulky
        $this->tabulka = self::TABULKA;

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

    public function overExistenciZaznamu(){

        // promena ktera nese nazev tabulky
        $this->tabulka = self::TABULKA;
        $column_name = self::COLUMN_NAME;

        // Globální objekt WordPress Database
        global $wpdb;

        // spojeni nazvu tabulky s WP prefixem
        $tabulka = $wpdb->prefix . '' . $this->tabulka;

         // Sestavte dotaz pro ověření existence hodnoty
         $sql = $wpdb->prepare("SELECT COUNT(*) FROM $tabulka WHERE $column_name = %s", self::ZADANA_HODNOTA);

         // Spusťte dotaz
         $result = $wpdb->get_var($sql);

         return $result;


    }

    public function vratZaznamy(){

         // promena ktera nese nazev tabulky
        $this->tabulka = self::TABULKA;
        $column_name = self::COLUMN_NAME; 
        // Globální objekt WordPress Database
        global $wpdb;

        // spojeni nazvu tabulky s WP prefixem
        $tabulka = $wpdb->prefix . '' . $this->tabulka;

         $sql = $wpdb->prepare("SELECT * FROM $tabulka WHERE $column_name = %s", self::ZADANA_HODNOTA);

         //$vysledky = $wpdb->get_results($sql);
         $vysledky = $wpdb->get_row($sql);

         return $vysledky;


    }

    public function vratEmail(){

         // promena ktera nese nazev tabulky
         $this->tabulka = self::TABULKA;

         // Globální objekt WordPress Database
         global $wpdb;
 
         // spojeni nazvu tabulky s WP prefixem
         $tabulka = $wpdb->prefix . '' . $this->tabulka;
 

        // Připravit SQL dotaz
        $sql = $wpdb->prepare("SELECT email FROM $tabulka WHERE statut = %s", self::ZADANA_HODNOTA );

        /**
         * Použití: Pokud potřebujete vrátit více řádků z databáze (např. 
         * celý výsledek tabulky nebo více sloupců z několika řádků).
         */
        //$vysledky = $wpdb->get_results($sql);

        /** 
         *  Použití: Pokud potřebujete vrátit pouze jednu hodnotu (jedno pole a jeden sloupec), 
         * například počet řádků, maximální hodnotu, nebo konkrétní sloupec z prvního výsledku.
         */
        $vysledky = $wpdb->get_var($sql);

        return $vysledky;

    }

}
