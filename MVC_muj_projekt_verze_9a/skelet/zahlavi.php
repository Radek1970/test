<?php 
session_start();
/*
if (!isset($_SESSION['uzivatel_id'])) {
    header('Location: prihlaseni.php');
    exit();
}
*/
if (isset($_GET['odhlasit'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}



require_once('jadro/Defines.php'); 
require_once('jadro/Db.php');
require_once('jadro/Fn.php');

function nactiTridu($trida)
{   
    $trida = str_replace('\\', '/', $trida);
    //require("tridy/$trida.php");
    require('tridy/' .$trida . '.php');
    
}

spl_autoload_register("nactiTridu"); 


    /* dotaz pro zavolání funkce pro spojeni s DB */
    Db::propoj('DB_HOST','DB_NAME','DB_USERNAME','DB_PASSWORD');			
    //Db::connect('127.0.0.1', 'databaze_pro_web', 'root', '');
    

?>
