<?php
namespace Zaklad\Html;


class KratkyText {

    public $strucne = "";

    public function kratkyVypis ($upravText) {
      
        //echo 'testování'.$upravText;

        /* ========== zkraceny vypis ============== */
                    
        $retezec = $upravText;
        //spočítá délku řetězce
        //echo  strlen($retezec);

        //konec prvni věty. Věta končí tečkou. Spočítá na jaké pozici se nachází první tečka
        //vrátí počet znaků (tedy i mezer) nalezených za prvním
        $konecPrvniVety = strcspn($retezec, '.', 0);
        //konec druhé věty. Věta končí tečkou. Spočítá na jaké pozici se nachází druhá tečka
        //vrátí počet znaků (tedy i mezer) nalezených za prvním
        $konecDruheiVety = strcspn($retezec, '.', $konecPrvniVety + 1);
        // sečte délku obou řetězců
        $pocetZnaku = $konecPrvniVety + $konecDruheiVety;
        //předá řetězec ve vypočtené délce
        $strucne = mb_substr(htmlspecialchars($upravText), 0, $pocetZnaku );
        //Převede všechna písmena v rětězci na velká
        $retezec = mb_strtoupper($strucne);
        //hledany znak
        $podretezec = mb_strtoupper('.');
        //Najde pozici prvního výskytu podřetězce v řetězci - revers
        $delkaTextu =  (mb_strrpos($retezec, $podretezec));
        //Vrátí podřetězec od startovní pozice s upraveným počtem znaků
        $strucne =  mb_substr(htmlspecialchars($upravText), 0, $delkaTextu+1);
        return $strucne;

        /* ======================== */
 
    }


}


