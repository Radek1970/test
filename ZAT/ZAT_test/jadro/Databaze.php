<?php

/**  
 * PDO funkce pro připojení k databázi chce jako parametr nastavení. Jedná
 * se o asociativní pole, kde používáme jako klíče konstanty z třídy PDO. 
 * způsob reakce na databázové chyby a inicializační příkaz
 * nastavíme tak, aby způsobovaly výjimky. Inicializační příkaz bude
 * SET NAMES utf8,  dále přidáme nastavení PDO::ATTR_EMULATE_PREPARES,
 * které přenechá vkládání parametrů do dotazu na databázi, je to tak
 * bezpečnější a kvalitnější. 
 * ================================================================================
 * V kontextu práce s databází pomocí rozhraní PDO (PHP Data Objects) existují některé další důležité metody pro získání výsledků dotazu. 
 * Tyto metody jsou poskytovány třídou PDOStatement, která reprezentuje připravený SQL dotaz. Zde jsou některé z těchto metod:
 * ================================================================================
 * fetch: Metoda fetch slouží k získání jednoho řádku z výsledků dotazu jako asociativní pole nebo jiný formát, podle specifikace.
 * $row = $statement->fetch(PDO::FETCH_ASSOC);
 * -----------------------------------------------------
 * fetchAll: Metoda fetchAll vrátí všechny řádky výsledků dotazu jako pole asociativních polí.
 * $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
 * fetchColumn: Metoda fetchColumn vrátí hodnotu jednoho sloupce z prvního řádku výsledků dotazu.
 * -----------------------------------------------------
 * $value = $statement->fetchColumn();
 * rowCount: Metoda rowCount vrátí počet ovlivněných řádků při provedení INSERT, UPDATE nebo DELETE dotazu.
 * -----------------------------------------------------
 * $rowCount = $statement->rowCount();
 * bindParam: Metoda bindParam slouží k vázání parametru dotazu na proměnnou, 
 * což umožňuje dynamickou změnu hodnoty parametru před každým provedením dotazu.
 * ----------------------------------------------------
 * $value = 42;
 * $statement->bindParam(':param', $value, PDO::PARAM_INT);
 * execute: Metoda execute provádí připravený dotaz s aktuálními hodnotami parametrů.
 * -----------------------------------------------------
 * $statement->execute();
 * errorInfo: Metoda errorInfo poskytuje informace o případných chybách při provádění dotazu.
 * -----------------------------------------------------
 * $errorInfo = $statement->errorInfo();
 * Tyto metody jsou běžně používané při práci s databází pomocí PDO v PHP. 
 * Je důležité si být vědom toho, že metody mohou být volány na instanci třídy PDOStatement, 
 * která vznikne při přípravě dotazu pomocí metody prepare na instanci třídy PDO.
 */

/**
 * Statický wrapper nad PDO instancí pro snadnější komunikaci s databází
 */
class Databaze
{


    /**
     * @var PDO Připojená instance PDO
     */
    private static PDO $spojeni;
    /**
     * @var array Nastavení PDO
     */
    private static array $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    /**
     * funkce pro test
     */
    public function pozdravDB(): void
    {
        echo "TESTOVÁNÍ PDO DB";
    }


    /**
     * Připojí se k databázi a spojení uloží do statické proměnné
     * @param string $host Hostitel
     * @param string $uzivatel Uživatelské jméno
     * @param string $heslo Heslo
     * @param string $databaze Název databáze
     * @return PDO Databázové spojení
     * define('DB_HOST','localhost');
     * define('DB_NAME','zat_db');  
     * define('DB_USERNAME','root');  
     * define('DB_PASSWORD','');
     */

