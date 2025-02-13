<?php


// include('pohledy' . $stranka . '.php');
 if (isset($_GET['stranka'])){
    $stranka = $_GET['stranka'];
 }   
else{
    $stranka = 'domu';
}

if ((empty($_GET['stranka']))){
    $stranka = 'domu';
}



/**
	 * zachycení chyby - nepltná stránka
	 *
	 * @param string $stranka Název stránky
	 * @throws Exception Chyba
	 */


try {

if (preg_match('/^[a-z0-9]+$/', $stranka)) {
     
      @ $vlozeno = include('pohledy/' . $stranka . '.php');
       if (!$vlozeno)
        //echo('Podstránka nenalezena');
        throw new Exception('<i>došlo k chybě, omlouváme se </i> požadovaná podstránka nenalezena, automatické přesměrování na úvodni stránku'); 
}



} catch (Exception $e) {

    echo '<div class=" px-5 alert alert-danger" role="alert" "><p>'. $e->getMessage() .'</p></div> ';
    include('pohledy/domu.php');
}

/* 
else {
    echo('Neplatný parametr.');
} */

    
?>



                