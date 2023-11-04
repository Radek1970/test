<?php
/**
 * Administracni funkce pluginu
 **/



 function admin_page_setup_menu() {
  // Přidání hlavního menu
  add_menu_page('Rezervační kalendář', 'Rezervační kalendář RAVIS', 'manage_options', 'hlavni-menu-slug', 'hlavni_menu_callback_function');

  // Přidání submenu pod hlavním menu
  add_submenu_page('hlavni-menu-slug', 'Název Submenu 1', 'Poptávky termínů', 'manage_options', 'submenu-slug-2', 'submenu_callback_function2');
  // Přidání submenu pod hlavním menu
  add_submenu_page('hlavni-menu-slug', 'Název Submenu 2', 'Rezervace termínů', 'manage_options', 'submenu-slug-3', 'submenu_callback_function3');
  // Přidání submenu pod hlavním menu
  add_submenu_page('hlavni-menu-slug', 'Název Submenu 3', 'Blokace termínů', 'manage_options', 'submenu-slug-4', 'submenu_callback_function4');
  // Přidání submenu pod hlavním menu
  add_submenu_page('hlavni-menu-slug', 'RK Produkty', 'Produkty editace', 'manage_options', 'submenu-slug-5', 'submenu_callback_function5');
}

function hlavni_menu_callback_function() {
  // Obsah pro hlavní menu  
  require_once(REZERVACNI_KALENDAR_DIR.'admin/admin_obsah_str1.php');      
}

function submenu_callback_function2() {
  // Obsah pro submenu 1
  require_once(REZERVACNI_KALENDAR_DIR.'admin/admin_obsah_str2.php');      
}

function submenu_callback_function3() {
  // Obsah pro submenu 2
  require_once(REZERVACNI_KALENDAR_DIR.'admin/admin_obsah_str3.php');  
}

function submenu_callback_function4() {
  // Obsah pro submenu 2
  require_once(REZERVACNI_KALENDAR_DIR.'admin/admin_obsah_str4.php'); 
   
}

function submenu_callback_function5() {
  // Obsah pro submenu 2
  require_once(REZERVACNI_KALENDAR_DIR.'admin/admin_obsah_str5.php');  
}

// Zaregistrujte menu
add_action('admin_menu', 'admin_page_setup_menu');







?>