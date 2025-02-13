<?php
/**
 * Administracni funkce pluginu
 **/



 function admin_page_setup_menu() {
  // Přidání hlavního menu
  add_menu_page('Kontaktní modul', // Název, který se zobrazí v horním menu administrace
    'Kontaktní modul RAVIS', // Název, který se zobrazí v bočním menu administrace (levé menu)
    'manage_options', // Oprávnění pro zobrazení menu
    'hlavni-menu-slug', // Unikátní identifikátor stránky
    'hlavni_menu_callback_function'// Callback funkce, která bude zobrazovat obsah stránky
    );

   // Přidání submenu pod hlavním menu
  add_submenu_page('hlavni-menu-slug', 'Název Submenu 1', 'Nastavení modulu', 'manage_options', 'submenu-slug-2', 'submenu_callback_function2');
}

function hlavni_menu_callback_function() {
  // Obsah pro hlavní menu  
  require_once(KONTAKTNI_MODUL_DIR.'admin/admin_obsah_str1.php');      
}

 function submenu_callback_function2() {
  // Obsah pro submenu 1
  require_once(KONTAKTNI_MODUL_DIR.'admin/admin_obsah_str2.php');      
}

// Zaregistrujte menu
add_action('admin_menu', 'admin_page_setup_menu');







?>