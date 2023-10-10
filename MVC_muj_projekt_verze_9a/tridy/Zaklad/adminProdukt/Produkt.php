<?php

namespace Zaklad\adminProdukt;

use Db;
use Zaklad\Html\Validace;
use Zaklad\Html\Form;
use Zaklad\Html\KratkyText;
use Zaklad\Html\ListovaniEasy;
use Constanty;
use Presmeruj;
use Exception;

class Produkt
{
    private $produkty = '';

    /* ==|1|==========================*/
    /**
     *  @param string $statut
     */
    public function __construct(public int $statut)
    {
        $this->statut = $statut;
    }
    /* ==|2|==========================*/
    /**
     * funkce pro vypsani formulare
     */
    public function objednejKontrakt(): void
    {
        // pole kontrak pro formulář
        $kontrakt = array(
            'idUzivatel' => '',
            'idProduktu' => '',
            'nazev' => '',
            'castka' => '',
            'predmet' => '',
            'oddata' => '',
            'dodata' => ''

        );



        if (isset($_POST['objednat'])) {
            $uzivatel_id =  $_POST['idUzivatele'];
            $produkt_id =  $_POST['idProduktu'];
            $nazev_produktu =  $_POST['nazevProduktu'];
            /*
          echo $uzivatel_id;
          echo $produkt_id ;
          echo $nazev_produktu ;
          */

            /**
             * vypise detail produktu z databaze podle uvedeneho ID
             */
            $produkt = Db::queryOne('SELECT * FROM produkt WHERE pojistka_id=?', $produkt_id);

            //$vypis = '<div class=" col-12">';
            $vypis = '<strong>druh pojištění: </strong>' . htmlspecialchars($produkt['druh_pojistky']) . '';
            $vypis .= '<br> <strong>název: </strong>' . htmlspecialchars($produkt['nazev']) . '';
            $vypis .= '<br> <strong>popis: </strong>' . htmlspecialchars($produkt['popis']) . '';
            //$vypis .= '</div>';


            /* odeslana data z formulare */
            if (isset($_POST['validuj'])) {

                $validuj = new Validace();
                $klic =  $validuj->validujObjednavku();

                //echo $klic;
                if ($klic == 'ok') {
                    //odesli zvalidovaná data

                    $kontrakt = array(
                        $uzivatel_id,
                        $produkt_id,
                        htmlspecialchars($produkt['nazev']),
                        htmlspecialchars($_POST['castka']),
                        htmlspecialchars($_POST['predmet']),
                        htmlspecialchars($_POST['oddata']),
                        htmlspecialchars($_POST['dodata'])
                    );
                    echo '';

                    $formular = new Form('index.php?stranka=produktyrekapitulace', 'post', '');
                    $formular->form();
                    /* === label - type - name - hodnota === */
                    $formular->Input_pole('', 'hidden', 'data', $kontrakt[0] . '-' . $kontrakt[1] . '-' . $kontrakt[2] . '-' . $kontrakt[3] . '-' . $kontrakt[4] . '-' . $kontrakt[5] . '-' . $kontrakt[6]);
                    $formular->Input_pole('', 'hidden', 'pridej', '');

                    echo '<div class=" row bg-warning  p-1">';
                    $formular->button('objednat', 'potvrdit pro uložení objednávky');
                    echo '</div><br><strong>Předmět:</strong> ' . $_POST['predmet'] . ' ';

                    echo $vypis;
                }
            }
            if ($klic != 'ok') {
                echo $vypis;
                $formular = new Form('', 'post', '');
                $formular->form();
                /* === label - type - name - hodnota === */
                $formular->Input_pole('', 'hidden', 'idUzivatele', '' . $uzivatel_id . '');
                $formular->Input_pole('', 'hidden', 'idProduktu', '' . $produkt_id . '');
                $formular->Input_pole('', 'hidden', 'nazevProduktu', '' . htmlspecialchars($produkt['nazev']) . '');
                if (trim($this->statut) != Constanty::ADMINISTRATOR_WEBU) {
                    echo '<h1>Objednávka</h1><div class="row border border-primary p-5"><h5>Pro objednání výše uvedeného produktu vyplňte formulař a potvrďte odeslání</h5>';
                    echo '<div class="row"><div class=" col-6 ">';
                    $formular->Input_pole('*částka', 'text', 'castka', '' . htmlspecialchars($kontrakt['castka']) . '');
                    echo '</div>';
                    echo '<div class="col-6 ">';
                    $formular->Input_pole('*předmět', 'text', 'predmet', '' . htmlspecialchars($kontrakt['predmet']) . '');
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="col-6 ">';
                    $formular->Input_pole('*od data d.m.r.', 'text', 'oddata', '' . htmlspecialchars($kontrakt['oddata']) . '');
                    echo '</div>';
                    echo '<div class="col-6 ">';
                    $formular->Input_pole('*do data d.m.r.', 'text', 'dodata', '' . htmlspecialchars($kontrakt['dodata']) . '');
                    echo '</div>';
                    echo '</div>';

                    $formular->Input_pole('', 'hidden', 'validuj', '');
                    $formular->button('objednat', 'odeslat');
                    echo '</div>';
                }
            }
        }
        if (isset($_POST['detail'])) {
            $produkt_id =  $_POST['idProduktu'];
            $nazev_produktu =  $_POST['nazevProduktu'];
            /*
            echo $produkt_id ;
            echo $nazev_produktu ;
            */

            /**
             * vypise  produkt z databaze kde je uvedene ID
             */
            $produkt = Db::queryOne('SELECT * FROM produkt WHERE pojistka_id=?', $produkt_id);
            $vypis = '<div class=" col-12">';
            $vypis .= '<strong>druh pojištění: </strong>' . htmlspecialchars($produkt['druh_pojistky']) . '';
            $vypis .= '<br> <strong>název: </strong>' . htmlspecialchars($produkt['nazev']) . '';
            $vypis .= '<br> <strong>popis: </strong>' . htmlspecialchars($produkt['popis']) . '';
            $vypis .= '</div>';
            echo $vypis;

            if (isset($_SESSION['uzivatel_id'])) {
                $identUzivatele = ($_SESSION['uzivatel_id']);

                if (trim($this->statut) != Constanty::ADMINISTRATOR_WEBU) {
                    $form = '<br><div class=" col-2">';
                    $form .= '<form method="post"  action="index.php?stranka=produktyobj">';
                    $form .= '<input type="hidden" name="idUzivatele" value="' . $identUzivatele . '" />';
                    $form .= '<input type="hidden" name="idProduktu" value="' . htmlspecialchars($produkt['pojistka_id']) . '" />';
                    $form .= '<input type="hidden" name="nazevProduktu" value="' . htmlspecialchars($produkt['nazev']) . '" />';
                    $form .= '<input  class="btn btn-primary" type="submit" name="objednat" value="objednat" />';
                    $form .= '</form>';
                    $form .= '</div>';
                }
            }

            echo $form;
        }
    }
    /* ==|3|=============*/
    /**
     * zapise do databaze 
     * predana a zvalidovana data
     * z formulre 
     */
    public function pridejKontrakt(): void
    {
        $identUzivatele  = ($_SESSION['uzivatel_id']);
        if (isset($identUzivatele)) {


            $data = $_POST['data'];
            $parser = explode('-', $data);

            // predanadata z formulare

            $uzivatel_id = $identUzivatele;
            $produkt_id = ($parser[1]);
            $nazev_produktu = ($parser[2]);
            $castka = ($parser[3]);
            $predmet = ($parser[4]);
            $oddata = ($parser[5]);
            $dodata = ($parser[6]);

            /*  echo '<br>';
            echo $uzivatel_id;
            echo '<br>';
            echo $produkt_id;
            echo '<br>';
            echo $nazev_produktu;
            echo '<br>';
            echo $castka;
            echo '<br>';
            echo $predmet;
            echo '<br>';
            echo $oddata;
            echo '<br>';
            echo $dodata; */


            Db::query(' INSERT INTO kontrakt (uzivatel_id, produkt_id, produkt_nazev, oddata, dodata, castka, predmet)
            VALUES (?, ?, ?, ?, ?, ?, ?)',  $uzivatel_id, $produkt_id, $nazev_produktu,  $oddata, $dodata, $castka, $predmet);
        }
    }
    /* ==|4|=============*/
    /**
     * vypise vsechny produkty z databaze
     * nabídka produktu
     */
    public function nabidniProdukty(): void
    {

        $produkty = Db::queryAll('SELECT * FROM produkt');

        $pocet = count($produkty);
        echo ('<h2>Pojistné produkty</h2>');
        //echo ('<h4>počet záznamů v databázi: '.$pocet.'</h4>'); 

        if ($pocet == 0) {
            echo ('<p class="fs-5 mb-4">v nabídce není žádný produktů.</p>');
        } else {


            $i = 1;
            foreach ($produkty as $produkt) {
                $form = '<div class="border border-primary row">';

                $form .= '<div class=" col-12">';
                $form .= '<br><p  class="fs-3 bg-primary text-white p-2">' . $i . '. druh pojištění: <strong>' . htmlspecialchars($produkt['druh_pojistky']) . '</strong></p>';
                $form .= '<p  class="fs-5 "> <strong>název:</strong> ' . htmlspecialchars($produkt['nazev']) . '';

                $form .= '<br> <strong>popis:</strong> ';



                /* ========== zkraceny vypis ============== */
                //$strucne = $produkt['popis']; //string

                $strucne =  mb_substr(htmlspecialchars($produkt['popis']), 0, 550);

                //Převede všechna písmena v rětězci na velká
                $retezec = mb_strtoupper($strucne);
                $podretezec = mb_strtoupper('.');
                //Najde pozici prvního výskytu podřetězce v řetězci - revers
                $text =  (mb_strrpos($retezec, $podretezec));
                //Najde pozici prvního výskytu podřetězce v řetězci
                $delka = mb_strpos($retezec, $podretezec);
                //Vrátí podřetězec od startovní pozice s určitým počtem znaků
                $strucne =  mb_substr(htmlspecialchars($produkt['popis']), 0, $delka + 1);
                //echo ("Text má " . $delka . "znaků." . $text);

                $strucne = str_replace('.', ' ...', $strucne);
                /* ======================== */


                $form .=  '' . $strucne . '</p>';
                $form .= '<br><br></div>';
                $form .= '';
                $form .= '<div class=" col-2">';
                $form .= '<form method="post"  action="index.php?stranka=produktyobj">';
                $form .= '<input type="hidden" name="idProduktu" value="' . htmlspecialchars($produkt['pojistka_id']) . '" />';
                $form .= '<input type="hidden" name="nazevProduktu" value="' . htmlspecialchars($produkt['nazev']) . '" />';
                $form .= '<input  class="btn btn-primary" type="submit" name="detail" value="detail" />';
                $form .= '</form>';
                $form .= '<br></div>';
                $form .= '</div><br>';
                echo $form;
                $i++;
            }
        }
    }


    
    /* ==|5|=============*/
    /**
     * funkce vypise vsechny produkty 
     * a vlozi ID produktu do formulare
     * pro editaci nebo smazani
     */
    public function vypisProdukty(): void
    {



        if (trim($this->statut) == Constanty::ADMINISTRATOR_WEBU) {

            /**
             * vypise vsechny produkty z databaze
             */
            $produkty = Db::queryAll('SELECT * FROM produkt');
            $pocet = count($produkty);
            //echo 'test ok';
            /* ================= */
            // listovani

            $strankovani = new ListovaniEasy();

            try {
                $posouvani = $strankovani->listuj('' . $pocet . '', '3');
            } catch (Exception $e) {
                $posouvani = $e->getMessage();
            }

            $produkty = Db::queryAll('SELECT * FROM produkt LIMIT ? OFFSET ? ', $strankovani->vratKolikRadku(), $strankovani->vratOdRadku());
            /* ================= */
            
            /**
             * zavola funkci pro odstraneni produkt
             * z databaze del vybranehi ID
             */
            if (isset($_POST['odstranit'])) {
                $this->odstran($_POST['odstranit']);
            }





            echo ('<h2>Pojistné produkty v databázi</h2>');
            echo ('<strong>počet záznamů v databázi: ' . $strankovani->vratInfo() . '</strong>');
            echo ('<br><a  class="btn btn-primary" role="button" href="index.php?stranka=editaceproduktu">vložit záznam</a><br/> <br/>');

            if ($pocet == 0) {
                echo ('<p class="fs-5 mb-4">vytvořte první záznam v databázi pojišťovacích produktů.</p>');
            } else {

                echo $posouvani;


                $i = 1;
                foreach ($produkty as $produkt) {
                    $form = '<div class="bg-light text-dark row p-2 border border-secondary">';

                    $uprava = new KratkyText();
                    //$uprava->kratkyVypis ($produkt['popis']);

                    $form .= '<div class=" col-12">';
                    $form .= '<strong>ev.č. produktu: </strong>' . htmlspecialchars($produkt['pojistka_id']). '<br><strong> druh pojištění: </strong>' . htmlspecialchars($produkt['druh_pojistky']) . '';
                    $form .= '<br> <strong>název: </strong>' . htmlspecialchars($produkt['nazev']) . '';



                    if ($produkt['pojistka_id'] == $_POST['detail']) {
                        $form .= '<br> <strong>popis: </strong>' . htmlspecialchars($produkt['popis']) . '';
                    } else {
                        $form .= '<br> <strong>popis: </strong>' . $uprava->kratkyVypis($produkt['popis']) . '';
                    }

                    $form .= '<br><br></div>';
                    $form .= '';



                    $form .= '<div class=" col-2">';
                    $form .= '<form method="post">';
                    $form .= '<input type="hidden" name="detail" value="' . htmlspecialchars($produkt['pojistka_id']) . '" />';
                    $form .= '<input  class="btn btn-primary" type="submit" value="detail" />';
                    $form .= '</form>';
                    $form .= '</div>';

                    $form .= '<div class=" col-2">';
                    $form .= '<form method="post"  action="ndex.php?stranka=editaceproduktu">';
                    $form .= '<input type="hidden" name="editovat" value="' . htmlspecialchars($produkt['pojistka_id']) . '" />';
                    $form .= '<input  class="btn btn-primary" type="submit" value="otevřít editaci" />';
                    $form .= '</form>';
                    $form .= '</div>';

                    $form .= '<div class=" col-8">';
                    $form .= '<form method="post" onsubmit="return dotazPredOdeslanim(this);">';
                    $form .= '<input type="hidden" name="odstranit" value="' . htmlspecialchars($produkt['pojistka_id']) . '" />';
                    $form .= '<input  class="btn btn-primary" type="submit" value="odstranit" />';
                    $form .= '</form>';
                    $form .= '</div>';

                    $form .= '</div><br>';
                    echo $form;
                    $i++;
                }
            }
        } else {
            echo 'přístup nepovolen';
        }
    }
    /* ==|6|=============*/
    /**
     * funkce pro vypsani formulare
     * pro vlozeni a editaci produktu
     */
    public function formularProdukt()
    {

        // pole produkt pro formulář
        $produkt = array(
            'pojistka_id' => '',
            'druh_pojistky' => '',
            'nazev' => '',
            'popis' => '',
        );

        // Načtení produkt editaci
        if (isset($_POST['editovat'])) {
            //echo $_POST['editovat'];     
            $produkt = $this->nacti($_POST['editovat']);
        } else {

            // Zpracování dat odeslánych z formuláře
            if ($_POST) {
                if (!$_POST['pojistka_id']) {
                    /** 
                     *  vola funkci pro vlozeni novych dat
                     */
                    $this->pridej($_POST['druh_pojistky'], $_POST['nazev'], $_POST['popis']);
                } else {
                    /**
                     * vola funkci pro editaci stavajicich dat
                     */
                    $this->uprav($_POST['pojistka_id'], $_POST['druh_pojistky'], $_POST['nazev'], $_POST['popis']);
                }

                $smer = new Presmeruj();
                $smer->presmerovaniNaStranku('administraceproduktu');
            }
        }


        /**
         * vola funkci pro vygenerovani formulare
         */
        $formular = new Form('', 'post', '');
        $formular->form();
        /* === label - type - name - hodnota === */
        $formular->Input_pole('', 'hidden', 'pojistka_id', '' . htmlspecialchars($produkt['pojistka_id']) . '');
        $formular->Input_pole('druh produktu', 'text', 'druh_pojistky', '' . htmlspecialchars($produkt['druh_pojistky']) . '');
        $formular->Input_pole('název produktu', 'text', 'nazev', '' . htmlspecialchars($produkt['nazev']) . '');
        $formular->Input_pole('popis produktu', 'textarea', 'popis', '' . htmlspecialchars($produkt['popis']) . '');

        $formular->button('submit', 'odeslat');
        echo ('<a href="index.php?stranka=administraceproduktu">zpět na seznam</a>');
    }
    /* ==|7|=============*/
    /**
     * Přidá do databáze nový produkt
     * @param string $druh_pojistky
     * @param string $nazev
     * @param string $popis
     */
    public function pridej(string $druh_pojistky, string $nazev, string $popis): void
    {
        Db::query(' INSERT INTO produkt (druh_pojistky, nazev, popis)
        VALUES (?, ?, ?)',  $druh_pojistky, $nazev, $popis);
    }
    /* ==|8|=============*/
    /**
     * Načte a vrátí produkt podle jeho id
     * @return array produkt
     */
    public function nacti($produktId): array
    {
        return Db::queryOne('SELECT * FROM produkt WHERE pojistka_id=?', $produktId);
    }
    /* ==|9|=============*/
    /**
     * Upraví v databázi záznam - produkt s daným id
     * @param int $pojistkaId
     * @param string $druhPojistky
     * @param string $nazev
     * @param string $popis
     */
    public function uprav(int $pojistkaId, string $druhPojistky, string $nazev, string $popis): void
    {
        Db::query('UPDATE produkt SET druh_pojistky=?, nazev=?, popis=? WHERE pojistka_id=?', $druhPojistky, $nazev, $popis, $pojistkaId);
    }
    /* ==|10|=============*/
    /**
     * Odstraní produkt s daným id
     * @param int $pojistkaId
     */
    public function odstran(int $pojistkaId): void
    {
        Db::query('DELETE FROM produkt WHERE pojistka_id=?', $pojistkaId);
        $smer = new Presmeruj();
        $smer->presmerovaniNaStranku('produkty');
    }
}
