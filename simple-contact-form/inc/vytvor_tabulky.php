<?php
// Funkce pro vytvoření databázové tabulky
function vytvorit_databazovou_tabulku() {
    global $wpdb; // Globální objekt WordPress Database

    $nazev_tabulky = $wpdb->prefix . '' . SQL_TABULKA_CONTACT_MODUL; // Prefix tabulky pro zajištění jedinečnosti názvu
    $charset_collate = $wpdb->get_charset_collate(); // Kódování a collation dle nastavení WP

    $sql = "CREATE TABLE IF NOT EXISTS $nazev_tabulky (
        id INT NOT NULL AUTO_INCREMENT,
        gps int(11) DEFAULT NULL,
        psc VARCHAR(255) NOT NULL,
        mesto VARCHAR(255) NOT NULL,
        ulice VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon VARCHAR(15) NOT NULL,
        sitekey VARCHAR(255) NOT NULL,
        secretkey VARCHAR(255) NOT NULL,
        activecaptcha VARCHAR(255) NOT NULL,
        statut int(11) DEFAULT NULL,
        datum_zapisu date DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

     // Načtení knihovny dbDelta
     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
     dbDelta($sql);
 
     // Kontrola, zda tabulka obsahuje záznamy
     $row_count = $wpdb->get_var("SELECT COUNT(*) FROM $nazev_tabulky");
 
     if ($row_count == 0) {
         // Vložení výchozího záznamu, pokud tabulka neobsahuje žádná data
         global $wpdb;
         $table_name = $wpdb->prefix . '' . SQL_TABULKA_CONTACT_MODUL; // Název naší vlastní tabulky s prefixem WordPressu
         echo $table_name;
         $wpdb->insert( $table_name,array('statut' => 1, 'activecaptcha' => 1));
                     
              // Kontrola chyb při vložení
              if ($wpdb->last_error) {
                  error_log("Chyba při vkládání prvního záznamu: " . $wpdb->last_error);
              }
     }
    
}


