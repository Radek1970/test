<?php
class RVS_over_dostupnost_terminu
{

    //private $errors = ""; // Pole pro ukládání chyb


    // Konstruktor třídy
    public function __construct()
    {
        // Zde můžete provést inicializaci, pokud je to potřeba
    }

   

    public function kontrolaDat($od_data, $do_data, $cisloRz)
    {
    

        $aktualniDatum = date("d.m.Y"); // Aktuální datum v formátu "DD.MM.YYYY"

        // Vypíše očištěný text bez mezer
        $od_data = str_replace(' ', '', $od_data);
        $do_data = str_replace(' ', '', $do_data);
        if (empty($od_data) || empty($do_data)) {
            // Pokud je alespoň jedno z dat prázdné, neprovádíme žádný kód
            return "Některé z dat je prázdné.";
        }


        if (strtotime($od_data) < strtotime($aktualniDatum) || strtotime($do_data) < strtotime($aktualniDatum)) {
            // Pokud alespoň jedno z dat je v minulosti, vypíšeme chybovou zprávu
            return "Některé z dat je v minulosti. Dnes je: $aktualniDatum [ $od_data - $do_data]";
        }

        if (strtotime($od_data) > strtotime($do_data)) {
            // Pokud alespoň jedno z dat je v minulosti, vypíšeme chybovou zprávu
            return "Počáteční datum je vetší než konečné datum. [$od_data - $do_data]";
        }

        // Zde můžete provádět další operace s daty
        //return "Data jsou platná a neprošla žádná kontrola.";



        global $wpdb; // Globální objekt WordPress databáze

        $tabulka = SQL_TABULKA_REZERVACE;
        // Získání dat z databáze (předpokládáme, že jsou již uložené datum_od a datum_do a statut)
        $rvs_rezervace_table = $wpdb->prefix . '' . $tabulka . '';

        /**Tento kód nejprve nahradí tečky za pomlčky pomocí funkce str_replace(), 
         * což vytvoří řetězec "23-10-2023". Poté použije funkci *strtotime() a date() 
         * k převedení tohoto řetězce na požadovaný formát "2023-10-23".
         **/
        // vstupní datum naformátujeme pro DB
        $odDatumu = date("Y-m-d", strtotime(str_replace('.', '-',  $od_data)));
        //echo $odDatumu; // Vypíše "2023-10-23"

        $doDatumu = date("Y-m-d", strtotime(str_replace('.', '-',  $do_data)));
        //echo $doDatumu; // Vypíše "2023-10-23"

        // SQL dotaz pro zjištění, zda existuje rezervace, která se překrývá s vstupními daty
        $sql = $wpdb->prepare(
            "SELECT COUNT(*) 
            FROM $rvs_rezervace_table
            WHERE 
            rz IN ('%s') AND (datum_od >= %s AND datum_do <= %s)",
            $cisloRz,
            $odDatumu,
            $doDatumu
        );

        $pocet_rezervaci = $wpdb->get_var($sql);

        if ($pocet_rezervaci > 0) {
            // Existují rezervace, které se s vstupními daty překrývají
            return "Rezervace v tomto termínu [$od_data - $do_data] není dostupná. ";
        } else {
            // Žádné překrývající se rezervace neexistují, termín je dostupný
            // return "Termín je dostupný a může být rezervován. [$od_data - $do_data / SPZ: $cisloRz ]";
        }
    }


    public function validaceNacionale()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['active'])) {
                if ($_POST['active'] == "go") {
                    $jmeno = htmlspecialchars($_POST['selected_name']);
                    $prijmeni = htmlspecialchars($_POST['selected_name2']);
                    $email = htmlspecialchars($_POST['selected_email']);
                    $tel = htmlspecialchars($_POST['selected_tel']);

                    $jmeno = str_replace(' ', '', (trim($jmeno)));
                    $prijmeni = str_replace(' ', '', (trim($prijmeni)));
                    //"+421 558 774 995" odstrani mezery;
                    $tel = str_replace(' ', '', (trim($tel)));
                    $email = (trim($email));

                    $errors2 = "";
                    //=====1       
                    if ((empty($jmeno)) || (empty($prijmeni))) {
                        $errors2  .= '<br>Jméno nebo přijmení nesmí být prázdné.<br>';
                    } else if ((preg_match("/[0-9]+/", $jmeno)) || (preg_match("/[0-9]+/", $prijmeni))) {
                        $errors2 .= "Jméno nebo přijmení nemůže obsahovat číslice.<br>";
                    } else {
                        $errors2 .=  null; // Žádná chyba 
                    }

                    //=====2
                    if (empty($email)) {
                        $errors2 .= "Email musí být vyplněn.<br>";
                    } else if (!preg_match('/[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9._-]+\.[a-zA-z]{2,4}$/', $email)) {
                        $errors2 .= "Email není ve správném formátu.<br>";
                    } else {
                        $errors2 .=  null; // Žádná chyba  
                    }

                    //=====3
                    if (empty($tel)) {
                        $errors2 .= "Telefon musí být vyplněn.<br>";
                    }
                    else if (preg_match('/^[+|00][0-9]{11,12}/i', $tel) == false) {
                        $errors2 .= "Telefon musí ve formátu +xxx xxx xxx xxx<br>";
                    }
                    else if (!empty($tel) && !preg_match('/^\+[0-9]{1,12}$/', $tel)){
                        $errors2 .= "Telefon musí obsahovat číslice, max.12.<br>";
                     }  
                    else {
                        $errors2 .=  null; // Žádná chyba  
                    }



                    $kontrola = new RVS_captcha_rok();
                    $errors2 .= $kontrola->over();


                    if (empty($errors2)) {
                        //echo "provede se zaápis do DB";
                        $vlozData = FALSE;
                        return  $vlozData;
                    } else {
                        return $errors2;
                    }
                }
            }
        }
    }


    public function validaceDatumu($cisloRz)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $od_data = htmlspecialchars($_POST['selected_date1']);
            $do_data = htmlspecialchars($_POST['selected_date2']);

            //echo $od_data;
            //echo $do_data;
            // Validace jednotlivých polí

            $errors = "";
            $errors  .= $this->kontrolaDat($od_data, $do_data, $cisloRz);



            if (empty($errors)) {
                // Data jsou platná, můžete je zpracovat
                // Zde můžete provést další akce, pokud nebyly nalezeny žádné chyby

                $pocet_rezervaci = FALSE;
                return $pocet_rezervaci;
            } else {
                return $errors;
            }
        }
    }
}
