<?php
 
 class Presmeruj {
    

     /**
     * funkce pro presmerovani
     * @param $str nazev stranky na kterou bude presmerovano
     */
    public function presmerovaniNaStranku ($str)
    {   //echo $str;
        header('Location: index.php?stranka='.$str.'');
        exit;
    }
 }