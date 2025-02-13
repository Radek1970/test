<?php
session_start();

/**
 * ukonceni session pro filtrovani 
 * dotazu v tabulce
 */
if (isset($_POST['resetfiltr'])) {
   // Ukončit jednu konkrétní proměnnou
   unset($_SESSION['filtr']);
   unset($_SESSION['dotaz1']);
   unset($_SESSION['dotaz2']);
   //header('Location: index.php');
    //exit();
}

/**
 * načte soubory pro spojení s DB
 */
require_once('jadro/Defines.php');
//require_once('jadro/Db.php');
require_once('jadro/Databaze.php');

/**
 * nacitani trid
 */
function nactiTridu($trida)
{
    $trida = str_replace('\\', '/', $trida);
    //require("tridy/$trida.php");
    require('tridy/' . $trida . '.php');
}

spl_autoload_register("nactiTridu");


/* dotaz pro zavolání funkce pro spojeni s DB */
Databaze::propoj('DB_HOST', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD');
//Db::connect('127.0.0.1', 'databaze_pro_web', 'root', '');
