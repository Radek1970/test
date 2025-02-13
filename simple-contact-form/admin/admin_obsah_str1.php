<?php
require_once(KONTAKTNI_MODUL_DIR.'inc/verze_pluginu.php'); 

 echo "<div class='clearfix'>";

 echo "<div class='box0'>";
        //** box A */
         echo "<div class='box1'>";
         echo "<h2>Vytvoření kontaktního modulu</h2>";
         echo "<p>shortcode vložte do stránky </p><p><br> [rvs_contact_form] </p>";
         echo '</div>';

        //**box B */
         echo "<div class='box1'>";
         echo "<h2>Antispamová ochrana formuláře:</h2>";
         echo "<p>Antispamová ochrana formuláře je nastavena na tradiční metodu, kde je uživateli zadána jednoduchá otázka (např. Kolik je 2 + 3?). </p>  ";
         echo "<p> Antispamovou pchranu lze změnit na Google reCAPTCHA po vložení klíčů.</p>";
         echo '</div>';  
         
         
 echo '</div>';

 echo "<div class='box0'>";
         //** box A */
         echo "<div class='box2'>";
         echo '
         <h1>Jak získat Google reCAPTCHA</h1>
    <ol>
        <li>
            <strong>Přihlaste se do Google reCAPTCHA:</strong><br>
            Navštivte stránku 
            <a href="https://www.google.com/recaptcha/admin" target="_blank">Google reCAPTCHA Admin Console</a> 
            a přihlaste se pomocí svého Google účtu.
        </li>
        <li>
            <strong>Zaregistrujte webovou stránku:</strong>
            <ul>
                <li>Klikněte na tlačítko <em>"Create"</em> nebo <em>"Register a new site"</em>.</li>
                <li>Vyplňte formulář:
                    <ul>
                        <li><strong>Label:</strong> Libovolný název projektu (např. "Moje stránka").</li>
                        <li><strong>reCAPTCHA Typ:</strong> Vyberte:
                            <ul>
                                <li><strong>reCAPTCHA v2:</strong> Klasický checkbox "I m not a robot". - DOPORUČUJEME TUTO VARIANTU</li>
                                <li><strong>reCAPTCHA v3:</strong> Automatická ochrana bez viditelného widgetu. </li>
                            </ul>
                        </li>
                        <li><strong>Domény:</strong> Zadejte domény (např. <code>example.com</code>), kde bude reCAPTCHA aktivní.</li>
                        <li>Zkontrolujte nebo upravte e-mail administrátora.</li>
                    </ul>
                </li>
                <li>Zaškrtněte souhlas s podmínkami služby a odešlete formulář.</li>
            </ul>
        </li>
        <li>
            <strong>Získejte klíče:</strong><br>
            Po registraci obdržíte dva klíče:
            <ul>
                <li><strong>Site Key:</strong> Pro integraci na vašich stránkách.</li>
                <li><strong>Secret Key:</strong> Pro ověření na straně serveru.</li>
            </ul>
        </li>
    </ol>
    <p>Více informací naleznete v oficiální dokumentaci: 
        <a href="https://developers.google.com/recaptcha" target="_blank">Google reCAPTCHA Dokumentace</a>.
    </p>
         ';
         echo "VYGENEROVANÉ KLÍČE VLOŽTE DO FORMULÁŘE V NASTAVENÍ MODULU ";
         echo '</div>';   
         
         
 echo '</div>';


 
 echo '</div>';

?>
