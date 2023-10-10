<?php

namespace Zaklad\adminUzivatele;

use DateTime;
use Db;
use Constanty;
use Presmeruj;
use CaptchaRok;
use Exception;
use Zaklad\Html\Validace;
use Zaklad\Html\Form;
use Zaklad\Html\ListovaniEasy;


class Uzivatel
{


	//private string $uzivatelskaPozice;
	private $identifikace = '';
	private $prijmeni = '';
	private $datum_narozeni = '';
	private $email = '';
	private $telefon = '';
	private $ulece = '';
	private $mesto = '';
	private $psc = '';
	private $heslo = '';
	private $id = '';




	/**
	 * Konstruktor
	 * @param string $jmeno Jméno
	 * @param int $statut Statut
	 * @param int $identUzivatele identUzivatele
	 */

	public function __construct(public int $statut, public string $jmeno, public int $identUzivatele)
	{
		$this->statut = $statut;
		$this->jmeno = $jmeno;
		$this->identifikace = $identUzivatele;
		//echo $this->identifikace;
	}

	/* ============================================= */
	/* ================= 1  ======================== */
	/* ============================================= */

	/**
	 * test funkcnosti
	 * @return void
	 */
	public function pozdrav(): void
	{
		echo ('Hello world! test');
	}


	/* ============================================= */
	/* ================= 2  ======================== */
	/* ============================================= */

	/**
	 * funkcepro vypocet veku z data narozeni
	 * @return string
	 */

	public function vek($narozeni): string
	{


		$text = $narozeni;
		$rozdeleny_text = explode('.', $text); // Rozdělujeme text pomocí tecky
		//print_r($rozdeleny_text);

		$den = $rozdeleny_text[0];
		$mesic = $rozdeleny_text[1];
		$rok = $rozdeleny_text[2];
		/**
		 * čas nyni
		 * new DateTime();
		 */
		$nyni = new DateTime();
		$datumNarozeni = new DateTime($rok . '-' . $mesic . '-' . $den);
		$vek = $datumNarozeni->diff($nyni);
		return ($vek->y);
	}

	/* ============================================= */
	/* ================= 3  ======================== */
	/* ============================================= */

	/**
	 * zapise zvalidovane udaje noveho uzivatele do databaze
	 * @return void
	 */
	public function pridejNovehoUzivatele(): void
	{
		echo 'REGISTRACE do databaze';

		$datum = date("Y-m-d H:i:s", strtotime($_POST['datum_narozeni']));
		$heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);
		$casoveRazitko = date("Y_m_d_H_i_s");
		$cisloUctu = date("YmdHis") . '' . (rand(100, 999));


		Db::query('
			INSERT INTO uzivatele (jmeno, prijmeni,	datum_narozeni, email, telefon, ulice, mesto, psc, heslo, razitko, cislo_uctu)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		', trim($_POST['jmeno']), trim($_POST['prijmeni']), trim($datum), trim($_POST['email']), trim($_POST['telefon']), trim($_POST['ulice']), trim($_POST['mesto']), trim($_POST['psc']), trim($heslo), trim($casoveRazitko), trim($cisloUctu));


		$_SESSION['uzivatel_id'] = Db::getLastId();
		$_SESSION['uzivatel_jmeno'] = $_POST['jmeno'];
		$_SESSION['uzivatel_admin'] = 0;
	}

	/* ============================================= */
	/* ================= 4  ======================== */
	/* ============================================= */

	/**
	 * zapise zvalidovane udaje editovaneho uzivatele do databaze
	 * @return void
	 */

	public function pridejEditovanehoUzivatele(): void
	{


		$datum = date("Y-m-d H:i:s", strtotime($_POST['datum_narozeni']));

		$exist = Db::queryOne('
			        SELECT *
			        FROM uzivatele
			        WHERE heslo=? AND uzivatele_id=?
			        ', $_POST['heslo'], $_POST['uzivatele_id']);
		$uzivatele_id = $_POST['uzivatele_id'];


		if ($exist) {
			// neHASHuj kdyz je heslo nezmenene tak ho neprepisuj
			$heslo = $_POST['heslo'];
			//echo 'existuje';
		} else {
			// nove heslo zaHASHuj	
			$heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);
			//echo 'nexistuje';	
		}


		$casoveRazitko = 'EDIT' . date("Y_m_d_H_i_s");

		Db::query(
			'
					
					UPDATE uzivatele SET jmeno=?, prijmeni=?, datum_narozeni=?, email=?, telefon=?, ulice=?, mesto=?, psc=?, heslo=?, razitko=? WHERE uzivatele_id=?',
			trim($_POST['jmeno']),
			trim($_POST['prijmeni']),
			trim($datum),
			trim($_POST['email']),
			trim($_POST['telefon']),
			trim($_POST['ulice']),
			trim($_POST['mesto']),
			trim($_POST['psc']),
			trim($heslo),
			trim($casoveRazitko),
			trim($_POST['uzivatele_id']),
		);
	}


