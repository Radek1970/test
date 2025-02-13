<?php

class GoogleRecaptcha {


    private $siteKey;
    private $secretKey;

    public function __construct() {
        $this->loadKeys();
    }


    private function loadKeys() {
        // Vytvoření instance třídy pro získání hodnoty z DB
        $dbHandler = new RvsOverTabulku();
        $record = $dbHandler->vratZaznamy();

        // Předpoklad: klíč v databázi je 'site_key'
        $this->siteKey = $record->sitekey ?? null;
        $this->secretKey = $record->secretKey ?? null;
    }

    public function getSiteKey() {
        if(empty($this->siteKey)){
            $this->siteKey = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'; // veřejný klíč - testovací klíče | 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
            return $this->siteKey;
        }
        else{
            return $this->siteKey;
        }
    }

    public function getSecretKey() {
        if(empty($this->secretKey)){
            $this->secretKey = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'; // tajný klíč - testovací klíče | 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
            return $this->secretKey;
        }
        else{
            return $this->secretKey;
        }
    }

    // Pevně definované klíče
    // private $siteKey = '6LeIZbYqAAAAAIZRKwra7MEjtBk73Ua_YMdJwOXT'; // veřejný klíč
    // private $secretKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'; // tajný klíč 

    //private $siteKey = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'; // veřejný klíč - testovací klíče | 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
    //private $secretKey = '*****************************************; // tajný klíč - testovací klíče | 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe


    private $apiUrl = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Vrací HTML pro vložení reCAPTCHA na stránku
     * <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     * <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeIZbYqAAAAAIZRKwra7MEjtBk73Ua_YMdJwOXT"></script>
     *
     * @return string HTML kód pro reCAPTCHA
     */
    public function renderCaptcha() {
        return '<div class="g-recaptcha" data-sitekey="' . htmlspecialchars($this->siteKey) . '"></div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }

    /**
     * Ověřuje reCAPTCHA odpověď
     *
     * @param string $response reCAPTCHA odpověď (obvykle z $_POST['g-recaptcha-response'])
     * @param string $userIP IP adresa uživatele (volitelně)
     * @return bool True pokud je ověření úspěšné, jinak false
     */
    public function validateCaptcha($response, $userIP = null) {
        // Zkontrolujeme, jestli máme odpověď
        if (empty($response)) {
            return false;
        }

        // Vytvoření dat pro požadavek
        $data = [
            'secret' => $this->secretKey,
            'response' => $response,
        ];

        if (!empty($userIP)) {
            $data['remoteip'] = $userIP;
        }

        // Volání Google API
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($this->apiUrl, false, $context);

        if ($result === false) {
            return false; // API selhalo
        }

        $responseData = json_decode($result, true);

        // Kontrola úspěšnosti
        isset($responseData['success']) && $responseData['success'] === true;
        return true;
    }

}
