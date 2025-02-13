<?php

class RvsContactForm {

        
       
    
        public function __construct() {
           
        }

        function formatPhoneNumber($number) {
            // vstup +420111222333
            // výstup +420 111 222 333
            // Oddělíme první znak
            if(!empty($number)){
            $prefix = $number[0];
            $rest = substr($number, 1);
        
            // Vložíme mezeru za každé 3 znaky
            $formatted = implode(' ', str_split($rest, 3));
        
            // Spojíme zpět první znak s formátovanou částí
            return $prefix . $formatted;
            }
        }



        public function vypisCard(){


            $existuje = new  RvsOverTabulku();
            // Získání výstupu z metody Třídy RvsOverTabulku
            $existujeTabulka = $existuje->overExistenciTabulky();

        
            // Zde zpracujeme proměnnou $existujeTabulka
            if ($existujeTabulka) {

                global $wpdb;
          
                // když existuje spustíme dotaz na existenci záznamu
                $result =  $existuje->overExistenciZaznamu();

                    if ($result > 0) {
                        // Hodnota existuje v databázi - vypíšeme záznamy
    
                        $radek = $existuje->vratZaznamy();
                        $html ='';
                        // vytvoření tabulky HTML
                      
                            $formatAdresa = $radek->mesto.', '.$radek->ulice;
                            $map = new RvsGoogleMap($formatAdresa);
                            $mapSrc = $map->generateGoogleMapSrc();

                        if ($radek->gps == 1){ 
                        $html .= '<div class="rvs-map" data-aos="fade-up" data-aos-delay="200">
                        <iframe style="border:0; width: 100%; height: 270px;" src="'. htmlspecialchars($mapSrc, ENT_QUOTES, 'UTF-8') . '"  frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>  
                        </div><!-- End Google Maps -->';
                        }

                        // Zobrazíme data na stránce
                        $html .= '<div class="rvs-row"><div class="rvs-column rvs-side">';
    
                                if (($radek->mesto) && ($radek->ulice)){ 
                                $html .= '<div class=" rvs-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="material-icons md-18">location_on</i><div>
                                <h3>Adresa</h3>
                                <p><small>'. htmlspecialchars($radek->ulice) .'<br>'.$radek->mesto.' '.$radek->psc.'</small></p></div>
                                </div><!-- End Info Item -->';
                                }

                                if ($radek->telefon){ 
                                    $telefon = $this->formatPhoneNumber($radek->telefon);
                                        
                                $html .= '<div class=" rvs-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="material-icons md-18">call</i><div>
                                <h3>Telefon</h3>
                                <p><small>'. htmlspecialchars($telefon) .'</small></p></div>
                                </div><!-- End Info Item -->';
                                }
                               
                                if ($radek->email){ 
                                $html .= '<div class=" rvs-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="material-icons md-18">email</i><div>
                                <h3>Email</h3>
                                <p><small>'. htmlspecialchars($radek->email) .'</small></p></div>
                                </div><!-- End Info Item -->';
                                }
                                
                        
                        $html .= '</div>';
                        return $html;
                    } else {
                        // Hodnota neexistuje v databázi
                        //echo '<p class="alert alert-warning">Hodnota neexistuje v databázi.</p>';
                        return FALSE;
                    }
            } else {
                //echo '<p class="alert alert-warning"> není propojen s DB</p>';
                return FALSE;
            }



        }


