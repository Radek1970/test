<?php
/*
Plugin Name: Rezervace Kalendáře RAVIS
Description: Tento plugin umožňuje rezervaci v autopůjčovně pomocí kalendáře.
Version: 1.0
Author: Vaše Jméno
*/

/**
 * Ochrana proti přímému přístupu
 */
if (!defined('ABSPATH')) {
    die('<h2>Neoprávněný přístup!</h2><h3>Přímý přístup k tomuto souboru není povolen!</h3>');
}

define('REZERVACNI_KALENDAR_VERSION', '1.0');
define('REZERVACNI_KALENDAR_DIR', plugin_dir_path(__FILE__));
define('REZERVACNI_KALENDAR_URL', plugin_dir_url(__FILE__));
define('REZERVACNI_KALENDAR_BASE_URL', trailingslashit(plugins_url('rezeracni-kalendar-ravis')));

define('SQL_TABULKA_REZERVACE', 'rvs_rezervace');
define('SQL_TABULKA_PRODUCT', 'rvs_product');
define('BARVA_POPTAVKY', 'background-color:#0d6efd; color:blue');
define('BARVA_REZERVACE', 'background-color:#fa0820; color:#ffffff');
define('BARVA_NEDOSTUPNE', 'background-color:#adb5bd; color:#ffffff');
define('BARVA_DNES', 'font-weight:bold; color:#ffffff; background-color:#ffc107');

/**
 * Funkce načte třídy z adresáře `class` v pluginu.
 */
function load_custom_class() {
    $class_directory = REZERVACNI_KALENDAR_DIR . 'class/';
    $class_files = glob($class_directory . '*.php');
    foreach ($class_files as $class_file) {
        require_once $class_file;
    }
}
add_action('init', 'load_custom_class');

/**
 * Funkce načte JavaScriptový soubor pro plugin.
 */


function pridat_js_do_admin() {
    // Zaregistrujte skript
    wp_register_script('admin-script', plugins_url('/assets/js/admin-script.js', __FILE__), array('jquery'), '1.0.0', true);

    // Načtěte skript
    wp_enqueue_script('admin-script');
}

add_action('admin_enqueue_scripts', 'pridat_js_do_admin');


function pridej_js_do_public() {
    // Zaregistrujte skript
    wp_register_script('frontend-script', plugins_url('/assets/js/frontend-script.js', __FILE__), array('jquery'), '1.0.0', true);

    // Načtěte skript
    wp_enqueue_script('frontend-script');
}

add_action('wp_enqueue_scripts', 'pridej_js_do_public');



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


function load_css_styl_pro_admin() {
    $plugin_url = plugin_dir_url( __FILE__ );
    // Načítání CSS
    wp_enqueue_style('css-styl-pro-admin', $plugin_url . 'assets/css/style.css');
}
// Přidání akce pro načtení CSS
add_action('admin_enqueue_scripts', 'load_css_styl_pro_admin');














/**
 * Funkce pro registraci tabulek v databázi při aktivaci pluginu.
 */
require_once(REZERVACNI_KALENDAR_DIR . 'include/vytvor_tabulky.php');
function on_plugin_activation() {
    vytvorit_databazovou_tabulku();
}
register_activation_hook(__FILE__, 'on_plugin_activation');

/**
 * Funkce pro akce po deaktivaci pluginu (může obsahovat závěrečné úkoly nebo úklidy).
 */
function on_plugin_deactivation() {
    // Váš kód pro deaktivaci pluginu
}
register_deactivation_hook(__FILE__, 'on_plugin_deactivation');

/**
 * Funkce načte veřejný pohled pro uživatele.
 */
require_once(REZERVACNI_KALENDAR_DIR . 'public/vypis_pohledu.php');

/**
 * Funkce pro načítání souborů pouze v administraci.
 */
function load_admin_files() {
    if (is_admin()) {
        require_once(REZERVACNI_KALENDAR_DIR . 'admin/admin.php');
    }
}
add_action('init', 'load_admin_files');



