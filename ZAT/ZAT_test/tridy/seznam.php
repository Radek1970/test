<?php

use Databaze;
use Zaklad\Html\ListovaniEasy;

/**
 * třída pro vypis a filtrováni 
 * záznamu v tabulce
 * 
 */
class Seznam
{
    /**
     * funkce pro test
     */
    public function pozdrav(): void
    {
        echo "pozdrav";
    }



    /**
     * vypise info z tabulky "seznam"
     * dle jednotlivých dotazů
     */

    public function citac(): string
    {
        $nazevTabulky = 'seznam';

        /*   
        $zaznamy5 = Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE statut=? ', '2');
        $pocet_STATUT2 = COUNT($zaznamy5);

        */
        $html = '';
        //$zaznamy = Db::queryAll('SELECT * FROM ' . $nazevTabulky . '');
        $zaznamy = Databaze::vsechnyRadky($nazevTabulky);
        
        $pocet_zaznamu = COUNT($zaznamy);
        if ($pocet_zaznamu == 0) {
            $pocet_zaznamu = "v DB není žádný záznam";
        } else {
            $pocet_zaznamu = COUNT($zaznamy);
        }
        $html .= 'Celkem záznamů v DB: ' . $pocet_zaznamu . ' pol.<br>';
        
                for ($i = 1; $i < 4; $i++) {
                    //echo "Hodnota $i <br>";
                    if ($i == 1) {
                        $x = ['CD'];
                        $y = 'CD';
                    }
                    if ($i == 2) {
                        $x = ['DVD'];
                        $y = 'DVD';
                    }
                    if ($i == 3) {
                        $x = ['KNIHA'];
                        $y = 'KNIHA';
                    }
        
                    $nazevTabulky = 'seznam';
                    $podminkovyDotaz = 'skupina = ?';
                    $parametry = $x;
                    $zaznamy = Databaze::vsechnyRadkyKdeJe($nazevTabulky, $podminkovyDotaz, $parametry);
                    $zaznam = $zaznamy;
                    ${'pocet_' . $y} = count($zaznamy);
                    $html .= 'Formát CD: ' . $y . '' .  ${'pocet_' . $y} . ' pol.<br>';
                }
        
 
        /* $html .= '<br>Ve stavu: ' .$pocet_STATUT1. ' pol.<br>';
        $html .= 'Mimo stav (zápůjčka): ' .$pocet_STATUT2. ' pol.';
 */
        return $html;
    }