    /* public static function pripoj(string $host, string $uzivatel, string $heslo, string $databaze): PDO
	{
		if (!isset(self::$spojeni)) {
		self::$spojeni = @new PDO("mysql:host=$host;dbname=$databaze", $uzivatel, $heslo, self::$nastaveni);
		}
		return self::$spojeni;
	} */
    public static function propoj()
    {
        if (!isset(self::$spojeni)) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '';
            $user = DB_USERNAME;
            $password = DB_PASSWORD;

            self::$spojeni = @new PDO($dsn, $user, $password, self::$nastaveni);
        }
    }
    //=======================================//

    //V kontextu PDO, metoda execute() slouží 
    //k provedení připraveného dotazu. PDO je rozhraní pro přístup 
    //k databázím v PHP
    // ... (předchozí metody)

    /**
     * Provede INSERT dotaz s danými parametry a vrátí objekt PDOStatement pro pozdější získání výsledků
     * @param string $sql_insert SQL dotaz pro INSERT
     * @param array $parametry_insert Parametry SQL dotazu
     * @return PDOStatement Dotaz s výsledky
     * ==================================================================
     * // formát dotazu
     * $sql = ' INSERT INTO uzivatele (jmeno, prijmeni) VALUES (?, ?)'; 
     * // pole parametru
     * $parametry = [trim($_POST['jmeno']),trim($_POST['prijmeni'])];
     * Db::query($sql, $parametry);
     */
    public static function vloz(string $sql_insert, array $parametry_insert = array()): PDOStatement
    {
        $dotaz = self::$spojeni->prepare($sql_insert);
        $dotaz->execute($parametry_insert);
        return $dotaz;
    }

    /**
     * Provede UPDATE dotaz s danými parametry a vrátí objekt PDOStatement pro pozdější získání výsledků
     * @param string $sql_update SQL dotaz pro UPDATE
     * @param array $parametry_update Parametry SQL dotazu
     * @return PDOStatement Dotaz s výsledky
     * ====================================================================
     * // formát dotazu
     * $sql_update = "UPDATE uzivatele SET jmeno = ?, prijmeni = ? WHERE id = ?";
     * // pole parametru
     * // ID uživatele, kterého aktualizujeme
     * $parametry_update = [trim($_POST['jmeno']),trim($_POST['prijmeni']),$id ];
     * Db::query($sql_update, $parametry_update);
     */
    public static function uprav(string $sql_update, array $parametry_update = array()): PDOStatement
    {
        $dotaz = self::$spojeni->prepare($sql_update);
        $dotaz->execute($parametry_update);
        return $dotaz;
    }

    /**
     * Provede DELETE dotaz s danými parametry a vrátí objekt PDOStatement pro pozdější získání výsledků
     * @param string $sql_delete SQL dotaz pro DELETE
     * @param array $parametry_delete Parametry SQL dotazu
     * @return PDOStatement Dotaz s výsledky
     * ===================================================================
     * // formát dotazu
     * $sql_delete = "DELETE FROM uzivatele WHERE id = ?";
     * // pole parametru
     * $parametry_delete = [$id]; // ID uživatele, kterého mazáme
     * Db::query($sql_delete, $parametry_delete);
     */
    public static function smaz(string $sql_delete, array $parametry_delete = array()): PDOStatement
    {
        $dotaz = self::$spojeni->prepare($sql_delete);
        $dotaz->execute($parametry_delete);
        return $dotaz;
    }

    /* ============================== */

    // ... (předchozí metody)

    /**
     * Vrátí všechny řádky z dané tabulky
     * @param string $tabulka Název tabulky
     * @return array Asociativní pole řádků
     * ===================================================================
     * // formát dotazu
     * $vsechnyUzivatele = Databaze::vsechnyRadky('uzivatele');
     */
    public static function vsechnyRadky($tabulka): array
    {
        $sql = "SELECT * FROM $tabulka";
        $dotaz = self::$spojeni->query($sql);
        // Získání výsledků ve formě asociativního pole
        /**
         * V kontextu PDO představuje PDO::FETCH_ASSOC režim získávání 
         * výsledků dotazu ve formě asociativního pole, 
         * kde názvy sloupců tabulky slouží jako klíče tohoto pole.
         */
        return $dotaz->fetchAll(PDO::FETCH_ASSOC);
    }


    // ...

    /**
     * Vrátí všechny řádky z dané tabulky pro vybrané sloupce
     * @param string $tabulka Název tabulky
     * @param array $sloupce Pole s názvy sloupců, které chceš získat
     * @return array Asociativní pole řádků
     * // format dotazu
     * // Vypiš například pouze první a třetí sloupec z tabulky 'uzivatele'
     * $vybraneSloupce = ['jmeno', 'email'];
     * $vsechnyUzivatele = Databaze::vsechnyRadkySParametry('uzivatele', $vybraneSloupce);
     */
    public static function vsechnyRadkySParametry($tabulka, $sloupce = array()): array
    {
        // Pokud není zadán seznam sloupců, získáme všechny sloupce
        $sloupceStr = empty($sloupce) ? '*' : implode(', ', $sloupce);

        $sql = "SELECT $sloupceStr FROM $tabulka";
        $dotaz = self::$spojeni->query($sql);
        return $dotaz->fetchAll(PDO::FETCH_ASSOC);
    }

    // ...

    // ...

    /**
     * Vrátí řádky z dané tabulky pro vybrané sloupce, kde hodnota začíná na zadaný prefix
     * @param string $tabulka Název tabulky
     * @param array $sloupce Pole s názvy sloupců, které chceš získat
     * @param string $prefix Prefix, kterým hodnota ve vybraném sloupci začíná
     * @return array Asociativní pole řádků
     * ================================================================
     * //format dotazu
     * // Vypiš pouze jména, kde jméno začíná na "R" z tabulky 'uzivatele'
     * $vybraneSloupce = ['jmeno', 'email'];
     * $prefixSloupce = 'jmeno';
     * $hodnotaPrefixu = 'R';
     * $uzivateleZR = Databaze::radkyPodlePrefixu('uzivatele', $vybraneSloupce, $prefixSloupce, $hodnotaPrefixu);
     */
    public static function radkyPodlePrefixu($tabulka, $sloupce = array(), $sloupecPrefix = '', $hodnotaPrefixu = ''): array
    {
        // Pokud není zadán seznam sloupců, získáme všechny sloupce
        $sloupceStr = empty($sloupce) ? '*' : implode(', ', $sloupce);

        $sql = "SELECT $sloupceStr FROM $tabulka WHERE $sloupecPrefix LIKE :prefix";
        $parametry = [':prefix' => "$hodnotaPrefixu%"];

        $dotaz = self::$spojeni->prepare($sql);
        $dotaz->execute($parametry);

        return $dotaz->fetchAll(PDO::FETCH_ASSOC);
    }

    // ...


    /**
     * Vrátí jeden řádek na základě specifikovaného podmíněného dotazu
     * @param string $tabulka Název tabulky
     * @param string $podminkovyDotaz Podmíněný dotaz
     * @param array $parametry Parametry dotazu
     * @return array|false Asociativní pole řádku nebo false, pokud není nalezen žádný záznam
     * ====================================================================
     * // pole parametru
     * $sql = "SELECT * FROM uzivatele WHERE jmeno = ? AND prijmeni = ?";
     * $parametry = [$_POST['jmeno'], $_POST['prijmeni']];
     * $vysledek = Databaze::dotaz($sql, $parametry);
     
     */
    public static function jedenRadek($tabulka, $podminkovyDotaz, $parametry = array())
    {
        $sql = "SELECT * FROM $tabulka WHERE $podminkovyDotaz";
        $dotaz = self::$spojeni->prepare($sql);
        $dotaz->execute($parametry);
        return $dotaz->fetch(PDO::FETCH_ASSOC) ?: false;
    }



    /**
     * Vrátí všechny řádky na základě specifikovaného podmíněného dotazu
     * @param string $tabulka Název tabulky
     * @param string $podminkovyDotaz Podmíněný dotaz
     * @param array $parametry Parametry dotazu
     * @return array|false Asociativní pole řádku nebo false, pokud není nalezen žádný záznam
     * ====================================================================
     * // pole parametru
     * $tabulka = 'nazevTabulky';  // Nahraďte skutečným názvem tabulky
     * $podminkovyDotaz = 'skupina = ?';
     * $parametry = ['CD'];
     * $zaznamy1 = Databaze::vsechnyRadkyKdeJe($tabulka, $podminkovyDotaz, $parametry);
     * $pocet_CD = count($zaznamy1);
     */
    public static function vsechnyRadkyKdeJe($tabulka, $podminkovyDotaz, $parametry = array())
    {
        $sql = "SELECT * FROM $tabulka WHERE $podminkovyDotaz";
        $dotaz = self::$spojeni->prepare($sql);
        $dotaz->execute($parametry);
        
         // Získání výsledků ve formě asociativního pole
        /**
         * V kontextu PDO představuje PDO::FETCH_ASSOC režim získávání 
         * výsledků dotazu ve formě asociativního pole, 
         * kde názvy sloupců tabulky slouží jako klíče tohoto pole.
         */
        return $dotaz->fetchAll(PDO::FETCH_ASSOC) ?: false;
    }




    /**
     * Vrátí všechny řádky z dané tabulky, které splňují zadané podmínky
     * @param string $tabulka Název tabulky
     * @param array $podminkovyDotaz Pole podmínkových dotazů pro WHERE klauzuli
     * @param array $parametry Pole s parametry pro dotaz (volitelné)
     * @return array|false Asociativní pole řádků nebo false, pokud nejsou žádné výsledky
     * =======================================================================
     * //pole parametru
     * $tabulka = 'nazevTabulky';  // Nahraďte skutečným názvem tabulky
     * $podminkovyDotaz = ['skupina = ?', 'datum = ?'];
     * $parametry = ['CD', '2023-01-01'];
     * $zaznamy = Databaze::vsechnyRadkyKdeJsou($tabulka, $podminkovyDotaz, $parametry);
     */
    public static function vsechnyRadkyKdeJsou($tabulka, $podminkovyDotaz, $parametry = array())
    {
        $wherePodminky = implode(' AND ', $podminkovyDotaz);
        $sql = "SELECT * FROM $tabulka WHERE $wherePodminky";

        $dotaz = self::$spojeni->prepare($sql);
        $dotaz->execute($parametry);

        return $dotaz->fetchAll(PDO::FETCH_ASSOC) ?: false;
    }

    /**
     * Vrátí počet záznamů v dané tabulce
     * @param string $tabulka Název tabulky
     * @return int Počet záznamů
     * ===================================================================
     * //format dotazu
     * $pocetProduktu = Databaze::pocetZaznamu('produkty');
     */
    public static function pocetZaznamu($tabulka): int
    {
        $sql = "SELECT COUNT(*) FROM $tabulka";
        $dotaz = self::$spojeni->query($sql);
        return $dotaz->fetchColumn();
    }
}
