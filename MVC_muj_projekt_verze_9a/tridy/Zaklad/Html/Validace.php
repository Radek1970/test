<?php

namespace Zaklad\Html;

use Db;
use presmeruj;
use CaptchaRok;

class Validace
{

	public $zprava = "";

	public function validujPrihlaseni()
	{
		if (isset($_POST)) {


			$string = $_POST['jmeno'];
			$pos = stripos($string, "@");

			if ($pos !== false) {
				//echo "Znak '@' byl nalezen na pozici $pos.";
				$uzivatel = Db::queryOne('SELECT uzivatele_id, admin, heslo, email FROM uzivatele WHERE email=?', $_POST['jmeno']);

			} else {
				//echo "Znak '@' nebyl nalezen v řetězci.";
				$uzivatel = Db::queryOne('SELECT uzivatele_id, admin, heslo, email FROM uzivatele WHERE jmeno=?', $_POST['jmeno']);
			}

			// databazovy dotaz

			// pokud neexistuje uživatel v databázi nebo se zadané heslo neshoduje s heslem v databázi
			//function password_verify (string $password, string $hash) : boolean


			/*
                  $hash = $uzivatel['heslo'];
                  $inputPassword = $_POST['heslo'] ;
                  echo password_verify($inputPassword, $hash) ? 'Heslo ověřeno' : 'Špatné heslo';
                 */

			if (!$uzivatel || !password_verify($_POST['heslo'], $uzivatel['heslo'])) {
				//if (!$uzivatel || !$_POST['heslo']) {
				$zprava = 'Uživatelské jméno nebo heslo je neplatné.';
				echo ('<div class="alert alert-danger"><strong>Pozor!</strong><br>' . $zprava . '.</div>');
			} else {     // v pripade ze je uzivatel uspesne overen zapiseme
				$_SESSION['uzivatel_id'] = $uzivatel['uzivatele_id'];
				$_SESSION['uzivatel_jmeno'] = $_POST['jmeno'];
				$_SESSION['uzivatel_admin'] = $uzivatel['admin'];
				/**
				 * zavolame funkci presmerovaniNaStranku () 
				 * pro presmerovani na pozadovanou stranku ve tride Presmeruj
				 */
				$smer = new Presmeruj();
				$smer->presmerovaniNaStranku('administrace');
				//header('Location: index.php');
				//exit();
			}
		}
	}

	/* ================================================================ */


