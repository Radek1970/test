<?php
// Deklarace namespaců, které budeme využívat
use Zaklad\Html\Form;
use Zaklad\Html\Validace;
use Zaklad\adminUzivatele\Uzivatel;
use Zaklad\adminProdukt\Produkt;

/* ======================================================== */
/* ======================================================== */
/* ==101=================== */
/* ==stranka=bocni panel*/

function WidgetUzivatelPrihlasen()
{
  if (isset($_SESSION['uzivatel_jmeno'])) {
    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $statusUzivatele =  ($_SESSION['uzivatel_admin']);
    $identUzivatele = ($_SESSION['uzivatel_id']);
    // volani tridy
    $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);

    echo '<div class="alert  col-sm-12">';
    $klient->infoPanel();
    echo '</div>';
  } else {
    echo ('<a  class="btn btn-outline-primary" role="button" href="index.php?stranka=registrace">Registrace</a>                                
           <a  class="btn btn-outline-primary" role="button" href="index.php?stranka=prihlaseni">Přihlášení</a>');
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==102=================== */
/* ==stranka=bocni panel*/
function WidgetUzivatelUcet()
{
  if (isset($_SESSION['uzivatel_jmeno'])) {
    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $statusUzivatele =  ($_SESSION['uzivatel_admin']);
    $identUzivatele = ($_SESSION['uzivatel_id']);
    // volani tridy
    $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);

    echo '<div class="card mb-4"><div class="card-header">Účet</div>
               <div class="card-body">
               <div class="alert alert-success col-sm-12">';
    $klient->ucet();
    echo '</div></div></div>';
  }
}

/* ======================================================== */
/* ======================================================== */
/**
 * funkce pro overeni zda je uzivatel prihlaseny
 * kdyz neni prihlaseny vratime FALSE
 */
function overPrihlaseni()
{
  if (isset($_SESSION['uzivatel_jmeno'])) {

    return TRUE;
  }
  return FALSE;
}

/* ==103=================== */
/* ==stranka=prihlaseni*/
function WidgetUzivatelPrihlasovaciFormular()
{
  /**
   * if - když je uzivatel prihlaseny 
   * vypiseme do strany pro prihlaseni
   * ze je uzivtel jiz prihlasený
   * else - v opacnem pripade vypiseme do stranky prihlasovaci formular
   */
  if (overPrihlaseni() == TRUE) {

    $info = new InfoText();
    $info->prihlaseny();
  }
  if (overPrihlaseni() == FALSE) {
    /**
     * nacteme tridu pro vygenerovani
     * prihlasovaciho formulare ze tridy Form
     */

    $formular = new Form('', 'post', '');
    $formular->form();
    $formular->Input_pole('*Vaše Jméno', 'text', 'jmeno', '');
    $formular->Input_pole('*heslo', 'password', 'heslo', '');
    $formular->button('odeslat', 'Přihlásit se ');
  }

  if (isset($_POST['odeslat'])) {
    $validuj = new Validace();
    $validuj->validujPrihlaseni();
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==104=================== */
/* ==stranka=registrace*/
function WidgetUzivatelRegistracniFormular()
{
  if (overPrihlaseni() == TRUE) {;
    $info = new InfoText();
    $info->prihlaseny();
  }

  if (isset($_POST['registrace'])) {
    $validuj = new Validace();
    $klic =  $validuj->validujRegistraci();

    if ($klic == 'ok') {

      if ($_POST['go'] == 'registr') {

        echo 'zapis uzivatele do databaze z registracniho formulař';
        $uzivatel = new Uzivatel('0', '', '0');
        $uzivatel->pridejNovehoUzivatele();
        $smer = new Presmeruj();
        $smer->presmerovaniNaStranku('administrace');
      }
    }
  }


  if (overPrihlaseni() == FALSE) {
    $formular = new Form('', 'post', '');
    $formular->form();

    /* === label - type - name - hodnota === */
    $formular->Input_pole('*Vaše Jméno', 'text', 'jmeno', '');
    $formular->Input_pole('*Vaše Přijmení', 'text', 'prijmeni', '');
    $formular->Input_pole('*Datum narozeni', 'text', 'datum_narozeni', '');
    $formular->Input_pole('*Email', 'text', 'email', '');
    $formular->Input_pole('*Mobil ve formátu +420 111 222 333', 'text', 'telefon', '');
    $formular->Input_pole('*Ulice', 'text', 'ulice', '');
    $formular->Input_pole('*Město', 'text', 'mesto', '');
    $formular->Input_pole('*Psč', 'text', 'psc', '');
    $formular->Input_pole('*heslo', 'text', 'heslo', '');
    $formular->Input_pole('*znovu heslo', 'text', 'heslo2', '');

    $formular->Input_pole('', 'hidden', 'go', 'registr');


    // funkce na ochranu proti spamu
    $spamOchrana = new CaptchaRok();
    $spamOchrana->vypis();

    $formular->button('registrace', 'Registrovat se');
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==105=================== */
/* ==stranka=administrace*/
function WidgetUzivatelUcetUvod()
{
  if (isset($_SESSION['uzivatel_jmeno'])) {
    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $statusUzivatele = ($_SESSION['uzivatel_admin']);
    $identUzivatele = ($_SESSION['uzivatel_id']);


    echo '<header class="mb-4">';
    echo '<h1 class="fw-bolder mb-1">Administrace účtu</h1>';
    echo '</header>';
    echo '<section class="mb-5">';
    echo '<div class=" col-sm-12">';

    if (isset($_SESSION['uzivatel_jmeno'])) {

      /**
       * volani tridy 
       */

      $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
      $klient->ucetEdit();
      $klient->vypisKontraktu();

      $klient = new Produkt($statusUzivatele);
      $klient->pridejKontrakt();
    }
    echo '</div></section>';
  } else {
    header('Location: index.php');
    exit;
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==106=================== */
/* ==stranka=editace*/
function WidgetUzivatelEditacniFormular()
{

  echo '<div class="alert alert-secondary col-sm-12">';
  if (isset($_SESSION['uzivatel_jmeno'])) {

    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $statusUzivatele =  ($_SESSION['uzivatel_admin']);
    $identUzivatele = ($_SESSION['uzivatel_id']);

    /**
     * volani tridy pro editaci uzivatelskych dat
     * data uzivatele v registrovanoho v databazi
     */
    $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
    $klient->ucetEditUloz();
  } else {
    /**
     * vypise informacni text 
     * ze je uzivatel neprihlaseny
     */
    $info = new InfoText();
    $info->neprihlaseny();
  }

  /**
   * prevezme data z formulare EDITACE UZIVATELA z validuje 
   * a pote zapise do databaze
   * nevalidni data nezapisuje - nespusti zápis
   */
  if (isset($_POST['odeslat'])) {

    //echo '  předáno ke zpracování';
    $valid = new Validace();
    $valid->validujRegistraci();
  }
  echo '</div>';
}

/* ======================================================== */
/* ======================================================== */
/* ==107=================== */
/* ==stranka=administraceproduktu*/
function WidgetAdminiProdukt()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {
    $statusUzivatele = ($_SESSION['uzivatel_admin']);

    if (trim($statusUzivatele) == Constanty::ADMINISTRATOR_WEBU) {
      echo '<header class="mb-4">';
      echo '<h1 class="fw-bolder mb-1">Administrace produktu</h1>';
      echo '</header>';
      echo '<section class="mb-5"><div class="col-sm-12">';

      if (isset($_SESSION['uzivatel_jmeno'])) {

        /**
         * volani tridy 
         */

        $pojistka = new Produkt($statusUzivatele);
        $pojistka->vypisProdukty();
      }
      echo '</div></section>';
    } else {
      header('Location: index.php');
      exit;
    }
  } else {
    header('Location: index.php');
    exit;
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==108=================== */
/* ==stranka=admnistraceproduktu*/
function WidgetAdminiProduktFormular()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {
    $statusUzivatele = ($_SESSION['uzivatel_admin']);

    if (trim($statusUzivatele) == Constanty::ADMINISTRATOR_WEBU) {
      echo '<header class="mb-4">';
      echo '<h1 class="fw-bolder mb-1">Editace produktu</h1>';
      echo '</header>';
      echo '<section class="mb-5">';
      echo '<div class="alert alert-secondary col-sm-12">';

      if (isset($_SESSION['uzivatel_jmeno'])) {

        /**
         * volani tridy 
         */

        $pojistka = new Produkt($statusUzivatele);
        $pojistka->formularProdukt();
      }


      echo '</div></section>';
    } else {
      header('Location: index.php');
      exit;
    }
  } else {
    header('Location: index.php');
    exit;
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==109=================== */
/* ==stranka=dministraceuzivatelu*/
function WidgetAdminUzivatele()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {
    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $statusUzivatele = ($_SESSION['uzivatel_admin']);
    $identUzivatele = ($_SESSION['uzivatel_id']);

    if (trim($statusUzivatele) == Constanty::ADMINISTRATOR_WEBU) {
      echo '<header class="mb-4">';
      echo '<h1 class="fw-bolder mb-1">Administrace uživatelů</h1>';
      echo '</header>';
      echo '<section class="mb-5">';
      echo '<div class="alert alert-secondary col-sm-12">';

      if (isset($_SESSION['uzivatel_jmeno'])) {

        /**
         * volani tridy 
         */
        if (isset($_POST['odstranit'])) {

          $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
          $klient->odstran($_POST['odstranit']);
        }

        $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
        $klient->odstranVybrane();

        $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
        $klient->ucetAdmin();
      }


      echo '</div></section>';
    } else {
      header('Location: index.php');
      exit;
    }
  } else {
    header('Location: index.php');
    exit;
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==110=================== */
/* ==stranka=produkty==*/
function WidgetNabidkaProduktu()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {

    $statusUzivatele = ($_SESSION['uzivatel_admin']);

    $pojistka = new Produkt($statusUzivatele);
  } else {
    $pojistka = new Produkt('' . Constanty::NEPRIHLASENY_UZIVATEL_WEBU . '');
  }

  $pojistka->nabidniProdukty();
}

/* ======================================================== */
/* ======================================================== */
/* ==111=================== */
/* ==stranka=produktyobj==*/
function WidgetObjednavkaProduktu()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {
    $statusUzivatele = ($_SESSION['uzivatel_admin']);

    if (isset($_SESSION['uzivatel_jmeno'])) {

      /* volani tridy */
      echo '<div class=" col-sm-12">';
      $pojistka = new Produkt($statusUzivatele);
      $pojistka->objednejKontrakt();
      echo '</div>';
    }
  } else {

    echo '<div class=" col-sm-12">';
    $pojistka = new Produkt('' . Constanty::NEPRIHLASENY_UZIVATEL_WEBU . '');
    $pojistka->objednejKontrakt();
    echo '<br><strong ">Pro objednání produktu musíte být přihlášený.</strong></div>';
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==112=================== */
/* ==stranka=produktyrekapitulce*/
function WidgetObjednavkaRekapitulace()
{
  if (isset($_SESSION['uzivatel_jmeno'])) {
    $statusUzivatele = ($_SESSION['uzivatel_admin']);

    $key = $_POST['pridej'] ?? 'Nelze načít data - neznámá chyba';
    echo  htmlspecialchars($key);
    echo '<br>';
    if (isset($_POST['pridej'])) {

      //echo $_POST['data'];

      $data = $_POST['data'];
      $parser = explode('-', $data);

      // Simulace vytvoření objednávky
      $objednavka = new Objednavka();
      $objednavka->nastavIdUzivatel($parser[0]);
      $objednavka->nastavIdProduktu($parser[1]);
      $objednavka->nastavNazev($parser[2]);
      $objednavka->nastavCastka($parser[3]);
      $objednavka->nastavPredmet($parser[4]);
      $objednavka->nastavOddata($parser[5]);
      $objednavka->nastavDodata($parser[6]);



      // Vytvoření brány a předání objednávky bráně
      $brana = new Brana();
      $brana->zpracuj($objednavka);

      $pojistka = new Produkt($statusUzivatele);
      $pojistka->pridejKontrakt();
    }
  } else {
    /**
     * vypise informacni text 
     * ze je uzivatel neprihlaseny
     */
    $info = new InfoText();
    $info->neprihlaseny();
  }
}

/* ======================================================== */
/* ======================================================== */
/* ==113=================== */
/* ==stranka=administracekontraktu*/
function WidgetAdminiKontrakt()
{

  if (isset($_SESSION['uzivatel_jmeno'])) {
    $statusUzivatele = ($_SESSION['uzivatel_admin']);
    $jmenoUzivatele =  ($_SESSION['uzivatel_jmeno']);
    $identUzivatele  = ($_SESSION['uzivatel_id']);

    if (trim($statusUzivatele) == Constanty::ADMINISTRATOR_WEBU) {
      echo '<header class="mb-4">';
      echo '<h1 class="fw-bolder mb-1">Administrace kontraktů</h1>';
      echo '</header>';
      echo '<section class="mb-5"><div class="col-sm-12">';

      if (isset($_SESSION['uzivatel_jmeno'])) {

        $klient = new Uzivatel($statusUzivatele, $jmenoUzivatele, $identUzivatele);
        /**
         * volani tridy 
         */
        if (isset($_POST['kontrakt_edit_id'])) {
          //echo 'test';
          $klient->editujKontrakt($_POST['kontrakt_edit_id']);
        }

        /**
         * volani tridy 
         */
        if (isset($_POST['kontrakt_delet_id'])) {
          $klient->odstranKontrakt($_POST['kontrakt_delet_id']);
        }

        /**
         * volani tridy 
         */
        if (isset($_POST['kontrakt_hledej_id'])) {
          if ((empty($_POST['kontrakt_hledej_id'])) or (is_numeric($_POST['kontrakt_hledej_id']) == FALSE)) {
            echo 'vložená hodnota musí být číslo';
          } else {
            $klient->hledejKontrakt($_POST['kontrakt_hledej_id']);
          }
        }


        /**
         * volani tridy 
         */
        $klient->vypisVsechnyKontrakty();





        //$pojistka = new Produkt($statusUzivatele);
        //$pojistka->vypisProdukty();
      }
      echo '</div></section>';
    } else {
      header('Location: index.php');
      exit;
    }
  } else {
    header('Location: index.php');
    exit;
  }
}

/* ======================================================== */
/* ======================================================== */
