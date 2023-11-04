<?php

class RVS_kalendar
{
    // Properties
    public $name;
    public $color;
    public $prictiMesice = "0";
    //public $spz;
    //public $cislo ="";

    /* 
    public function __construct() {
        $this->hodnotaSpz = ""; // Inicializace instanční proměnné
    }
    public function zpracujSpz($cislo)
    {
        $this->hodnotaSpz = $cislo;    
    }
    public function ziskatSpz()
    {
        echo "xxx".$this->hodnotaSpz;
        $hodnotaSpz = $this->hodnotaSpz;
       
        return $this->hodnotaSpz; // Vrácení hodnoty instanční proměnné
        //return $this->hodnotaSpz;
    } */


    public function datumDnes(): string
    {
        $dnes = date("d.n.Y");
        return "dnes je: " . $dnes;
    }







    public function vypisKalendare($prictiMesice, $hodnotaSpz): string
    {


        if (empty($prictiMesice)) {
            $prictiMesice = "0";
        }

        // Získání aktuálního roku a měsíce
        $currentYear = date("Y");
        $currentMonth = date("n");
        $currentDay = date("d");
        $currentDate = date("Y-m-d");
        // Kontrola platnosti měsíce a jeho přičtení
        if (is_numeric($prictiMesice) && $prictiMesice >= 0 && $prictiMesice <= 11) {
            $currentMonth = date("n") + $prictiMesice;
            if ($currentMonth > 12) {
                $currentMonth -= 12;
                $currentYear += 1; // Přechod na další rok
            }
        } else {
            // Neplatný počet měsíců, nastavit na aktuální měsíc
            $currentMonth = date("n");
        }
        // Kontrola platnosti roku
        if (!is_numeric($currentYear)) {
            $currentYear = date("Y");
        }


        $monthNames = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
        // Získání názvu měsíce pro únor (index 2)
        $mesiceCz = $monthNames[$currentMonth];

        // Počet dní v aktuálním měsíci
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        // První den měsíce
        $firstDayOfMonth = date("N", strtotime("$currentYear-$currentMonth-01"));

        // Vytvoření tabulky pro kalendář
        $date = date_create("$currentYear-$currentMonth-$currentDay");

        // Inicializace proměnné pro počítání dnů
        $dayCounter = 1;

        //$selectMonth = $currentMonth;

        // Výpis názvu měsíce
        //echo $mesiceCz; // Vypíše 'únor'




        /**
         * konstanta názvu tabulky kterou chceme zpracovat
         * jedná se o hlavni tabulku pro rezervace v kalendaři 
         **/
        $tabulka = SQL_TABULKA_REZERVACE;
        $existuje = new  RVS_over_tabulku();
        // Získání výstupu z metody Třídy RVS_over_tabulku
        $existujeTabulka = $existuje->overExistenciTabulky($tabulka);

        // Zde můžete pracovat s proměnnou $existujeTabulka
        if ($existujeTabulka) {

            // Tabulka existuje, provede se kód

            global $wpdb; // Globální objekt WordPress Database

            // Získání dat z databáze (předpokládáme, že jsou již uložené datum_od a datum_do a statut)
            $rvs_rezervace_table = $wpdb->prefix . '' . $tabulka . '';
            //$rvs_rezervace_table = $wpdb->prefix . 'rvs_rezervace';

            // Zde nastavte název sloupce, ve kterém chcete hledat
            $column_name = 'rz';
            // Zadejte hodnotu, kterou chcete prověřit
            $zadana_hodnota = htmlspecialchars($hodnotaSpz);





            $sql = $wpdb->prepare("SELECT statut, datum_od, datum_do FROM $rvs_rezervace_table WHERE $column_name = %s OR $column_name =  %s ", $zadana_hodnota, NULL);

            // Počet řádků v poli $result
            //$result = $wpdb->get_results($sql);
            $result = $wpdb->get_results($sql, ARRAY_A);
            //echo count($result);
            if (is_array($result) && count($result) > 0) {

                // Vytvoření pole pro data z databáze
                $events = array();
                foreach ($result as $row) {
                    $events[] = array(
                        "datum_od" => $row["datum_od"],
                        "datum_do" => $row["datum_do"],
                        "statut"   => $row["statut"]
                    );
                }
            }
        } else {
            // Tabulka neexistuje, nastavíme počet řádků na 0
            //echo "nelze se spojit s databází!!";
            $result = "0";
        }











        $html = "";
        $html .= ($mesiceCz) . " - " . date_format($date, "Y") . "<table class='table table-bordered  table-sm'>";
        $html .= "<tr><th>Po</th><th>Út</th><th>St</th><th>Čt</th><th>Pá</th><th>So</th><th>Ne</th></tr>";

        // Vytvoření kalendáře a označení dnů, které odpovídají datům v databázi
        for ($row = 1; $row <= 6; $row++) {
            $html .= "<tr>";
            for ($col = 1; $col <= 7; $col++) {
                $cellDate = date("Y-m-d", strtotime("$currentYear-$currentMonth-$dayCounter"));

                $isEventDay = false;
                $eventColor = ""; // Barva podle statutu

                if (is_array($result) && count($result) > 0) {

                    foreach ($events as $event) {

                        if ($cellDate >= $event["datum_od"] && $cellDate <= $event["datum_do"]) {
                            $isEventDay = true;

                            if ($event["statut"] == 1) {
                                $eventColor = "" . BARVA_REZERVACE . ""; // Barva pro statut 1
                            } else if ($event["statut"] == 2) {
                                $eventColor = "" . BARVA_NEDOSTUPNE . ""; // Barva pro statut  2
                            } else {
                                $eventColor = "" . BARVA_POPTAVKY . ""; // Barva pro ostatní statuty
                            }

                            break;
                        }
                    }
                }




                if ($dayCounter <= $daysInMonth && ($row > 1 || $col >= $firstDayOfMonth)) {

                    if ($cellDate === $currentDate) {
                        // Pokud aktuální datum odpovídá datu v buňce, označíme aktuální den
                        $eventColor = "" . BARVA_DNES . ""; // styl pro aktuální den
                        $isEventDay = true;
                    }

                    $html .= "<td" . ($isEventDay ? " style='$eventColor'" : "") . ">$dayCounter</td>";
                    $dayCounter++;
                }
                /*  if ($dayCounter <= $daysInMonth && ($row > 1 || $col >= $firstDayOfMonth)) {
                        if ($cellDate === $currentDate) {
                            // Pokud aktuální datum odpovídá datu v buňce, označíme aktuální den
                            $isEventDay = true;
                        }
            
                        $html .= "<td" . ($isEventDay ? " style='$eventColor;'" : "") . ">$dayCounter</td>";
                        $dayCounter++;
                    } */ else {
                    $html .= "<td>&nbsp;</td>";
                }
            }


            $html .= "</tr>";
        }

        $html .= "</table>";
        return $html;
    }