        public function vypisFormular($data){

            $recaptcha = new GoogleRecaptcha();
            $existuje = new  RvsOverTabulku();
            $radek = $existuje->vratZaznamy();
           
            $html  = '';
            $html .= '<div class="rvs-column rvs-middle"><form id="simple-contact-form" method="post" class="rvs-form" action="">';
            
            $html .= '<div class="rvs-form-row">
            <!-- <label for="scf_name">Jméno</label> -->
            <input type="text" id="scf_name" name="scf_name" class="rvs-form-control" value="'.$data['scf_name'].'" placeholder="Vaše jméno" required="">
            <!-- <label for="scf_surname">Přijmení</label> --> 
            <input type="text" id="scf_surname" name="scf_surname" class="rvs-form-control" value="'.$data['scf_surname'].'" placeholder="Vaše přijmení" required="">
            </div>';

            $html .= '<div class="rvs-form-row">
            <!-- <label for="scf_email">E-mail</label> -->
            <input type="email" id="scf_email" name="scf_email" class="rvs-form-control"  value="'.$data['scf_email'].'" placeholder="Váš email" required="">
            <!-- <label for="scf_subject">Předmět zprávy</label> -->
            <input type="text" id="scf_subject" name="scf_subject" class="rvs-form-control" value="'.$data['scf_subject'].'" placeholder="Předmět zprávy" required="">
            </div>';
            $html .= '<div class="col-md-12">
            <!-- <label for="scf_message">Zpráva</label> -->
            <textarea id="scf_message" name="scf_message" class="rvs-form-control" rows="6" placeholder="Zpráva" required="">'.$data['scf_message'].'</textarea>
            </div>';


            if (($radek->activecaptcha == 1) || ( (empty($radek->sitekey)) && (empty($radek->secretkey)))){ 
            $html .= '<div class="col-md-">
            <label for="scf_antispam">Kolik je 3 + 2? (antispam)</label>
            <input type="text" id="scf_antispam" name="scf_antispam" class="rvs-form-control" placeholder="Kolik je 3 + 2?" required="">
            </div>';
            }
            else{
            $html .= '<input type="hidden" id="scf_antispam" name="scf_antispam" value="5" >';    
           

            $html .= '<div class="col-md-">';
            $html .= $recaptcha->renderCaptcha();
            $html .= '</div>';
            }

            $html .= '<div class="col-md-6">';
            $html .= '<!-- Skrytá pole pro ochranu proti spamu -->
                      <input type="hidden" name="antiSpam" value="">
                      <input type="hidden" name="timestamp" value="<?php echo time(); ?>">
                      <input type="submit" name="scf_submit"  class="rvs-form-button" value="Odeslat">';
            $html .= '<br><br></div>';


            $html .= '</form></div>
                      <!-- End Contact Form -->
                      </div><!-- End row -->';
        
            return $html;
        }
   
        public function validate() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scf_submit'])) {

                
                
                session_start(); // Start session pro uložení dat
                $errors = [];
                
                // Uložení hodnot z formuláře
                $_SESSION['scf_form_data'] = [
                    'scf_name' => sanitize_text_field($_POST['scf_name'] ?? ''),
                    'scf_surname' => sanitize_text_field($_POST['scf_surname'] ?? ''),
                    'scf_email' => sanitize_email($_POST['scf_email'] ?? ''),
                    'scf_subject' => sanitize_text_field($_POST['scf_subject'] ?? ''),
                    'scf_message' => sanitize_textarea_field($_POST['scf_message'] ?? ''),
                    'scf_antispam' => sanitize_text_field($_POST['scf_antispam'] ?? ''), 
                ];
                
                $existuje = new  RvsOverTabulku();
                $radek = $existuje->vratZaznamy();
                if (($radek->activecaptcha == 2) && ( (!empty($radek->sitekey)) && (!empty($radek->secretkey)))){ 


                    //captcha
                    //pokud klíč v poli neexistuje bude použita výchozí hodnota
                    $captchaResponse = $_POST['g-recaptcha-response'] ?? '';

                    $userIP = $_SERVER['REMOTE_ADDR'];
                
                    $recaptcha = new GoogleRecaptcha();
                     $valid =  $recaptcha->validateCaptcha($captchaResponse, $userIP); 
                    if ($valid == false) {
                        // Další zpracování dat formuláře
                        $errors[] = "Ověření selhalo. Zaškrtněte znovu že nejste robot ";
                    }
                }



