<?php
class RVS_kalendar_formular
{
  public function legenda()
  {
    // Zde můžete zobrazit obsah pro uživatele
    $html = '';
    $html .= '<p class="rvs">legenda: <span style="' . BARVA_NEDOSTUPNE . '; padding:5px">nedostupné</span> | ';
    $html .= '<span style="' . BARVA_REZERVACE . '; padding:5px">rezervováno</span> | ';
    $html .= '<span style="' . BARVA_POPTAVKY . '; padding:5px">poptávka</span>. | ';
    $html .= '<span style="' . BARVA_DNES . '; padding:5px">aktuální den</span>.</p>';

    return $html;
  }


  public function spoctiDny()
  {
    $_POST['selected_date1'];
    $_POST['selected_date2'];

    $od_data = $_POST['selected_date1']; // Vložte datum počátku
    $do_data = $_POST['selected_date2']; // Vložte datum konce

    // Převede data na časové značky
    $cas_od_data = strtotime($od_data);
    $cas_do_data = strtotime($do_data);

    // Spočítá rozdíl v čase v sekundách
    $rozdil_v_sekundach = $cas_do_data - $cas_od_data;

    // Převede rozdíl na počet dnů
    $rozdil_v_dnech = floor($rozdil_v_sekundach / (60 * 60 * 24));

    return  $rozdil_v_dnech+1;
  }

 
  public function stavProduktu($cisloRz)
  {
      global $wpdb;
      // Zde nastavte název tabulky ve vaší databázi
      $nazevTabulky  = $wpdb->prefix . SQL_TABULKA_PRODUCT;

      $nazevSloupce = 'spz';
      $sql = $wpdb->prepare("SELECT * FROM $nazevTabulky WHERE $nazevSloupce = %s", $cisloRz);
      $vysledky = $wpdb->get_results($sql);

      // Zpracujte další data
      foreach ($vysledky as $radek) {
        return $radek->stav;
      }
  }


  public function vypisformular($odemkni, $cisloRz)
  {
   
    $html  = '';
    $stav = $this->stavProduktu($cisloRz);

    if (  $stav != NULL){
      $html  .= '<h3>'.$stav.'</h3>';
    }
    else{
  
    // id demo3 se načítá z Javascriptu 
    $html  .= '<p id="demo3"></p><form method="POST" class="border border-primary p-3 ">';


    $html .= '<div class="row">';
    $html .= '<div class="col-3"><p>Do data: <span id="pole1" onmouseout="myFunctionCloseWindow(1)"></span><br><input class="input-group border border-primary" type="text" id="selectedDate1" name="selected_date1"';
    $html .= ' value="';
    $html .= (isset($_POST['selected_date1'])) ? $_POST['selected_date1'] : '';
    $html .= ' " ';
    $html .= 'readonly onclick="myFunctionOpenWindow(1)"></p></div>';
 
    $html .= '<div class="col-3"><p>Do data: <span id="pole2" onmouseout="myFunctionCloseWindow(2)"></span><br><input class="input-group border border-primary" type="text" id="selectedDate2" name="selected_date2"';
    $html .= ' value="';
    $html .= (isset($_POST['selected_date2'])) ? $_POST['selected_date2'] : '';
    $html .= ' " ';
    $html .= 'readonly onclick="myFunctionOpenWindow(2)"></p></div>';

 
    if ($odemkni === FALSE) {

      if ( $_POST['selected_date1'] != ''){
      $html .= '<div class="col-12"><p>Termín je dostupný a může být rezervován. <br> Počet požadovaných dnů je: '. $this->spoctiDny() .'<br> Rezervace vozu s SPZ: ' . $cisloRz . '</p>';
      $html .= '<small>Vyplňte Vaše jméno, příjmení, telefon a email.</small>';
      $html .= '<input  type="hidden"  name="active" value="go" >';
      $html .= '<input  type="hidden"  name="spz" value="' . $cisloRz . '">';
      $html .= '<input  type="hidden"  name="odemkni" value="">';
      $html .= '</div>';
      
      //$html .= '<div class="row">'; 
      $html .= '<div class="col-6"><p>jméno:<br><input class="input-group border border-primary" type="text"  name="selected_name" ';
      $html .= ' value=" ';
      $html .= (isset($_POST['selected_name'])) ? $_POST['selected_name'] : '';
      $html .= ' " ';
      $html .= '</p></div>';
      
      $html .= '<div class="col-6"><p>přijmení:<br><input class="input-group border border-primary" type="text"  name="selected_name2" ';
      $html .= ' value=" ';
      $html .= (isset($_POST['selected_name2'])) ? $_POST['selected_name2'] : '';
      $html .= ' " ';
      $html .= '</p></div>';
      
      $html .= '<div class="col-6"><p>tel.:<br><input class="input-group border border-primary" type="text"  name="selected_tel" ';
      $html .= ' value=" ';
      $html .= (isset($_POST['selected_tel'])) ? $_POST['selected_tel'] : '';
      $html .= ' " ';
      $html .= '</p></div>';
      
      $html .= '<div class="col-6"><p>email:<br><input class="input-group border border-primary" type="text"  name="selected_email" ';
      $html .= ' value=" ';
      $html .= (isset($_POST['selected_email'])) ? $_POST['selected_email'] : '';
      $html .= ' " ';
      $html .= '</p></div>';

      $html .= '<div class="col-6">';
      $kontrola = new RVS_captcha_rok();
      $html .= $kontrola->vypis();
      $html .= '</div>';

      }
    }

    $html .= '</div>';

    $html .= '<button type="submit" class="btn btn-primary">Odeslat</button></form><br>';
  }

    return $html;
  }
}