    public function vykreslenikalendare($hodnotaSpz)
    {


        //  pocet sloupcu col zarovnání podle boostrap
        $pocetListuKalendare = "4"; //vypise počet kalendářní listy podle zadané hodnoty
        switch ($pocetListuKalendare) {
            case "2":
                $pocetsloupcu = "6";
                break;
            case "3":
                $pocetsloupcu = "4";
                break;
            default:
                $pocetsloupcu = "3";
        }

        $listKalendare = 0; // kalendařní list nastaven na inicializační hodnotu 0 = jeden list 1 = dva listy atd.
        $html = "<div class='row'>";

        //klasický zapis nahrezen LOOPS
        //$html .= "<div class='table-responsive  '>";
        //$html .= $mesic->vypisKalendare("0", $hodnotaSpz);
        //$html .= $mesic->vypisKalendare("1", $hodnotaSpz);
        //$html .= "</div>";


        if ($listKalendare == 0) {
            $hodnotaSpz; // Uložení první hodnoty hodnotu odesíleme jen jednou
        } else {
            $hodnotaSpz = "";
        }
        $mesic = new RVS_kalendar();

        while ($listKalendare <= $pocetListuKalendare - 1) {
            //echo "The number is: $listKalendare<br>";
            $html .= "<div class='table-responsive col-sm-$pocetsloupcu '>";
            $html .= $mesic->vypisKalendare("$listKalendare", $hodnotaSpz);
            $html .= "</div>";
            $listKalendare++;
        }



        $html .= "</div>";

        return $html;
    }
}