                 // Validace antispamu
                 if (empty($_POST['scf_antispam']) || intval($_POST['scf_antispam']) !== 5) {
                    $errors[] = 'Antispamová kontrola nebyla správně vyplněna.';
                }    
                
                 // Kontrola skrytého pole antiSpam
                 if (!empty($_POST['antiSpam'])) {
                    $errors[] = 'Formulář byl označen jako spam.';
                }
        
                // Kontrola časové validace
                if (isset($_POST['timestamp'])) {
                    $elapsedTime = time() - intval($_POST['timestamp']);
                    if ($elapsedTime < 5) { // Minimální čas odeslání formuláře (např. 5 sekund)
                        $errors[] = 'Formulář byl odeslán příliš rychle.';
                    }
                } else {
                    $errors[] = 'Chybí časová validace.';
                }
        
                // Validace polí
                if (empty($_POST['scf_name'])) {
                $errors[] = 'Prosím zadejte své jméno.';
                }
                elseif (strlen($_POST['scf_name']) < 2) {
                    $errors[] = "Jméno musí mít alespoň 2 znaky.";
                }
        
                if (empty($_POST['scf_surname'])) {
                    $errors[] = 'Prosím zadejte své přijmení.';
                }
        
                if (empty($_POST['scf_email']) || !is_email($_POST['scf_email'])) {
                    $errors[] = 'Prosím zadejte platnou e-mailovou adresu.';
                }
        
                if (empty($_POST['scf_subject'])) {
                    $errors[] = 'Prosím zadejte předmět.';
                }
        
                if (empty($_POST['scf_message'])) {
                    $errors[] = 'Prosím zadejte zprávu.';
                }
        
        
                // Zpracování formuláře, pokud nejsou chyby
                if (empty($errors)) {
                    // Nastavení e-mailu

                    $existuje = new  RvsOverTabulku();
                    $email = $existuje->vratEmail();
                    if(!empty($email)){
                        $to =  $email;
                    }else{
                        $to = get_option('admin_email');
                    }
                
                    $subject =  $_SESSION['scf_form_data']['scf_subject'];
                 
                    $headers = [
                        "MIME-Version: 1.0",
                        "Content-type: text/html; charset=UTF-8",
                        'From: ' . $_SESSION['scf_form_data']['scf_name'] . ' <' . $_SESSION['scf_form_data']['scf_email'] . '>',
                        'Reply-To: ' . $_SESSION['scf_form_data']['scf_email']. '',
                        'Cc: Another Name <another-email@example.com>',
                    ];
                    $body ='<html><head><style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #cbc8c8;
                        margin: 0;
                        padding: 20px;
                    }
                    .content {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 5px;
                    }
                    </style>
                    </head>
                    <body>
                    <div class="content"><title>kontaktní formulář</title></head><body>';
                    $body .= "<h1>Nová zpráva z kontaktního formuláře:</h1><br>";
                    $body .= "<p><b>Odesílatel: " . $_SESSION['scf_form_data']['scf_name'] .' '. $_SESSION['scf_form_data']['scf_surname'] ."</b></p>";
                    $body .= "<p>E-mail: " . $_SESSION['scf_form_data']['scf_email'] . "</p>";
                    $body .= "<p>Zpráva:<br>" . $_SESSION['scf_form_data']['scf_message'] . "</p><br>";
                    $body .= "</div></body></html>";
        
                    
                    if (wp_mail($to, $subject, $body, $headers)) {
                        unset($_SESSION['scf_form_data']); // Vyprázdnění dat formuláře
                        return '<div class="rvs-footer rvs-ok">Vaše zpráva byla úspěšně odeslána.</div>';
                    } else {
                        return '<div class="rvs-footer rvs-error">Došlo k chybě při odesílání zprávy.</div>';
                    }
                } else {
                    return '<div class="rvs-footer rvs-error">Formulář obsahuje chyby: ' . implode('<br>', $errors) .'</div>';
                }

            }
        }
    }
     