	/* ============================================= */
	/* ================= 5  ======================== */
	/* ============================================= */

	/**
	 * info panel vypsany po prihlaseni
	 * @return void
	 */

	public function infoPanel(): void
	{
		// Constanty::ADMINISTRATOR_WEBU vlozeni constanty 
		if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {

			echo (' <strong>jste přihlášen jako: </strong> ' . Constanty::POZICE_1 . ' |  ' . $this->jmeno . '<br><br> ');
			echo ('	<div class="alert alert-secondary col-sm-12">');
			echo '<strong>Admin panel:</strong>
		 <p><a  class="btn btn-primary" role="button" href="index.php?stranka=administraceproduktu">Administrace produktu</a></p>
		 <p><a  class="btn btn-primary" role="button" href="index.php?stranka=administraceuzivatelu">Administrace uživatelů</a></p>
		 <p><a  class="btn btn-primary" role="button" href="index.php?stranka=administracekontraktu">Administrace kontraktů</a></p>';
			echo ('</div>');


			$formular = new Form('index.php?stranka=administracekontraktu', 'post', '');
			$formular->form();
	
			echo '<div class="row alert alert-primary">';
			//echo '<div class=" col-12 "> hledat ID </div>';
			echo '<div class=" col-12 ">';
			$formular->Input_pole('', 'text', 'kontrakt_hledej_id', '');
			echo '</div>';
			echo '<div class=" col-12 ">';
			$formular->button('hledej', 'hledat kontrakt k editaci podle ID');
			echo '</div>';
			echo '</div>';




		}
		// Constanty::UZIVATEL_WEBU -- vlozeni constanty
		else if ($this->statut == Constanty::UZIVATEL_WEBU) {

			echo (' <strong>jste přihlášen jako: </strong> ' . Constanty::POZICE_0 . ' |  ' . $this->jmeno . ' ');
		}
		echo ' <br/><br/><a  class="btn btn-primary" role="button" href="index.php?odhlasit">Odhlásit</a> 
        <a  class="btn btn-primary" role="button" href="index.php?stranka=administrace">Administrace - detail účtu</a>';
	}

	/* ============================================= */
	/* ================= 6  ======================== */
	/* ============================================= */

	/**
	 * info panel vypsany po prihlaseni informujici o 
	 * zakldnich udajich registrovaneho v databazi
	 * @return void
	 */