    /**
     * vypis evidovanych položek
     * z databaze
     */
    public function seznamKrokuj(): void
    {



        /**
         * dotaz do DB
         * ziskani poctu zaznamu
         */
        $nazevTabulky = 'seznam';
        $zaznamy = Databaze::vsechnyRadky($nazevTabulky);
        //$zaznamy = Db::queryAll('SELECT * FROM ' . $nazevTabulky . '');
        $pocet_zaznamu = COUNT($zaznamy);

        /* ================= */
        /**
         * listování nastaveno na pocet zaznamu v DB /2
         * 
         * muže se doprogramovat generování vypsaných zaznamu na strance na zaklade
         * poctu zaznamu v DB
         *
         *
         * blok try a catch slouží k zachytávání a zpracování 
         * výjimek (chyb), které mohou nastat během vykonávání kódu.
         * 
         * volani metod tridy pro strankovani
         */

        // listovani v tabulce

        $naStranu = 3;
        $nastavPocet = ceil($pocet_zaznamu / $naStranu);

        $strankovani = new ListovaniEasy();
        try {
            $posouvani = $strankovani->listuj('' . $pocet_zaznamu . '', $nastavPocet);
        } catch (Exception $e) {
            $posouvani = $e->getMessage();
        }

        /**
         * kdyz neni v DB zadny zaznam
         * vypiseme hlasku
         * v opacnem pripade zpracovavame zaznamy
         */
        if ($pocet_zaznamu == 0) {
            echo ('<p class="fs-5 mb-4">v DB není žádný záznam.</p>');
        } else {

            /**
             * vypisuje formular 
             * pro filtrovani dotazu
             * @var $this $this
             */
            //$filtr = $this->fltry();
            //echo '' . $filtr . '<br>';

            /**
             * prenesene hodnoty z formuare
             * pro filtrovani dotazu
             * zaregistrujeme do session
             * @var array $_SESSION
             */
            if (isset($_POST['filtr'])) {
                $_SESSION['filtr'] = 0;
                $_SESSION['dotaz1'] = $_POST['dotaz1'];
                $_SESSION['dotaz2'] = $_POST['dotaz2'];
            }

            /**
             * generuje DB dotaz
             * poslane z formulare pro filtr
             */
            if (isset($_SESSION['filtr'])) {
                //echo 'je session';      
                $dotaz1 = $_SESSION['dotaz1'];
                $dotaz2 = $_SESSION['dotaz2'];
                echo '<br> FILTR: ' . $dotaz1 . ' - STATUT ' . $dotaz2;
                //$zaznamy = $this->DbDotazy($dotaz1, $dotaz2, $nazevTabulky, $strankovani->vratKolikRadku(), $strankovani->vratOdRadku());
            } else {
               // $zaznamy = Db::queryAll('SELECT * FROM ' . $nazevTabulky . '  LIMIT ? OFFSET ? ', $strankovani->vratKolikRadku(), $strankovani->vratOdRadku());
            }






            echo ('<h2>záznamy v databázi</h2>');
            //echo ('<h4>počet záznamů v databázi: ' . $strankovani->vratInfo() . '</h4>');
            // posouvání dan formulářem
            //echo '<div class=" col-8">' . $posouvani . '</div>';

            /* ======= výpis z tabulky "seznam" ========== */

            $i = 1;
            foreach ($zaznamy as $zaznam) {
                $form = '<div class="border border-primary row">';

                $form .= '<div class=" col-12">';
                $form .= '<br><p  class="fs-3 bg-primary text-white p-2"> ID: ' . htmlspecialchars($zaznam['id']) . ' medium: ' . htmlspecialchars($zaznam['skupina']) . '<strong> název: ' . htmlspecialchars($zaznam['nazev']) . '</strong></p>';
                $form .= '<p  class="fs-5 "> <strong>autor:</strong> ' . htmlspecialchars($zaznam['autor']) . ' <strong>žánr:</strong> ' . htmlspecialchars($zaznam['zanr']) . ' <strong>rok vydání:</strong> ' . htmlspecialchars($zaznam['rok']) . '</p>';
                $form .=  '<p><strong>popis: </strong>' . htmlspecialchars($zaznam['popis']) . '</p>';

                $statut = htmlspecialchars($zaznam['stav']);
                if (empty($statut)) {
                    $form .= '<p><strong>stav:</strong> je ve stavu </p>';
                } else {
                    $form .= '<p><strong>stav: není ve stavu - poz.</strong> ' . htmlspecialchars($zaznam['stav']) . '</p>';
                }
                $form .= '</div>';


                /**
                 * formulář pro vymazání položky ze seznamu
                 */
                $form .= '<div class=" col-3">';
                $form .= '<form method="post">';
                $form .= '<input type="hidden" name="id" value="' . htmlspecialchars($zaznam['id']) . '" />';
                $form .= '<input  class="btn btn-primary" type="submit" name="delet" value="odstranit ze seznamu" />';
                $form .= '</form>';
                $form .= '<br><br></div>';

                /**
                 * formulář pro editaci vybrané položky
                 */
                $form .= '<div class=" col-3">';
                $form .= '<form method="post"  action="index.php?stranka=seznamform">';
                $form .= '<input type="hidden" name="id" value="' . htmlspecialchars($zaznam['id']) . '" />';
                $form .= '<input  class="btn btn-primary" type="submit" name="edit" value="edituj" />';
                $form .= '</form>';
                $form .= '<br><br></div>';

                $form .= '</div><br>';
                echo $form;
                $i++;
            }

            // posouvání pod formulářem
            //echo '<div class=" col-8">' . $posouvani . '</div>';
        }
    }

