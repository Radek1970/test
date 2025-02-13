<?php

class RvsAdminContact
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function test()
    {
        return "test spojeni";
    }

    public function vypisTabulkudb()
    {   
        $existuje = new  RvsOverTabulku();

        // Získání výstupu z metody Třídy RvsOverTabulku
        $existujeTabulka = $existuje->overExistenciTabulky();

     
        // Zde můžeme pracovat s proměnnou $existujeTabulka
        if ($existujeTabulka) {

           //dotaz pro ověření existence hodnoty - zaznamu vtabulce
            $result = $existuje->overExistenciZaznamu();

            if ($result > 0) {
                // Hodnota existuje v databázi mužeme vypsat záznamy
                $radek = $existuje->vratZaznamy();
                

                // Zobrazíme data na stránce, například tabulku HTML
                $html = '<div class="wrap">';
                //$html .= '<h2>Správa Modulu</h2>';
                $html .= '<table class="table">';
                $html .= '<thead>';
                $html .= '<tr><th>Google mapa</th><th>Ulice</th><th>Město</th><th>Psč</th><th>Email</th><th>Telefon</th></tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                
                    $html .= '<tr>';

                    $html .= '<td>';
                    $html .= ($radek->gps == 1) ? "ano" : "ne";
                    
                    $html .='</td>';
                    $html .= '<td>' . htmlspecialchars($radek->ulice) . '</td>';
                    $html .= '<td>' . htmlspecialchars($radek->mesto) . '</td>';
                    $html .= '<td>' . htmlspecialchars($radek->psc) . '</td>';
                    $html .= '<td>' . htmlspecialchars($radek->email) . '</td>';
                    $html .= '<td>' . htmlspecialchars($radek->telefon) . '</td>';
                    //$html .= '<td></td>';
                    $html .= '</tr>';
                

                    $html .= '<tr>';
                    $html .= '<form method="POST" action="' . $_SERVER['REQUEST_URI'] . '">';
                    $html .= '';
                    $html .= '<td><select name="gps">
                                <option value="">...</option>
                                <option value="1">Zobrazit</option>
                                <option value="2">Nezobrazovat</option>
                                </select></td>';
                    $html .= '<td><input  type="text"  size="auto" name="ulice" value="" ></td>';
                    $html .= '<td><input  type="text"  size="auto" name="mesto" value="" ></td>';
                    $html .= '<td><input  type="text"  size="auto" name="psc" value="" ></td>';
                    $html .= '<td><input  type="text"  size="auto" name="email" value="" ></td>';
                    $html .= '<td><input  type="text"  size="auto" name="telefon" value="" ></td>';

                    $html .= '<thead>';
                    $html .= '<tr><th>site key</th><th>secret key</th><th>captcha</th></tr>';
                    $html .= '</thead>';
                    $html .= '<tr>';
                    $html .= '<td>' . htmlspecialchars($radek->sitekey) . '</td>';
                    $html .= '<td>' . htmlspecialchars($radek->secretkey) . '</td>';
                    $html .= '<td>';
                    $html .= ($radek->activecaptcha == 2) ? "ano" : "ne";
                    $html .= '</td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td><input  type="text"  size="auto" name="sitekey" value="" ></td>';
                    $html .= '<td><input  type="text"  size="auto" name="secretkey" value="" ></td>';
                    $html .= '<td><select name="captcha">
                                <option value="">...</option>
                                <option value="2">Zobrazit</option>
                                <option value="1">Nezobrazovat</option>
                                </select></td>';
                    $html .= '</tr>';



                    
                    $html .= '<td>';
                    $html .= '<input  type="hidden"  name="active" value="go" >';
                    $html .= '<input  type="hidden"  name="id" value="' . htmlspecialchars($radek->id). '" >';
                    $html .= '<button class="btn btn-info" type="submit"  >změnit data</button></form>';
                    $html .= '</td>';
                    $html .= '</tr>';

                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '</div>';

                return $html;  
            } else {
                // Hodnota neexistuje v databázi - vytvoříme první záznam 
                //echo '<p class="alert alert-warning">Hodnota neexistuje v databázi.</p>';

                $html = '<form id="my-active-form" method="post" action="">
                         <input  type="text"  name="active" value="go2" >
                         <input type="submit" name="register" value="Vložit data">
                         </form>';
                echo $html;      
                return FALSE;
            }
        } else {
            echo '<p class="alert alert-warning"> není propojen s DB</p>';
            return FALSE;
        }
    }

    public function update()
    {


        if ((isset($_POST['active']))) {


            /**
             * Získáme hodnoty z formuláře 
             * Funkce sanitize_text_field() 
	         * zajišťuje bezpečné zpracování textových dat.
             */

            $active = sanitize_text_field($_POST['active']);
            // Uložení dalších údajů do naší tabulky
            $data_active = sanitize_text_field($active);
          

            if ($data_active == 'go2') {
                //echo $data_active;
                global $wpdb;
                $table_name = $wpdb->prefix . '' . SQL_TABULKA_CONTACT_MODUL; // Název naší vlastní tabulky s prefixem WordPressu
                echo $table_name;
                $wpdb->insert( $table_name,array('statut' => 1));
                            
                     // Kontrola chyb při vložení
                     if ($wpdb->last_error) {
                         error_log("Chyba při vkládání prvního záznamu: " . $wpdb->last_error);
                     }
            }


            if ($data_active == 'go') {

            $id= sanitize_text_field($_POST['id']);
            $telefon = sanitize_text_field($_POST['telefon']);
            $ulice = sanitize_text_field($_POST['ulice']);
            $mesto = sanitize_text_field($_POST['mesto']);
            $psc = sanitize_text_field($_POST['psc']);
            $gps = sanitize_text_field($_POST['gps']);
            $email = sanitize_text_field($_POST['email']);

            $captcha = sanitize_text_field($_POST['captcha']);
            $sitekey = sanitize_text_field($_POST['sitekey']);
            $secretkey = sanitize_text_field($_POST['secretkey']);

            $data_id = sanitize_text_field($id);
            $data_telefon = sanitize_text_field($telefon);
            $data_ulice = sanitize_text_field($ulice);
            $data_mesto = sanitize_text_field($mesto);
            $data_psc = sanitize_text_field($psc);
            $data_gps = sanitize_text_field($gps);
            $data_email = sanitize_text_field($email);

            $data_captcha = sanitize_text_field($captcha);
            $data_sitekey = sanitize_text_field($sitekey);
            $data_secretkey = sanitize_text_field($secretkey);

                $data = array(); // Inicializace prázdného pole

                    if (!empty($data_telefon)) {
                        // Odstranění prázdných mezer
                        $cisloTelefonu = str_replace(' ', '', $data_telefon);

                        // Validace formátu čísla pomocí regulárního výrazu
                        if (!preg_match('/^\+420\d{9}$/', $cisloTelefonu)) {
                            return '<span  class="warningRVS">Neplatné telefonní číslo! '.$cisloTelefonu.' - zadejte ve formátu +420 111 222 333</span>'; // Číslo je neplatné
                        } 
                        else{
                            // Data, která chcete aktualizovat
                            $data['telefon'] = $cisloTelefonu;     
                        }
                    }

                    if (!empty($data_email)) {
                        if (!is_email($email)) { // WordPress funkce pro validaci e-mailu
                            
                            return '<span  class="warningRVS">Neplatný email! '.$data_email; // Email je neplatný
                       
                        } else {
                            // Data, která chcete aktualizovat
                            $data['email'] = $data_email;
                        }    
                    }


                    // Podmínka pro přidání 'psc' do pole $data
                    if ( $data_secretkey) {
                        $data['secretkey'] =  $data_secretkey;
                    }

                    // Podmínka pro přidání 'psc' do pole $data
                    if ( $data_sitekey) {
                        $data['sitekey'] =  $data_sitekey;
                    }

                    // Podmínka pro přidání 'psc' do pole $data
                    if ( $data_captcha) {
                        $data['activecaptcha'] =  $data_captcha;
                    }

                    // Podmínka pro přidání 'psc' do pole $data
                    if ($data_gps) {
                        $data['gps'] = $data_gps;
                    }

                    // Podmínka pro přidání 'psc' do pole $data
                    if ($data_ulice) {
                        $data['ulice'] = $data_ulice;
                    }

                    // Podmínka pro přidání 'psc' do pole $data
                    if ($data_psc) {
                        $data['psc'] = $data_psc;
                    }

                    // Podmínka pro přidání 'mesto' do pole $data
                    if ($data_mesto) {
                        $data['mesto'] = $data_mesto;
                    }

                    

                    global $wpdb;
                    $tabulka = SQL_TABULKA_CONTACT_MODUL;
                    $table_name = $wpdb->prefix .''.$tabulka;

                    // Podmínka pro aktualizaci (například podle ID uživatele)
                    $where = array(
                        'id' => $data_id // $user_id je hodnota ID uživatele, kterou chcete aktualizovat
                    );

                    // Proveďte aktualizaci
                if(!empty($data)){ 
                            $updated = $wpdb->update(
                                $table_name,
                                $data,
                                $where
                            );
                


                            //$current_url = home_url(add_query_arg(array(), $wp->request)); // Získání aktuální URL
                            // Získání aktuální URL pomocí WordPress funkcí
                            $current_url = esc_url( $_SERVER['REQUEST_URI'] );
                                

                            // wp_redirect($current_url);
                            //exit; // Ukončení skriptu, aby se zabránilo dalšímu vykonávání kódu

                            // Kontrola výsledku
                            if ($updated !== false) {
                                unset($_SESSION['form_data']); // Vyprázdnění dat formuláře
                                return "<span class='tl_RVS'>Úspěšně aktualizováno - <a href=".$current_url.">refresh stránky</a> </span>";
                            } else {
                                echo "Chyba při aktualizaci.";
                            }
                }
                else{
                return '<span  class="warningRVS">Nebyla zadána žádná data </span>';
                }
            }        
        } 
    }

}
