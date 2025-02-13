<?php
//session_start();
function render_contact_form() {

ob_start(); //wp funkce

    // Načtení hodnot z $_POST, pokud formulář selhal
    $data = $_SESSION['scf_form_data'] ?? [
        'scf_name' => '',
        'scf_surname' => '',
        'scf_email' => '',
        'scf_subject' => '',
        'scf_message' => '',
        'scf_antispam' => '',
    ];
  
    
// Inicializace třídy
$form = new RvsContactForm();


echo '<!-- Contact Section -->
<section id="modul" class="rvs-modul">

<div class="" data-aos="fade-up" data-aos-delay="100">';


// Zobrazení formuláře
echo $form->vypisCard();
echo $form->vypisFormular($data);
echo $form->validate();
     
echo'</div>
</section>';
return ob_get_clean(); //wpfunkce

      
}
add_action('wp', 'render_contact_form');