    /**
     * formulář pro filtry 
     * filtrováni dotazů pro tabulku s 
     * názvem "seznam"
     * @param string
     */
    public function fltry()
    {
        $form = '<div class=" row ">';


        //=========================================
        $form .= '<div class=" col-2 ">';
        $form .= '<form method="post">';
        $form .= '<input type="hidden" name="dotaz1" value="CD" />';
        $form .= '<select name="dotaz2">';
        $form .= '<option value="0"> 0 - vše</option>';
        $form .= '<option value="1"> 1 - jen ve stavu</option>';
        $form .= '<option value="2"> 2 - jen mimo stav</option>';
        $form .= '</select>';
        $form .= '</div>';
        $form .= '<div class=" col-2 ">';
        $form .= '<input  class="btn btn-primary" type="submit" name="filtr" value="filtruj jen CD" />';
        $form .= '</form>';
        $form .= '</div>';


        //========================================
        $form .= '<div class=" col-2 ">';
        $form .= '<form method="post">';
        $form .= '<input type="hidden" name="dotaz1" value="DVD" />';
        $form .= '<select name="dotaz2">';
        $form .= '<option value="0"> 0 - vše</option>';
        $form .= '<option value="1"> 1 - jen ve stavu</option>';
        $form .= '<option value="2"> 2 - jen mimo stav</option>';
        $form .= '</select>';
        $form .= '</div>';
        $form .= '<div class=" col-2 ">';
        $form .= '<input  class="btn btn-primary" type="submit" name="filtr" value="filtruj jen DVD" />';
        $form .= '</form>';
        $form .= '</div>';

        //========================================
        $form .= '<div class=" col-2 ">';
        $form .= '<form method="post">';
        $form .= '<input type="hidden" name="dotaz1" value="KNIHA" />';
        $form .= '<select name="dotaz2">';
        $form .= '<option value="0"> 0 - vše</option>';
        $form .= '<option value="1"> 1 - jen ve stavu</option>';
        $form .= '<option value="2"> 2 - jen mimo stav</option>';
        $form .= '</select>';
        $form .= '</div>';
        $form .= '<div class=" col-2 ">';
        $form .= '<input  class="btn btn-primary" type="submit" name="filtr" value="filtruj jen KNIHY" />';
        $form .= '</form>';
        $form .= '</div>';


        //========================================
        //if (isset($_POST['filtr'])) {
        $form .= '<div class=" col-2 ">';
        $form .= '<form method="post">';
        $form .= '<input  class="btn btn-primary" type="submit" name="resetfiltr" value="resetuj filtr" />';
        $form .= '</form>';
        $form .= '</div>';
        //}

        $form .= '</div>';


        return $form;
    }

    /**
     * @param mixed $dotaz1
     * @param mixed $dotaz2
     * @return string
     * 
     * tabulkove dotazy s listovanim
     */
    public function DbDotazy($dotaz1, $dotaz2, $nazevTabulky, $strankovanivratKolikRadku, $strankovanivratOdRadku)
    {

        if ($dotaz2 == 2) {
            $dotaz2 = 2;
            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=? AND statut=? LIMIT ? OFFSET ? ',  $dotaz1, $dotaz2, $strankovanivratKolikRadku, $strankovanivratOdRadku);
        }

        if ($dotaz2 == 1) {
            $dotaz2 = 1;
            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=? AND statut=? LIMIT ? OFFSET ? ',  $dotaz1, $dotaz2, $strankovanivratKolikRadku, $strankovanivratOdRadku);
        }

        if ($dotaz2 == 0) {

            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=? LIMIT ? OFFSET ? ',  $dotaz1, $strankovanivratKolikRadku, $strankovanivratOdRadku);
        }
    }


    /**
     * @param mixed $dotaz1
     * @param mixed $dotaz2
     * @return string
     * 
     * tabulkove dotazy bez listovani
     */
    public function DbDotazy2($dotaz1, $dotaz2, $nazevTabulky)
    {
        if ($dotaz2 == 2) {
            $dotaz2 = 2;
            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=? AND statut=?',  $dotaz1, $dotaz2);
        }

        if ($dotaz2 == 1) {
            $dotaz2 = 1;
            //$dotaz1 = 'CD';
            //  return Db::queryAll('SELECT * FROM seznam WHERE skupina=? AND stav=?', $dotaz1, $dotaz2);
            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=? AND statut=?',  $dotaz1, $dotaz2);
        }

        if ($dotaz2 == 0) {

            return Db::queryAll('SELECT * FROM ' . $nazevTabulky . ' WHERE skupina=?',  $dotaz1);
        }
    }
}
