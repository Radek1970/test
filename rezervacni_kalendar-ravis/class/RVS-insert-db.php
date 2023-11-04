<?php
class RVS_insert_db
{
    private $wpdb;
    public $jmeno;


    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
    }




                    
    
    
    
    public function zapisDoTabulky($vstup) {
        if($vstup === FALSE)
        { 
                    $jmeno = htmlspecialchars(trim($_POST['selected_name']));
                    $prijmeni = htmlspecialchars(trim($_POST['selected_name2']));
                    $email = htmlspecialchars(trim($_POST['selected_email']));
                    $telefon = htmlspecialchars(trim($_POST['selected_tel']));
                    $od_data = htmlspecialchars(trim($_POST['selected_date1']));
                    $do_data = htmlspecialchars(trim($_POST['selected_date2']));

                    $spz = htmlspecialchars(trim($_POST['spz']));
 
                    // vstupní datum naformátujeme pro DB
                    $od_data = date("Y-m-d", strtotime(str_replace('.', '-',  $od_data)));
             //echo $od_data; // Vypíše "2023-10-23"

                    $do_data = date("Y-m-d", strtotime(str_replace('.', '-',  $do_data)));
             //echo $do_data; // Vypíše "2023-10-23"
       
                 
                 global $wpdb; // Globální objekt WordPress databáze
 
                 /**==================
                  * ==================
                  * oveření zda data nejsou odesláná z formuláře duplicitně
                  */
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
                   $spz,
                   $odDatumu,
                   $doDatumu
                   );

                   $pocet_rezervaci = $wpdb->get_var($sql);



                 /**==============================
                  * ==============================
                  vypíše info oproduktu pro zápis do tabuky rezervace
                  */
                 // Zde nastavte název tabulky ve vaší databázi
                 $my_table_name = $wpdb->prefix . SQL_TABULKA_PRODUCT;

                 // Zde nastavte název sloupce, ve kterém chcete hledat
                 $column_name = 'spz';

                 // Zadejte hodnotu, kterou chcete prověřit
                 $zadana_hodnota = $spz;


                 // Sestavte dotaz pro ověření existence hodnoty
                 $sql = $wpdb->prepare("SELECT COUNT(*) FROM $my_table_name WHERE $column_name = %s", $zadana_hodnota);

                 // Spusťte dotaz
                 $result = $wpdb->get_var($sql);

                  if ($result == 1) {

                  $sql = $wpdb->prepare("SELECT * FROM $my_table_name WHERE $column_name = %s", $zadana_hodnota);
                  $vysledky = $wpdb->get_results($sql);

                    foreach ($vysledky as $radek) {
                    $nazev = htmlspecialchars($radek->nazev);
                    $id = htmlspecialchars($radek->id);
                    }
                  }
        
         // Název vaší tabulky v databázi WordPress
         $tabulka = $this->wpdb->prefix . 'rvs_rezervace';
    
         // Data pro vložení
         $data = array(
            'idspz' => $id,
            'rz' => $spz,
            'nazev' => $nazev,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'email' => $email,
            'telefon' => $telefon,
            'statut' => "0",
            'datum_od' => $od_data,
            'datum_do' =>  $do_data,
            'datum_zapisu' => date("Y-m-d") 
            
         ); 

         
        
        

         // Formát dat (specifikuje, jaká data mají být vložena)
         $format_dat = array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');
    
         // Vložení dat do databáze
         // ověření dat v DB kdyby se formulař znova odesla se stejnými daty
         if ($pocet_rezervaci > 0) {
         }
         else{
            // Žádné překrývající se rezervace neexistují, termín je dostupný
            $this->wpdb->insert($tabulka, $data, $format_dat);
          }


         // Zkontrolujte, zda došlo k chybě
          if ($this->wpdb->last_error) {
            return " chyba ";
            //return false; // Něco se nepovedlo
          } else {

            //vymaže formulář a naství na výchozí hodnoty
            $_POST['selected_name'] = '';
            $_POST['selected_name2'] = '';
            $_POST['selected_email'] = '';
            $_POST['selected_tel'] = '';
            $_POST['selected_date1'] = '';
            $_POST['selected_date2'] = '';
            
            return  "<h2>Rezervace byla odeslána, děkujeme </h2>";
            
            //return true; // Data byla úspěšně vložena
          }
    
     
          return "xxx test xxx";










            
        }
    }
}