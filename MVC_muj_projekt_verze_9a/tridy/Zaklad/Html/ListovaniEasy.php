<?php
namespace Zaklad\Html;

use Exception;

class ListovaniEasy {

	public $pocet_zaznamu;
    public $pocet_vypisu;
	public $cti_od_radku;
	public $str;
	
		

/**
 * jednoduche listovani v DB
 * metoda GET
 * @param pocet_zaznamu = $pocetRadkuVdb - pocet zaznamu v DB
 * @param pocet_vypisu = $pocetRadku - pocet vypsanych radku
 * 
 */

    /* ================================ */
    /* ================================ */
	/* ================================ */
	/* ================================ */

    public function listuj ($pocetRadkuVdb,$pocetRadku){

		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		$stranka_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

         //$pozice = strrpos($stranka_url,"listuj");

         //$deklkaListuj = $pozice -  mb_strlen('listuj') +1;

         //$delka = mb_strlen($stranka_url);

        $stranka_url = (mb_substr($stranka_url, 0,79));
	    //echo '<a href="' . $stranka_url . '">' . $stranka_url . '</a>';


		$this->pocet_zaznamu = $pocetRadkuVdb;//pocet zaznamu v DB
		$this->pocet_vypisu = $pocetRadku;//pocet vypsanych radku
		$this->cti_od_radku = 0 ;//radek od ktereho se pocita
        $konecListovani = floor($pocetRadkuVdb / $pocetRadku);
        
		if (isset ($_GET["listuj"])){
			
	        


			 
		     $listujVpred ='';
		     $listujVzad = '';

			if (is_numeric($_GET["listuj"])){
				
                 $this->str = ($_GET["listuj"]);
		         $this->cti_od_radku = ($this->str * ($this->pocet_vypisu)); 
				 $this->str = $this->str +1;

                if ($this->cti_od_radku <= $this->pocet_zaznamu-$this->pocet_vypisu){
					$listujVpred .= (' <a  class="btn btn-success" 
					role="button" href="'.$stranka_url.'&listuj=' . ($_GET["listuj"] + 1) . '">listuj vpřed</a> <a  class="btn btn-success" role="button"href="' . $stranka_url .'&listuj='. $konecListovani. '">na konec listováni</a></p>');
					
				}
				if ($this->cti_od_radku >= 1){
					$listujVzad .= (' <p><a  class="btn btn-success" role="button"href="' . $stranka_url . '">na zažátek listováni</a> <a  class="btn btn-success" 
					role="button" href="'.$stranka_url.'&listuj=' . ($_GET["listuj"] - 1) . '">listuj vzad</a>  ');
			    }
			
			}
			else{
				$listujVpred = (' <a  class="btn btn-success" style="color: red"
				role="button" href="'.$stranka_url.'&listuj=' . ($_GET["listuj"] = 1) . '">listuj vpřed</a></p>');
                $this->str = 1;
				 
                throw new Exception('<br><i>došlo k chybě</i><br><b>listováni je nastaveno na výchozi hodnotu </b><br>'. $listujVzad .''. $listujVpred .''); 
			}
		} 
		else{
             $this->str = 1;
			 $listujVpred ='';
		     $listujVzad = '';
			    $listujVpred .= (' <a  class="btn btn-success" 
				role="button" href="'.$stranka_url.'&listuj=' . ($_GET["listuj"] = 1) . '">listuj vpřed </a></p>');
		}
         
			return ''. $listujVzad .''. $listujVpred .''; 
	
		 

	}

   public function vratOdRadku (){
	return $this->cti_od_radku;
	//return $this->str-1;
   }
   public function vratKolikRadku (){
	return $this->pocet_vypisu;
   }
   public function vratInfo (){

	//$oddo = ''. (($this->vratOdRadku()+1) * ($this->vratKolikRadku())-$this->vratKolikRadku()) . ' - '.  (($this->vratOdRadku()+1) * ($this>vratKolikRadku()))   .'';

	$oddo = ''. $this->str * $this->vratKolikRadku()-$this->vratKolikRadku() .'-'.$this->str * $this->vratKolikRadku().'';

	
	return ' '.$this->pocet_zaznamu. ' | stránka - '.$this->str.' | vypsáno max. záznamů - '.$this->pocet_vypisu.' | záznam : ['.$oddo.']';
   }
}