	public function ucet(): void
	{

		$uzivatel = Db::queryOne('
                SELECT *
                FROM uzivatele
                WHERE uzivatele_id=?
                ', $this->identifikace);
		echo ('<h4>Vaše kontaktní údaje</h4>');

		echo ('<p> Jméno: <strong>' . htmlspecialchars($uzivatel['jmeno']) . '</strong></p>');
		echo ('<p> Přijmení: <strong>' . htmlspecialchars($uzivatel['prijmeni']) . '</strong></p>');

		$datum = date("d.m.Y", strtotime($uzivatel['datum_narozeni']));
		echo ('<p> datum narození: <strong>' . htmlspecialchars($datum) . '</strong></p>');

		echo ('<p> email: <strong>' . htmlspecialchars($uzivatel['email']) . '</strong></p>');
	}

	/* ============================================= */
	/* ================= 7  ======================== */
	/* ============================================= */

	/**
	 * info vypsany po prihlaseni informujici uzivatele o jeho 
	 * uzavrenych kontraktech ulozenych v databazi
	 * @return void
	 */
	public function vypisKontraktu(): void
	{
		//echo $this->identifikace;

		if (isset($_POST['uzivatel_id'])) {
			$this->identifikace = ($_POST['uzivatel_id']);
		} else {
			$this->identifikace = $this->identifikace;
		}
		$kontrakty = Db::queryAll('SELECT * FROM kontrakt WHERE uzivatel_id=?', $this->identifikace);
		$pocet = count($kontrakty);
		//echo $pocet;



		if ($pocet == 0) {
			if (trim($this->statut) != Constanty::ADMINISTRATOR_WEBU) {
				echo 'tento účet nemá sjednanou žádnou pojistku ';
			}
		} else {
			if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {
				echo ('<h4>Sjednané pojištění uživatele</h4>');
			} else {
				echo ('<h4>Vaše sjednané pojištění</h4>');
			}

			$i = 1;
			foreach ($kontrakty as $kontrakt) {
				$form = '<div class="border-3 border-primary border-bottom">';
				$form .= '<br>' . $i . '.';

				$pojisteni = $kontrakt['produkt_id'];

				$produkt = Db::queryone('SELECT * FROM produkt WHERE pojistka_id=?', $pojisteni);

				$form .= ' <span class="alert alert-success "> číslo pojistné smlouvy: ' . $kontrakt['kontrakt_id'] . '/' . $kontrakt['uzivatel_id'] . '' . $kontrakt['produkt_id'] . '</span></p> ';
				$form .= '<br><p>Druh pojištění: <strong>' . ($produkt['druh_pojistky']) . '</strong></p>';

				$form .= '<p> název pojištění: <strong>' . ($kontrakt['produkt_nazev']) . '</strong>';
				$date = date_create('' . $kontrakt['datum'] . '');
				$form .= ' vytvořeno: <strong>' . date_format($date, 'd.m.Y') . '</strong>';
				$form .= '<br>předmět: <strong>' . ($kontrakt['predmet']) . '</strong>';
				$form .= ' částka: <strong>' . ($kontrakt['castka']) . '</strong>';

				$form .= '<br>pojištění platné <u>od: <strong>' . ($kontrakt['oddata']) . '</strong>';
				$form .= ' do: <strong>' . ($kontrakt['dodata']) . '</u></strong>';
				$form .= '<br>popis pojištění: <i>' . ($produkt['popis']) . '</i></div>';
				echo $form;
				$i++;
			}
		}
	}

	/* ============================================= */
	/* ================= 8  ======================== */
	/* ============================================= */

	/**
	 * editace uzivatele zapsaneho v databazi
	 * uzivatel edituje jen svuj ucet
	 * administrator edituje svuj ucet a ucty vsech registrovanych
	 * vypise uzivatele z databaze
	 * vygeneruje formular pro odeslani ID uzivatele který bude editovan
	 * @return void
	 */
	public function ucetEdit(): void
	{

		if ((isset($_POST['uzivatel_id'])) or (isset($_GET['uzivatele_id']))) {

			if (isset($_POST['uzivatel_id'])) {
				$this->identifikace = ($_POST['uzivatel_id']);
			} else {
				$this->identifikace = ($_GET['uzivatele_id']);
			}
		}
		$uzivatel = Db::queryOne('SELECT * FROM uzivatele WHERE uzivatele_id=?', $this->identifikace);
		/**
		 * detail vypisu dat uzivatele
		 */
		$vypis = '';
		if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {
			if ($this->identifikace == ($_SESSION['uzivatel_id'])) {
				$vypis .= '<h4>Data přihlášeného administrátora </h4>';
			} else {
				$vypis .= '<h4>Data registrovaného uživatele vybraná administrátorem </h4>';
			}
		}
		$vypis .= '<div class="alert alert-success row"><div class=" col-6">';

		if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {
			$vypis .= 'identifikátor: ' . $this->identifikace . '';
		}

		$vypis .= '<p>';
		$vypis .= 'Jméno: <strong>' . htmlspecialchars($uzivatel['jmeno']) . '</strong>';
		$vypis .= '<br/>';
		$vypis .= 'Přijmení: <strong>' . htmlspecialchars($uzivatel['prijmeni']) . '</strong>';
		$vypis .= '<br/>';

		$datum = date("d.m.Y", strtotime($uzivatel['datum_narozeni']));
		$vypis .= 'datum narození: <strong>' . htmlspecialchars($datum) . '</strong>';
		$vypis .= '<br> věk: <strong>' . $this->vek($datum) . '</strong>';

		$vypis .= '<br> číslo Vašeho účtu: <strong>' . htmlspecialchars($uzivatel['cislo_uctu']) . '</strong>';

		$vypis .= '</p>';
		if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {
			$vypis .= '<p>';
			$vypis .= 'statut: <strong>' . htmlspecialchars($uzivatel['admin']) . '</strong>';
			$vypis .= '<br/>';
			$vypis .= 'časové razítko: <strong>' . htmlspecialchars($uzivatel['razitko']) . '</strong>';
			$vypis .= '</p>';
		}
		$vypis .= '</div>';

		$vypis .= '';
		$vypis .= '<div class=" col-6"><p> email: <strong>' . htmlspecialchars($uzivatel['email']) . '</strong>';
		$vypis .= '<br/>';
		$vypis .= 'telefon: <strong>' . htmlspecialchars($uzivatel['telefon']) . '</strong>';
		$vypis .= '<br/>';
		$vypis .= 'ulice: <strong>' . htmlspecialchars($uzivatel['ulice']) . '</strong>';
		$vypis .= '<br/>';
		$vypis .= 'město: <strong>' . htmlspecialchars($uzivatel['mesto']) . '</strong>';
		$vypis .= '<br/>';
		$vypis .= 'psč: <strong>' . htmlspecialchars($uzivatel['psc']) . '</strong></p>';
		$vypis .= '</div>';

		echo $vypis;

		$form = '<div class=" col-4"><form method="post"  action="index.php?stranka=editace">';
		$form .= '<input type="hidden" name="uzivatel_ident" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '" />';
		$form .= '<input  class="btn btn-primary" type="submit" value="otevřít editaci" />';
		$form .= '</form></div></div>';
		echo $form;
	}

	/* ============================================= */
	/* ================= 9  ======================== */
	/* ============================================= */

	/**
	 * editace uzivatele zapsaneho v databazi
	 * uzivatel edituje jen svuj ucet
	 * administrator edituje svuj ucet a ucty vsech registrovanych
	 * podle ID odeslaneho z formulare vypise do editacniho formulare
	 * udaje uzivatele pro editaci
	 * @return void
	 */
	public function ucetEditUloz(): void
	{

		/**
		 * $_POST['uzivatel_ident'] z odeslaneho formulare
		 */
		if (isset($_POST['uzivatel_ident'])) {

			$uzivatel_ident = $_POST['uzivatel_ident'];
			//tet	
			//echo $uzivatel_ident;
			$uzivatel = Db::queryOne('
			     SELECT * 
			     FROM uzivatele
			     WHERE uzivatele_id=?
			    ', $uzivatel_ident);




			$this->jmeno = htmlspecialchars($uzivatel['jmeno']);
			$this->prijmeni = htmlspecialchars($uzivatel['prijmeni']);
			$this->datum_narozeni = htmlspecialchars($uzivatel['datum_narozeni']);
			$this->email = htmlspecialchars($uzivatel['email']);
			$this->telefon = htmlspecialchars($uzivatel['telefon']);
			$this->ulece = htmlspecialchars($uzivatel['ulice']);
			$this->mesto = htmlspecialchars($uzivatel['mesto']);
			$this->psc = htmlspecialchars($uzivatel['psc']);
			$this->heslo = htmlspecialchars($uzivatel['heslo']);
			$this->id = htmlspecialchars($uzivatel['uzivatele_id']);
		} else {
			$this->jmeno = htmlspecialchars($_POST['jmeno']);
			$this->prijmeni = htmlspecialchars($_POST['prijmeni']);
			$this->datum_narozeni = htmlspecialchars($_POST['datum_narozeni']);
			$this->email = htmlspecialchars($_POST['email']);
			$this->telefon = htmlspecialchars($_POST['telefon']);
			$this->ulece = htmlspecialchars($_POST['ulice']);
			$this->mesto = htmlspecialchars($_POST['mesto']);
			$this->psc = htmlspecialchars($_POST['psc']);
			$this->heslo = htmlspecialchars($_POST['heslo']);
			$this->id = htmlspecialchars($_POST['uzivatele_id']);
		}
		if (isset($_POST['editace'])) {
			$validuj = new Validace();
			$klic =  $validuj->validujRegistraci();


			if ($klic == 'ok') {

				if ($_POST['go'] == 'edit') {
					//echo 'zapis utivatele do databaze z editacniho formulaře';
					$this->pridejEditovanehoUzivatele();
					$smer = new Presmeruj();
					$smer->presmerovaniNaStranku('administrace&uzivatele_id='.$this->id .'');
					
				}
			}
		}




		$formular = new Form('', 'post', '');
		$formular->form();

		/* === label - type - name - hodnota === */

		$formular->Input_pole('*Vaše Jméno', 'text', 'jmeno', '' . $this->jmeno . '');
		$formular->Input_pole('*Vaše Přijmení', 'text', 'prijmeni', '' . $this->prijmeni . '');
		$formular->Input_pole('*Datum narozeni', 'text', 'datum_narozeni', '' . $this->datum_narozeni . '');
		$formular->Input_pole('*Email', 'text', 'email', '' . $this->email . '');
		$formular->Input_pole('*Mobil ve formátu +420 111 222 333', 'text', 'telefon', '' . $this->telefon . '');
		$formular->Input_pole('*Ulice', 'text', 'ulice', '' . $this->ulece . '');
		$formular->Input_pole('*Město', 'text', 'mesto', '' . $this->mesto . '');
		$formular->Input_pole('*Psč', 'text', 'psc', '' . $this->psc . '');
		$formular->Input_pole('*heslo', 'password', 'heslo', '' . $this->heslo . '');
		$formular->Input_pole('*znovu heslo', 'password', 'heslo2', '' . $this->heslo . '');
		//$formular->Input_pole( '*Zadejte aktuální rok (antispam)','text','rok','');



		// funkce na ochranu proti spamu
		$spamOchrana = new CaptchaRok();
		$spamOchrana->vypis();

		$formular->Input_pole('', 'hidden', 'uzivatele_id', '' . $this->id . '');
		$formular->Input_pole('', 'hidden', 'go', 'edit');

		$formular->button('editace', 'editovat');

		echo ('<a href="index.php?stranka=administrace&uzivatele_id='.$this->id.'">zpět na výpis účtu</a>');
	}


	/* ============================================= */
	/* ================= 10  ======================= */
	/* ============================================= */

	/**
	 * vypis evidovanych uzivatelu 
	 * z databaze
	 */


	public function ucetAdmin(): void
	{



		if ($this->statut == Constanty::ADMINISTRATOR_WEBU) {

			$test = ($_SERVER['REQUEST_URI']);
			//echo $test;

			// listovani v tabulce
			$pocet_x = Db::queryAll('SELECT * FROM uzivatele ');
			$pocet_zaznamu = COUNT($pocet_x);

			/* ================= */
			// listovani

			$strankovani = new ListovaniEasy();
			try {
				$posouvani = $strankovani->listuj('' . $pocet_zaznamu . '', '10');
			} catch (Exception $e) {
				$posouvani = $e->getMessage();
			}

			$uzivatele = Db::queryAll('SELECT * FROM uzivatele ORDER BY uzivatele_id LIMIT ? OFFSET ? ', $strankovani->vratKolikRadku(), $strankovani->vratOdRadku());

			$pocet = count($uzivatele);

			echo ('<h2>Uživatelé evidovaní v databázi</h2>');
			echo ('<strong>počet záznamů v databázi: ' . $strankovani->vratInfo() . '</strong>');

			//echo '<input type="checkbox" value="'.$row[0].'"  name="delkompl[]" /> ';
			echo '<div class=" col-8">' . $posouvani . '</div>';

			/* ================= */



			
			$i = 1;
			echo '<form method="post" onsubmit="return dotazPredOdeslanim(this);">';
			foreach ($uzivatele as $uzivatel) {
				$form = '<div><div class="alert alert-success row">';
				
				$form .= '<div class=" col-12 pb-2">';
				$form .= '<input type="checkbox"  name="delkompl[]" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '">';
				$form .= ' ' . $i . '.  ID' . htmlspecialchars($uzivatel['uzivatele_id']) . ' ';
				$form .= ' ' . htmlspecialchars($uzivatel['jmeno']) . ' ';
				$form .= ' ' . htmlspecialchars($uzivatel['prijmeni']) . ' ';
				$form .= ' | ' . htmlspecialchars($uzivatel['email']) . ' | ';
				$form .= '  ' . htmlspecialchars($uzivatel['razitko']) . '<br></div> ';
				
				//$form .= '<div class=" col-6">';
				
				
				$form .= '<div class=" col-3"><form method="post"  action="index.php?stranka=editace">';
				$form .= '<input type="hidden" name="uzivatel_ident" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '" />';
				$form .= '<input  class="btn btn-primary" type="submit" value="otevřít editaci" />';
				$form .= '</form></div>';
				
				$form .= '<div class=" col-3"><form method="post"  action="index.php?stranka=administrace">';
				$form .= '<input type="hidden" name="uzivatel_id" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '" />';
				$form .= '<input  class="btn btn-primary" type="submit" value="načíst detail uživatele" />';
				$form .= '</form></div>';

				$form .= '<div class=" col-6"><form method="post" onsubmit="return dotazPredOdeslanim(this);">';
				$form .= '<input type="hidden" name="uzivatel_id" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '" />';
				$form .= '<input type="hidden" name="odstranit" value="' . htmlspecialchars($uzivatel['uzivatele_id']) . '" />';
				$form .= '<input  class="btn btn-primary" type="submit" value="odstranit" />';
			    $form .= '</form></div>';
				
				
				
				$form .= '</div>';
				//$form .= '</div>';
				echo $form;
				
				$i++;
			}
			
			
			echo '<input class="btn btn-info" type="submit" value="odstranit vybrané"></form><br><br><br> ';
			echo '<div class=" col-8">' . $posouvani . '</div>';
		}
	}



	/* ============================================= */
	/* ================= 11  ======================= */
	/* ============================================= */

	/**
	 * odstrani uzivatele z databaze na zaklade ID
	 * a popripade odstrani kotrakty vazajici se k 
	 * uzivateli dle jeho ID
	 * @param int
	 * 
	 */
	public function odstran(int $uzivatelId): void
	{

		Db::query('DELETE FROM uzivatele WHERE uzivatele_id=?', $uzivatelId);

		$exist = Db::queryOne('SELECT * FROM kontrakt WHERE  uzivatel_id=?', $uzivatelId);
		if ($exist) {
			Db::query('DELETE FROM kontrakt WHERE uzivatel_id=?', $uzivatelId);

			$kontrakt = 'včetně kontraktu uživatele';
		} else {
			$kontrakt = ' - uživatel bez kontraktu';
		}

		echo '<div class="alert alert-warning row"> uživatel ID ' . $uzivatelId . ' byl vymazán z databáze  ' . $kontrakt . '</div>';
	}


	/* ================= 11.2  ======================= */
	/**
	 * odstrani hromadne vybrane uzivatele z databaze na zaklade ID
	 * a popripade odstrani kotrakty vazajici se k 
	 * uzivateli dle jeho ID
	 * 
	 * 
	 */
	public function odstranVybrane(): void
	{
		
		if (isset($_REQUEST['delkompl'])) {
			$id_uzivatele = $_REQUEST['delkompl'];
			//echo count ($id_vyrobku);
			//echo "<br/>";
			echo "<br/>";
			$pocet = count($id_uzivatele);
			echo $pocet;
			if ($pocet != 0) {
				// funkce while vypise prislusny pocet poli 
				$i = 0;
				while ($i < $pocet) {
					
					//echo "<p >záznam s id $id_uzivatele[$i] </p>";
					//echo "<br/>";
					// spojeni dotazu a cesty - vykonani prikazu
					
					$exist = Db::queryOne('SELECT * FROM uzivatele WHERE  uzivatele_id=?', $id_uzivatele[$i]);
					if ($exist) {
						Db::query('DELETE FROM uzivatele WHERE uzivatele_id=?', $id_uzivatele[$i]);
					}
					
					$exist2 = Db::queryOne('SELECT * FROM kontrakt WHERE  uzivatel_id=?', $id_uzivatele[$i]);
					if ($exist2) {
						Db::query('DELETE FROM kontrakt WHERE uzivatel_id=?', $id_uzivatele[$i]);
						
						$kontrakt = 'včetně kontraktu uživatele';
					} else {
						$kontrakt = ' - uživatel bez kontraktu';
					}
					
					echo '<div class="alert alert-warning row"> uživatel ID ' . $id_uzivatele[$i] . ' byl vymazán z databáze  ' . $kontrakt . '</div>'; 
					
					$i++;
				}
			}
			
		}

	}


	/* ============================================= */
	/* ================= 12  ======================== */
	/* ============================================= */

	/**
	 * info vypsany po prihlaseni informujici aministratora o 
	 * uzavrenych kontraktech ulozenych v databazi
	 * @return void
	 */
	public function vypisVsechnyKontrakty(): void
	{
		//echo $this->identifikace;

		/* if (isset($_POST['uzivatel_id'])) {
			$this->identifikace = ($_POST['uzivatel_id']);
		} else {
			$this->identifikace = $this->identifikace;
		} */
		$kontrakty = Db::queryAll('SELECT * FROM kontrakt');
		$pocet = count($kontrakty);
		//echo $pocet;

		$formular = new Form('', 'post', '');
		$formular->form();

		echo '<div class="row alert alert-primary">';
		//echo '<div class=" col-12 "> hledat ID </div>';
		echo '<div class=" col-3 ">';
		$formular->Input_pole('', 'text', 'kontrakt_hledej_id', '');
		echo '</div>';
		echo '<div class=" col-2 ">';
		$formular->button('hledej', 'hledat podle ID');
		echo '</div>';
		echo '</div>';


		if ($pocet == 0) {
			if (trim($this->statut) != Constanty::ADMINISTRATOR_WEBU) {
				echo 'v databázi nejsou žádné kontrakty ';
			}
		} else {
			echo ('<h4>Sjednané pojištění uživatelů | záznamů : ' . $pocet . ' </h4>');


			$i = 1;
			foreach ($kontrakty as $kontrakt) {
				$form = '<div class="border-3 border-primary border-bottom">';
				$form .= '<br><p>' . $i . '. - ';



				$uzivatel = Db::queryone('SELECT * FROM uzivatele WHERE uzivatele_id=?', $kontrakt['uzivatel_id']);
				$produkt = Db::queryone('SELECT * FROM produkt WHERE pojistka_id=?', $kontrakt['produkt_id']);

				$form .= 'ID:' . $kontrakt['kontrakt_id'] . ' <br><br><span class="alert alert-success "> číslo pojistné smlouvy: <strong>' . $kontrakt['kontrakt_id'] . '/' . $kontrakt['uzivatel_id'] . '' . $kontrakt['produkt_id'] . '</strong></span> ';
				$form .= '<span class="alert alert-success "> ';
				$form .= ' číslo účtu: <strong>' . ($uzivatel['cislo_uctu']) . '</strong>';
				$form .= ' - držitel ůčtu: <strong>' . ($uzivatel['jmeno']) . ' ' . ($uzivatel['prijmeni']) . '</strong>';
				$form .= '</span></p>';


				$form .= '<p>Druh pojištění: <strong>' . ($produkt['druh_pojistky']) . '</strong> ';
				$form .= ' název pojištění: <strong>' . ($kontrakt['produkt_nazev']) . '</strong></p>';


				$date = date_create('' . $kontrakt['datum'] . '');
				$form .= '<p>vytvořeno: <strong>' . date_format($date, 'd.m.Y') . '</strong>';


				$form .= '<br>předmět: <strong>' . ($kontrakt['predmet']) . '</strong>';
				$form .= ' částaka: <strong>' . ($kontrakt['castka']) . '</strong>';

				$form .= ' pojištění platné <u>od: <strong>' . ($kontrakt['oddata']) . '</strong>';
				$form .= ' do: <strong>' . ($kontrakt['dodata']) . '</u></strong></p>';
				$form .= '<div class="alert  row">';

				$form .= '<div class=" col-3"><form method="post"   onsubmit="return dotazPredOdeslanim(this);">';
				$form .= '<input type="hidden" name="kontrakt_delet_id" value="' . $kontrakt['kontrakt_id'] . '" />';
				$form .= '<input  class="btn btn-primary" type="submit" value="odstranit kontrakt" />';
				$form .= '</form></div>';
				$form .= '<div class=" col-3"><form method="post">';
				$form .= '<input type="hidden" name="kontrakt_edit_id" value="' . $kontrakt['kontrakt_id'] . '" />';
				$form .= '<input  class="btn btn-primary" type="submit" value="editovat kontrakt" />';
				$form .= '</form></div>';
				$form .= '</div>';
				$form .= '</div>';

				echo $form;
				$i++;
			}
		}
	}

	/* ============================================= */
	/* ================= 13  ======================= */
	/* ============================================= */

	/**
	 * odstrani kontrakt z databaze na zaklade ID
	 * 
	 * @param int
	 * 
	 */
	public function odstranKontrakt(int $kontraktId): void
	{


		$exist = Db::queryOne('SELECT * FROM kontrakt WHERE  kontrakt_id=?', $kontraktId);
		if ($exist) {
			Db::query('DELETE FROM kontrakt WHERE kontrakt_id=?', $kontraktId);

			echo '<div class="alert alert-warning row"> kontrakt č.' . $exist['kontrakt_id'] . '' . $exist['uzivatel_id'] . '' . $exist['produkt_id'] . ' s ID ' . $kontraktId . ' byl vymazán z databáze  </div>';
		}
	}

	/* ============================================= */
	/* ================= 14  ======================= */
	/* ============================================= */

	/**
	 * odstrani kontrakt z databaze na zaklade ID
	 * 
	 * @param int
	 * 
	 */
	public function editujKontrakt(int $kontraktId): void
	{
		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$stranka_url = (mb_substr((htmlspecialchars($url, ENT_QUOTES, 'UTF-8')), 0, 79));
		echo '<a href="' . $stranka_url . '">zavřít</a>';

		$exist = Db::queryOne('SELECT * FROM kontrakt WHERE  kontrakt_id=?', $kontraktId);
		if ($exist) {


			$osoba = Db::queryOne('SELECT * FROM uzivatele WHERE  uzivatele_id=?', $exist['uzivatel_id']);
			echo '<div class="row border border-primary p-5">';
			if (isset($_POST['validuj'])) {

				$validuj = new Validace();
				$klic =  $validuj->validujObjednavku();
				//echo $_POST['validuj'];
				//echo $klic;
				if ($klic == 'ok') {

					echo '<div class="alert alert-warning row"> kontrakt č.' . $exist['kontrakt_id'] . '' . $exist['uzivatel_id'] . '' . $exist['produkt_id'] . ' s ID ' . $kontraktId . ' - ' . $exist['produkt_nazev'] . '<br> |  uživatel : '. $osoba['jmeno'] .' '. $osoba['prijmeni'] .' datum narozeni'. $osoba['datum_narozeni'] .' byl editován |</div>';

					Db::query('UPDATE kontrakt SET oddata=?, dodata=?, castka=?, predmet=? WHERE  kontrakt_id=?', $_POST['oddata'], $_POST['dodata'], $_POST['castka'], $_POST['predmet'], $kontraktId);
				}

				//echo $klic;
			} else {

				$kontrakt = array('castka' => $exist['castka'], 'predmet' => $exist['predmet'], 'oddata' => $exist['oddata'], 'dodata' => $exist['dodata']);
			}
			/* === label - type - name - hodnota === */

			if ($klic != 'ok') {
				$formular = new Form('', 'post', '');
				$formular->form();
				echo '<div class="alert alert-warning row"> editace kontraktu č.' . $exist['kontrakt_id'] . '' . $exist['uzivatel_id'] . '' . $exist['produkt_id'] . ' s ID ' . $kontraktId . ' - ' . $exist['produkt_nazev'] . '<br> |  uživatel : '. $osoba['jmeno'] .' '. $osoba['prijmeni'] .' datum narozeni '. $osoba['datum_narozeni'] .' |</div>';

				$formular->Input_pole('', 'hidden', 'kontrakt_edit_id', '' . $kontraktId . '');
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
			}
			echo '</div><br><br>';
		}
	}



	/* ============================================= */
	/* ================= 15  ======================= */
	/* ============================================= */

	/**
	 * vyhleda kontrakt pro editaci na zaklade ID
	 * 
	 * @param int
	 * 
	 */
	public function hledejKontrakt(int $kontraktId): void
	{
		$this->editujKontrakt($kontraktId);
	}


	/**
	 * test
	 * @return string statut
	 */
	public function __toString(): string
	{
		return $this->statut;
	}
}
