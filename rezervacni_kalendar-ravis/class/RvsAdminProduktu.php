<?php

class RvsAdminProduktu
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function test()
    {
        echo "test spojeni";
    }

    public function sqlDotazyTabProduktu($nazevTabulky)
    {
        //return Databaze::dotaz('SELECT * FROM automobil LEFT JOIN zamestnanec USING (zamestnanec_id) ORDER BY spz')->fetchAll();
        return "SELECT * FROM $nazevTabulky ";
    }



    public function vlozProdukt($nazev, $spz, $popis, $cena, $kauce, $stav)
    {
        echo $nazev;
        global $wpdb;

        // Název tabulky ve vaší databázi
        $tabulka = $wpdb->prefix . SQL_TABULKA_PRODUCT;

        // SQL dotaz pro zjištění, zda existuje rezervace, která se překrývá s vstupními daty
        $sql = $wpdb->prepare("SELECT COUNT(*) FROM $tabulka");

        $pocet_zaznamu = $wpdb->get_var($sql);

        // Ověření dat v DB kdyby se formulář znovu odeslal se stejnými daty
        if ($pocet_zaznamu > 11) {
            return "je povoleno jen 10 záznamů";
        } else {
            // Žádné překrývající se rezervace neexistují, termín je dostupný

            $query = $wpdb->prepare(
                "INSERT INTO $tabulka (nazev, spz, popis, cena, kauce, stav) VALUES (%s, %s, %s, %s, %s, %s)",
                $nazev,
                $spz,
                $popis,
                $cena,
                $kauce,
                $stav
            );

            $result = $wpdb->query($query);

            if (false === $result) {
                return '<span class="warningRVS">Chyba při aktualizaci záznamu: ' . $wpdb->last_error . '</span>';
            } else {
                //vymaže formulář a naství na výchozí hodnoty
            $_POST['nazevNovy'] = '';
            $_POST['spzNovy'] = '';
            $_POST['popisNovy'] = '';
            $_POST['cenaNovy'] = '';
            $_POST['kauceNovy'] = '';
            $_POST['stavNovy'] = '';
                return '<span class="infoRVS">Záznam byl vytvořen</span>';
            }
        }
    }

    public function editujProdukt($id, $nazev, $spz, $popis, $cena, $kauce,  $stav)
    {


        global $wpdb;
        // Zde nastavte název tabulky ve vaší databázi
        $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_PRODUCT;

        // znacka=?, barva=?, spz=?,
        $query = $wpdb->prepare(
            "UPDATE $rvs_rezervace_table SET nazev= %s, spz= %s, popis= %s, cena= %s, kauce = %s, stav= %s WHERE id = %d",
            $nazev,
            $spz,
            $popis,
            $cena,
            $kauce,
            $stav,
            $id
        );


        $result = $wpdb->query($query);

        if (false === $result) {
            return '<span  class="warningRVS">Chyba při aktualizaci záznamu: ' . $wpdb->last_error . '</sapn>';
        } else {
            return '<span  class="infoRVS"> Záznam s ID [ ' . $id . ' ] byl aktualizová </span>';
        }
    }

    public function ProduktValidace($nazev, $spz, $cena, $kauce)
    {



        $errors2 = "";
        //=====1       
        if ((empty($nazev)) || (empty($spz)) || (empty($cena)) || (empty($kauce))) {
            $errors2  .= '<span  class="warningRVS"><b>Pole označené * nesmí být prázdné.</b></span>';
        } else if ((preg_match("/[a-zA-Z]+/", $cena)) || (preg_match("/[a-zA-Z]+/", $kauce))) {
            $errors2 .= "cena nebo kauce musí obsahovat jen číslice.<br>";
        } else {
            $errors2 .=  null; // Žádná chyba 
        }



        return $errors2;
    }

    public function formularVlozeni()
    {
        if (isset($_POST['vloz'])) {
            echo $_POST['vloz'];
            $nazev = htmlspecialchars($_POST['nazevNovy']);
            $spz = htmlspecialchars($_POST['spzNovy']);
            $popis = htmlspecialchars($_POST['popisNovy']);
            $cena = htmlspecialchars($_POST['cenaNovy']);
            $kauce = htmlspecialchars($_POST['kauceNovy']);
            $stav = htmlspecialchars($_POST['stavNovy']);

            $erorors =  $this->ProduktValidace($nazev, $spz, $cena, $kauce);
            if (empty($erorors)) {
                //echo "možno zpracovat";
                //echo $this->editujProdukt($id, $nazev, $spz, $popis, $cena, $kauce,  $stav);
                echo $this->vlozProdukt($nazev, $spz, $popis, $cena, $kauce, $stav);
            } else {
                echo $erorors;
            }
        }



        $table = "<table class='box0' >";
        $table .= "
            <th>*název</th>
            <th>*Spz</th>
            <th>*cena</th>
            <th>*kauce</th>
            <th>satv</th>
            <th>popis</th></tr>";

        $table .= '<form method="POST">';
        $table .= "<tr>";


        $table .= '<td><input type="text" name="nazevNovy" value="';
        $table .= (isset($_POST['nazevNovy'])) ? $_POST['nazevNovy'] : '';
        $table .= '"></td>';
        $table .= '<td><input type="text" name="spzNovy" value="';
        $table .= (isset($_POST['spzNovy'])) ? $_POST['spzNovy'] : '';
        $table .= '"></td>';
        $table .= '<td><input type="text" name="cenaNovy" value="';
        $table .= (isset($_POST['cenaNovy'])) ? $_POST['cenaNovy'] : '';
        $table .= '"></td>';
        $table .= '<td><input type="text" name="kauceNovy" value="';
        $table .= (isset($_POST['kauceNovy'])) ? $_POST['kauceNovy'] : '';
        $table .= '"></td>';
        $table .= '<td><input type="text" name="stavNovy" value="';
        $table .= (isset($_POST['stavNovy'])) ? $_POST['stavNovy'] : '';
        $table .= '"></td>';
        //$table .= "</tr>";

        //$table .= "<tr>";
        $table .= '<td>';
        $table .= '<textarea id="w3review" name="popisNovy" rows="1" cols="50">';
        $table .= (isset($_POST['popisNovy'])) ? $_POST['popisNovy'] : '';
        $table .= '</textarea>';
        $table .= '</td>';

        $table .= '<td>';
        $table .= '<input type="hidden" name="vloz" value="go"><input type="submit" value="vloz">';
        $table .= '</td>';

        $table .= "</tr>";
        $table .= '</form>';

        $table .= "</table>";

        echo $table;
    }







    public function adminTabulkaProduktu()
    {



        if (isset($_POST['edituj'])) {
            echo $_POST['id'];
            $id = $_POST['id'];
            $nazev = htmlspecialchars($_POST['nazev']);
            $spz = htmlspecialchars($_POST['spz']);
            $popis = htmlspecialchars($_POST['popis']);
            $cena = htmlspecialchars($_POST['cena']);
            $kauce = htmlspecialchars($_POST['kauce']);
            $stav = htmlspecialchars($_POST['stav']);


            $erorors =  $this->ProduktValidace($nazev, $spz, $cena, $kauce);
            if (empty($erorors)) {
                //echo "možno zpracovat";
                echo $this->editujProdukt($id, $nazev, $spz, $popis, $cena, $kauce,  $stav);
            } else {
                echo $erorors;
            }
        }


        global $wpdb;
        // Zde nastavte název tabulky ve vaší databázi
        $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_PRODUCT;
        //$rvs_rezervace_table = $wpdb->prefix . 'nazev_vase_tabulky'; // Nahraďte 'nazev_vase_tabulky' názvem vaší tabulky
        // vypisuje sql dotazy pro zadanu tabulku
        $query = $this->sqlDotazyTabProduktu($rvs_rezervace_table);

        $produkty = $wpdb->get_results($query, OBJECT);


        if ($produkty) {


            $table = "<table class='box00' >";
            $table .= "<tr><td>";
            //$table .= "<p><b>" . $this->editujProdukt() . "</p></b>";
            $table .= "</td></tr>";
            $table .= "</table>";

            $table .= "<table class='box0' >";
            $table .= "<th>id</th>
            <th></th>
            <th>název</th>
            <th>Spz</th>
            <th>cena</th>
            <th>kauce</th>
            <th>satv</th>
            <th>popis</th></tr>";

            foreach ($produkty as $produkt) {
                $table .= '<form method="POST">';
                $table .= "<tr>";

                $table .= '<td>' . $produkt->id . '</td>';
                $table .= '<td><input type="hidden" name="id" value="' . $produkt->id . '"></td>';
                $table .= '<td><input type="text" name="nazev" value="' . $produkt->nazev . '"></td>';
                $table .= '<td><input type="text" name="spz" value="' . $produkt->spz . '"></td>';
                $table .= '<td><input type="text" name="cena" value="' . $produkt->cena . '"></td>';
                $table .= '<td><input type="text" name="kauce" value="' . $produkt->kauce . '"></td>';
                $table .= '<td><input type="text" name="stav" value="' . $produkt->stav . '"></td>';
                //$table .= "</tr>";

                //$table .= "<tr>";
                $table .= '<td>';
                $table .= '<textarea id="w3review" name="popis" rows="1" cols="50">' . $produkt->popis . '</textarea>';
                $table .= '</td>';

                $table .= '<td>';
                $table .= '<input type="hidden" name="edituj" value="go"><input type="submit" value="edituj">';
                $table .= '</td>';

                $table .= "</tr>";
                $table .= '</form>';
            }
            $table .=  "</table>";

            echo $table;
        } else {
            echo "Žádná data nebyla nalezena. vlož formuř pro vložení prvního produktu";
        }
    }
}
