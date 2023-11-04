<?php
 class RVS_over_identifikaci
 {

    public $attsproduct;


    public function productcontrol($attsproduct)
    {
        // Zde můžete zpracovat atributy (hodnoty) zadané v shortcode
        $attsproduct = shortcode_atts(
            array(
                'rz' => '0000', // Defaultní hodnota, pokud není specifikována v shortcode
                'xx' => 'CHYBA: není zadaná identifikace v shortcode',

            ),
            $attsproduct
        );

        // Získáme hodnotu atributu 'valueRZ'
        if (empty($attsproduct['rz'])) {
            $valueRZ = $attsproduct['xx'];
            echo '<p class="alert alert-warning">' . $valueRZ . '</p>';
        } else {
            $valueRZ = $attsproduct['rz'];
            //echo '<p class="alert alert-info">' . $valueRZ . '</p>';
        }

        // Zde můžete provést další zpracování hodnoty, např. výpis


    
        return $valueRZ;
    }






 }