	public function validujRegistraci()
	{
		//echo('Ahoj, já jsem test');

		/* === jmeno === */

		$zprava = '';
		if (trim($_POST['jmeno']) == '') {

			$zprava .= "jméno musí být vyplněn <br>";
		} else if (is_numeric($_POST['jmeno'])) {

			$zprava .= "jméno nesmí být číslice<br>";
		} else if (preg_match("/[0-9]+/", $_POST['jmeno'])) {

			$zprava .= "jméno nemůže obsahovat číslice<br>";
		}

		/* === prijmeni=== */
		if (trim($_POST['prijmeni']) == '') {

			$zprava .= "přijmení musí být vyplněno<br>";
		} else if (is_numeric($_POST['prijmeni'])) {

			$zprava .= "přijmení nesmí být číslice<br>";
		} else if (preg_match("/[0-9]+/", $_POST['prijmeni'])) {

			$zprava .= "přijmení nemůže obsahovat číslice<br>";
		}


		/* === datum nar.=== */
		$date = (trim($_POST['datum_narozeni']));

		// Vytvořte pole možných formátů, které chceme podporovat
		$date_formats = array("j.n.Y", "d.n.Y");
		$valid_date1 = false;
		$valid_date2 = false;

		$date1 = $date;
		$date2 = $date;


		//$date = "1970.9.10";
		$pattern = "/^\d{4}\.\d{1,2}\.\d{1,2}$/";
		//$date = "12asAD";
		$pattern2 = "/[a-zA-Z]/";



		foreach ($date_formats as $format) {
			if (strtotime($date1) !== false) {
				$valid_date1 = true;
				break;
			}
		}

		foreach ($date_formats as $format) {
			if (strtotime($date2) !== false) {
				$valid_date2 = true;
				break;
			}
		}

		if ($date == '') {
			$zprava .= "datum narození není vyplněn<br>";
		}


		$hledejZnak = "-";
		if (strpos($date, $hledejZnak) !== false) {
			$zprava .=  "zadané datum ($date)  není ve formátu dd.mm.rrrr.<br>";
		}
		if (($valid_date1 != true) || ($valid_date2 != true) || (preg_match($pattern2, $date))) {
			$zprava .=  "zadané datum ($date)  xnení ve formátu dd.mm.rrrr.<br>";
		} else if (preg_match($pattern, $date)) {
			$zprava .=   "zadané datum ($date)  není ve formátu dd.mm.rrrr.<br>";
		}






		/* === email === */


		if (trim($_POST['email']) == '') {
			$zprava .= "email musí být vyplněn<br>";
		} else if (preg_match('/[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9._-]+\.[a-zA-z]{2,4}$/', $_POST['email'])) {
		} else {
			$zprava .= "email není ve správném formátu<br>";
		}


		if ($_POST['go'] == 'edit') {
			$exist = Db::queryOne('
			        SELECT *
			        FROM uzivatele
			        WHERE email=? AND uzivatele_id=?
			        ', $_POST['email'], $_POST['uzivatele_id']);

			if ($exist) {
				// "ok <br>";
			} else {
				$exist = Db::queryOne('
			            SELECT *
			            FROM uzivatele
			            WHERE email=?
			            ', $_POST['email']);

				if ($exist) {
					$zprava .= "email již existuje<br>";
				}
			}
		} else {
			$exist = Db::queryOne('
			     SELECT *
			     FROM uzivatele
			     WHERE email=?
			    ', $_POST['email']);

			if ($exist) {
				$zprava .= "email již existuje<br>";
			}
		}

		/* === telefon === */

		//"+421 558 774 995" odstrani mezery;
		$tel = str_replace(' ', '', $_POST['telefon']);

		if (trim($tel) == '') {

			$zprava .= "telefon musí být vyplněn<br>";
		} else if (preg_match('/^[+|00][0-9]{11,12}/i', $tel) == false) {
			$zprava .= "telefon musí ve formátu +xxx xxx xxx xxx<br>";
		}
		/* === ulice === */


		if (trim($_POST['ulice']) == '') {

			$zprava .= "ulice, musí být vyplněno<br>";
		}

		/* === mesto === */


		if (trim($_POST['mesto']) == '') {

			$zprava .= "město,  musí být vyplněno<br>";
		}

		/* === psc=== */

		if (trim($_POST['psc']) == '') {

			$zprava .= "psč, musí být vyplněno<br>";
		} else if (is_numeric($_POST['psc']) == FALSE) {

			$zprava .= "psč nemůže obsahovat písmena<br>";
		}

		/* === heslo=== */

		if (trim($_POST['heslo']) == '') {

			$zprava .= "heslo musí být vyplněno<br>";
		} else if (mb_strlen($_POST['heslo']) <= 5) {

			$zprava .= "heslo musí mít minimálně 6 znaků<br>";
		}

		/* === heslo 2 === */
		if (trim($_POST['heslo2']) == '') {

			$zprava .= "heslo2 musí být vyplněno<br>";
		} else if (($_POST['heslo2']) != $_POST['heslo']) {

			$zprava .= "Hesla nesouhlasí<br>";
		}
		/* === antispam === */
		/*
				if(trim($_POST['rok']) == ''){

					$zprava .= "antispam musí být vyplněn<br>";
					
				}
			
				else if ($_POST['rok'] != date('Y')){ 
					$zprava .= 'Chybně vyplněný antispam.<br>';
					
				}
            */


		/**
		 * kontrola antispam
		 * ochrana
		 * proti spamu
		 */
		$spamOchrana = new CaptchaRok();
		$hlaska = $spamOchrana->over();

		if (!empty($hlaska)) {
			$zprava .= '' . $hlaska;
		}




		/* ============== */


		if (empty($zprava)) {

			$value = 'ok';
			return $value;
		} else {

			echo ('<br><div class="alert alert-danger"><strong>Pozor!</strong><br>' . $zprava . '.</div>');
			//echo 'nevalidni';

		}
	}



	/* ================================================================ */


	public function validujObjednavku()
	{

		//echo('Ahoj, já jsem test');


		$zprava = '';
		/* === castka== */

		if (trim($_POST['castka']) == '') {

			$zprava .= "částka musí být vyplněna<br>";
		} else if (is_numeric($_POST['castka']) == FALSE) {

			$zprava .= "částka musí být číslice<br>";
		} else if ($_POST['castka'] < 100 || $_POST['castka'] > 100000) {

			$zprava .= "částka musí mezi 100 - 100 000<br>";
		}

		/* === predmet== */

		if (trim($_POST['predmet']) == '') {

			$zprava .= "předmět musí být vyplněn<br>";
		} else if (mb_strlen($_POST['predmet']) > 31) {

			$zprava .= "předmět můžemít max. 30 znaků<br>";
		}

		/* === od data== */

		if (trim($_POST['oddata']) == '') {

			$zprava .= "datum (od) musí být vyplněn<br>";
		} else if (strtotime($_POST['oddata']) == FALSE) {

			$zprava .= "datum (od) musí být ve formátu d.m.r <br>";
		} else if ((strtotime("now -1 days")) > (strtotime($_POST['oddata']))) {

			$zprava .= "datum (od) je v minulosti!!!<br>";
		}

		/* === do data== */

		if (trim($_POST['dodata']) == '') {

			$zprava .= "datum (do) musí být vyplněn<br>";
		} else if (strtotime($_POST['dodata']) == FALSE) {

			$zprava .= "datum (do) musí být ve formátu d.m.r <br>";
		} else if ((strtotime($_POST['oddata']) - 1) >= (strtotime($_POST['dodata']))) {

			$zprava .= "datum (do) je v minulosti!!! <br>";
		}






		/* === antispam === */
		/*
			if(trim($_POST['rok']) == ''){

				$zprava .= "antispam musí být vyplněn<br>";
				
			}
		
			else if ($_POST['rok'] != date('Y')){ 
				$zprava .= 'Chybně vyplněný antispam.<br>';
				
			}
		*/


		/**
		 * kontrola antispam
		 * ochrana
		 * proti spamu
		 */
		/*
			$spamOchrana = new CaptchaRok();
			$hlaska = $spamOchrana->over();
			 
			if(!empty($hlaska)){
			$zprava .= ''.$hlaska;	
			}
			*/



		/* ============== */


		if (empty($zprava)) {

			$value = 'ok';
			return $value;
		} else {

			echo ('<br><div class="alert alert-danger"><strong>Pozor!</strong><br>' . $zprava . '</div>');
			//echo 'nevalidni';

		}
	}
}
