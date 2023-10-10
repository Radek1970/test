<?php
session_start();
$_SESSION['jmeno_user'] = $jmeno_user;
$_SESSION['pass'] = $pass;
$_SESSION['funkce'] = $funkce;
$ev_c_autora = $_SESSION['ev_c'];
//$admini = isset($_SESSION['authuser']) ? $_SESSION['authuser'] : 1;
if ($_SESSION['authuser'] != 1) {
  
			// pripojeni sekce start body..
 include_once('komponenty/hlaska_ko.php');

	//echo "<p>Nemáte oprávnìní k prohlížení této stránky.................</p>\n";
	exit();
	}

?>
