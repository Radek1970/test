<?php
// Funkce pro vytvoření databázové tabulky
function vytvorit_databazovou_tabulku() {
    global $wpdb; // Globální objekt WordPress Database

    $nazev_tabulky = $wpdb->prefix . '' . SQL_TABULKA_REZERVACE; // Prefix tabulky pro zajištění jedinečnosti názvu

    $sql = "CREATE TABLE IF NOT EXISTS $nazev_tabulky (
        id INT NOT NULL AUTO_INCREMENT,
        idspz int(11) DEFAULT NULL,
        rz VARCHAR(7) DEFAULT NULL,
        nazev VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon int(11) DEFAULT NULL,
        statut int(11) DEFAULT NULL,
        datum_od date DEFAULT NULL,
        datum_do date DEFAULT NULL,
        datum_zapisu date DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;";


    $nazev_tabulky2 = $wpdb->prefix . '' . SQL_TABULKA_PRODUCT; // Prefix tabulky pro zajištění jedinečnosti názvu

    $sql2 = "CREATE TABLE IF NOT EXISTS $nazev_tabulky2 (
        id INT NOT NULL AUTO_INCREMENT,
        nazev VARCHAR(255) NOT NULL,
        spz VARCHAR(255) NOT NULL,
        popis VARCHAR(255) NOT NULL,
        cena int(11) DEFAULT NULL,
        stav int(11) DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;";

    // Zde můžete provést další operace s SQL dotazy nebo tabulkami.

    // Spusťte SQL dotazy
    $wpdb->query($sql);
    $wpdb->query($sql2);






    // Spuštění SQL dotazu pro vytvoření tabulky
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


