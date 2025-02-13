<?php
/*
Plugin Name: Simple Contact Form
Description: Jednoduchý kontaktní formulář s validací a ochranou proti spamu. | shortcode [simple_contact_form]
Version: 1.0.4
Author: RAVIS
*/


/**
 * Ochrana proti přímému přístupu
 */
if (!defined('ABSPATH')) {
    die('<h2>Neoprávněný přístup!</h2><h3>Přímý přístup k tomuto souboru není povolen!</h3>');
}
/**======================================================================== */

function get_plugin_version() {
    // Načte data o pluginu, včetně verze z hlavního komentáře
    $plugin_data = get_plugin_data( __FILE__ );
    return $plugin_data['Version']; // Vrací verzi pluginu
}

/**
 * definice adresářů
 */
define('KONTAKTNI_MODUL_VERSION', '1.0');
define('KONTAKTNI_MODUL_DIR', plugin_dir_path(__FILE__));
define('KONTAKTNI_MODUL_URL', plugin_dir_url(__FILE__));
define('KONTAKTNI_MODUL_BASE_URL', trailingslashit(plugins_url('kontaktni-formular-ravis')));
/**======================================================================== */

/**
 * definice názvů tabulek
 */
define('SQL_TABULKA_CONTACT_MODUL', 'rvs_contactmodul');
/**======================================================================== */

/**
 * Funkce načte třídy z adresáře `class` v pluginu.
 */
function load_custom_class() {
    $class_directory = KONTAKTNI_MODUL_DIR . 'class/';
    $class_files = glob($class_directory . '*.php');
    foreach ($class_files as $class_file) {
        require_once $class_file;
    }
}
add_action('init', 'load_custom_class');
/**======================================================================== */

// Registrace shortcode simple-contact-form/simple-contact-form

function contact_form_shortcode() {

    // Pokud je plugin aktivní, vykreslíme kontaktní formulář
    return render_contact_form(); // Vykreslí kontaktní formulář
}
add_shortcode('rvs_contact_form', 'contact_form_shortcode'); 
/**======================================================================== */

// Načtení dalších souborů
require_once(KONTAKTNI_MODUL_DIR . 'public/modul-contact-form.php');

/*================================================================================================*/
/**
 * Funkce načte CSS soubor pro plugin .
 */
function load_css_styl_pro_admin() {
    $plugin_url = plugin_dir_url( __FILE__ );
    // Načítání CSS
    wp_enqueue_style('css-styl-pro-admin', $plugin_url . 'assets/css/style.css');
}
// Přidání akce pro načtení CSS
add_action('admin_enqueue_scripts', 'load_css_styl_pro_admin');


/**
 * Funkce načte CSS soubor pro plugin.
 */
function load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );
    // Načítání CSS
    wp_enqueue_style('css-styl-pro-admin', $plugin_url . 'public/css/styles.css');
}
// Přidání akce pro načtení CSS
add_action('wp_enqueue_scripts', 'load_plugin_css');



/*================================================================================================*/
/**
 * Funkce pro registraci tabulek v databázi při aktivaci pluginu.
 */
require_once(KONTAKTNI_MODUL_DIR. 'inc/vytvor_tabulky.php'); // načtení souboru s funkci vytvorit_databazovou_tabulku()
function on_plugin_activation() {
    vytvorit_databazovou_tabulku();
}
register_activation_hook(__FILE__, 'on_plugin_activation');


/*================================================================================================*/
/**
 * Funkce pro akce po deaktivaci pluginu (může obsahovat závěrečné úkoly nebo úklidy).
 */
function on_plugin_deactivation() {
    // Váš kód pro deaktivaci pluginu
}
register_deactivation_hook(__FILE__, 'on_plugin_deactivation');

/*================================================================================================*/
/**
 * Funkce pro načítání souborů pouze v administraci.
 */
function load_admin_files() {
    if (is_admin()) {
        require_once(KONTAKTNI_MODUL_DIR . 'admin/admin.php');
    }
}
add_action('init', 'load_admin_files');

/*=================================================================================================*/




