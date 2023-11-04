<?php
class RvsVypisProdukt
{
    private $spzetka; // Vnitřní proměnná třídy

    public function __construct()
    {
        // Konstruktor třídy
        $this->spzetka = 0; // Inicializace vnitřní proměnné
    }

    public function pozdrav()
    {
        echo "test RZ";
    }





    public function overdb($cisloRz)
    {




        $this->spzetka = $cisloRz;

        // Metoda pro získání hodnoty vnitřní proměnné
        //echo "test" . $this->spzetka;
        global $wpdb;


        /**
         * SQL_TABULKA_PRODUCT je konstanta názvu tabulky kterou chceme zpracovat
         * jedná se o hlavni tabulku pro rezervace v kalendaři 
         **/
        $tabulka = SQL_TABULKA_PRODUCT;
        $existuje = new  RVS_over_tabulku();
        // Získání výstupu z metody Třídy RVS_over_tabulku
        $existujeTabulka = $existuje->overExistenciTabulky($tabulka);

        // Zde můžete pracovat s proměnnou $existujeTabulka
        if ($existujeTabulka) {


            // Zde nastavte název tabulky ve vaší databázi
            $my_table_name = $wpdb->prefix . SQL_TABULKA_PRODUCT;

            // Zde nastavte název sloupce, ve kterém chcete hledat
            $column_name = 'spz';

            // Zadejte hodnotu, kterou chcete prověřit
            $zadana_hodnota = $this->spzetka;

            // Sestavte dotaz pro ověření existence hodnoty
            $sql = $wpdb->prepare("SELECT COUNT(*) FROM $my_table_name WHERE $column_name = %s", $zadana_hodnota);

            // Spusťte dotaz
            $result = $wpdb->get_var($sql);

            if ($result > 0) {
                // Hodnota existuje v databázi
                //echo '<br>Hodnota existuje v databázi.';

                $sql = $wpdb->prepare("SELECT * FROM $my_table_name WHERE $column_name = %s", $zadana_hodnota);
                $vysledky = $wpdb->get_results($sql);

                // Zpracujte další data, například vytvořte tabulku HTML
                $html = '<table>';
                foreach ($vysledky as $radek) {
                    $html .= '<tr>';
                    $html .= '<td>vozidlo: ' . htmlspecialchars($radek->nazev) . ' - SPZ: ' . htmlspecialchars($radek->spz) . '</td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td>popis: ' . htmlspecialchars($radek->popis) . '</td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td> cena za den půjčení: ' . htmlspecialchars($radek->cena) . '</td>';
                    $html .= '<td> kauce za půjčení: ' . htmlspecialchars($radek->kauce) . '</td>';
                    // Další sloupce z tabulky
                    $html .= '</tr>';
                }
                $html .= '</table>';

                return $html;
            } else {
                // Hodnota neexistuje v databázi
                return '<p class="alert alert-warning">Hodnota neexistuje v databázi.</p>';
            }
        } else {
            return '<p class="alert alert-warning">kalendář není propojen s DB</p>';
        }
    }
}
