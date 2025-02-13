<?php

/**
 * třída pro editaci nebo vytvoření nového
 * záznamu v tabulce
 * 
 */
class TabAdmin
{

     /**
	   * Načte záznam podle jeho ID z tabulky SEZNAM
	   * @param int $_POST['id'] $id z tabulky seznam, který chceme načíst
	   * @return string vypiše formulař pro vložení noveho záznamu nebo editaci 
     * stavajícího záznamu
     * empty $id je prazdné - vytvoříme nové vložením nového záznamu
     * !empty $id není prázdn - načteme záznam z DB podle poslaného id
     * a editujeme záznam
     * 
	   */
	public function tabSeznamFormular(): string
	{
        //echo $_POST['id'];
        $form = '';
        
        /**
         * když $id není prázdné načteme další položky
         * pro editaci z DB v opačném případě je formulář prázdný
         * pro vložení nového záznamu a  položky dále prenášíme v POST
         * 
         */
        if (!empty($_POST['id'])) {
            $zaznam = Db::queryOne('SELECT * FROM seznam WHERE id=?', $_POST['id']  );

            $info = 'Edituj uložený záznam s ID - '. $zaznam['id'];
            $bt = 'Vložit upravený záznam';
            if (isset($_POST['edit'])) {
               
                $id = htmlspecialchars($zaznam['id']);
                $medium = (isset($zaznam['skupina'])) ? $zaznam['skupina'] : '';
                $zanr = htmlspecialchars($zaznam['zanr']);
                $nazev = htmlspecialchars($zaznam['nazev']);
                $autor = htmlspecialchars($zaznam['autor']);
                $rok = htmlspecialchars($zaznam['rok']);
                $popis = htmlspecialchars($zaznam['popis']);
                $stav = htmlspecialchars($zaznam['stav']);
            } 
            else{ 

                $id = (isset($_POST['id'])) ? $_POST['id'] : '';
                $medium = (isset($_POST['medium'])) ? $_POST['medium'] : '';
                $zanr = (isset($_POST['zanr'])) ? $_POST['zanr'] : '';
                $nazev = (isset($_POST['nazev'])) ? $_POST['nazev'] : '';
                $autor = (isset($_POST['autor'])) ? $_POST['autor'] : '';
                $rok = (isset($_POST['rok'])) ? $_POST['rok'] : '';
                $popis = (isset($_POST['popis'])) ? $_POST['popis'] : '';
                $stav = (isset($_POST['stav'])) ? $_POST['stav'] : '';
            }   


        } else {
            $info = 'Vlož nový záznam'; 
            $bt = 'Vložit nový záznam';   
            $id = (isset($_POST['id'])) ? $_POST['id'] : '';
            $medium = (isset($_POST['medium'])) ? $_POST['medium'] : '';
            $zanr = (isset($_POST['zanr'])) ? $_POST['zanr'] : '';
            $nazev = (isset($_POST['nazev'])) ? $_POST['nazev'] : '';
            $autor = (isset($_POST['autor'])) ? $_POST['autor'] : '';
            $rok = (isset($_POST['rok'])) ? $_POST['rok'] : '';
            $popis = (isset($_POST['popis'])) ? $_POST['popis'] : '';
            $stav = (isset($_POST['stav'])) ? $_POST['stav'] : '';
		}





        // =========== začátek formulaře =======
        $form .= '<h3>'.$info.'</h3>';
        $form .= '<div class=" row border ">';
        
        $form .= '<div class=" row ">';
        $form .= '<div class=" col-6 ">';
        $form .= '<form method="post">';
        $form .= '<input type="hidden" name="id" value="'.$id.'" />';
        
        
        $form .= '<p>*formát:</p>'; 
        $form .= '<select name="medium" >';
        if(!empty($medium)){
          $form .= '<option value="'.$medium.'">'.$medium.'</option>';
        }
        else{
          $form .= '<option value="">VYBER formát</option>';
        }
        $form .= '<option value="CD">CD</option>';
        $form .= '<option value="DVD">DVD</option>';
        $form .= '<option value="KNIHY">KNINY</option>';
        $form .= '</select><br>';
    
        $form .= '</div>';
        $form .= '</div>';
    

    

    
        $form .= '<div class=" row ">';
        $form .= '<div class=" col-12 col-md-4">'; 
        $form .= '<p>*žánr:</p>'; 
         $form .= '<input type="text" name="zanr" value="'.$zanr.'" />';
        $form .= '</div>';
        $form .= '<div class=" col-12 col-md-4 ">'; 
        $form .= '<p>*název:</p>'; 
        $form .= '<input type="text" name="nazev" value="'.$nazev.'" /> ';
        $form .= '</div>';
        $form .= '<div class=" col-12 col-md-4 ">'; 
        $form .= '<p>*autor:</p>'; 
        $form .= '<input type="text" name="autor" value="'. $autor.'" />';
        $form .= '</div>';
        $form .= '</div>';
    
        $form .= '<div class=" row ">';
        $form .= '<div class=" col-12 col-md-4">'; 
        $form .= '<p>*rok:</p>'; 
        $form .= '<input type="text" name="rok" value="'. $rok.'" />';
        $form .= '</div>';
        $form .= '<div class=" col-12 col-md-4">'; 
        $form .= '<p>stav:</p>'; 
        $form .= '<input type="text" name="stav" value="'. $stav.'" />';
        $form .= '</div>';
        $form .= '<div class=" col-12 col-md-4">'; 
        $form .= '<p>popis:</p>'; 
        $form .= '<textarea  name="popis" rows="2" cols="30"  maxlength="200">'. $popis .'</textarea>';
        $form .= '</div>';
        $form .= '</div>';
    

        $form .= '<div class=" col-12 col-md-4">'; 
        $form .= ''; 
        // funkce na ochranu proti spamu
        $spamOchrana = new CaptchaRok();
        $form .= $spamOchrana->vypis();
        $form .= '<br>';
        $form .= '</div>';


        $form .= '<div class=" row ">';
        $form .= '<div class=" col-6 ">'; 
        $form .= '<input  class="btn btn-primary" type="submit" name="vlozeni" value="'.$bt.'" />';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div><br><br>';
    
    
    
    
    
        $form .= '</div><br><br>';
        // =========== konec formulaře =======

        return $form;
    }


    public function tabSeznamZpracuj()
	{

        /**
         * trim odstranění bílých znaků (mezery, tabulátory, nové řádky) z začátku a konce řetězce.
         * trim(string $str, string $characters = " \t\n\r\0\x0B")
         * Volitelný parametr specifikující vlastní seznam znaků, 
         * které mají být odstraněny. Pokud není uveden, odstraní všechny bílé znaky.
         * Dále validujem položky odesláné z formuláře před uložením do DB
         * Validace dle nastavených parametrů
        */

        /* === validace === */
        if (isset($_POST['vlozeni']))    {
          $zprava = '';

         $spamOchrana = new CaptchaRok();
         $zprava .= $spamOchrana->over();

		  /* === 1 === */
		  if (trim($_POST['medium']) == '') {

			$zprava .= "FORMÁT musí být vyplněno <br>";
		  }
          /* === 2 === */
          if (trim($_POST['zanr']) == '') {

			$zprava .= "ŽÁNR musí být vyplněn <br>";
		  }
          /* === 3 === */
          if (trim($_POST['nazev']) == '') {

			$zprava .= "NÁZEV musí být vyplněn <br>";
		  }
          /* === 4 === */
          if (trim($_POST['autor']) == '') {

			$zprava .= "AUTOR musí být vyplněn <br>";
		  }
          /* === 5 === */
          if (trim($_POST['rok']) == '') {

			$zprava .= "ROK musí být vyplněn <br>";
		  }
          elseif(!is_numeric($_POST['rok'])){
            
			$zprava .= "ROK musí být číslo <br>";
          }
          if(strlen((string)$_POST['rok']) === 4){
            $zprava .= "";
          }
          else{$zprava .= "ROK musí mít 4 čísla <br>";}
          /* === 6 === */
          if(!empty($_POST['popis'])){
            $pocetZnaku = 200;
            if(mb_strlen( htmlspecialchars($_POST['popis'])) > $pocetZnaku ){
                $zprava .= "POPIS musí mít max ".$pocetZnaku." znaků <br>";
            }

          }
          /* === 7 === */
          if(!empty($_POST['stav'])){
            $pocetZnaku = 20;
            if(mb_strlen( htmlspecialchars($_POST['stav'])) > $pocetZnaku ){
                $zprava .= "POPIS musí mít max ".$pocetZnaku." znaků <br>";
            }
          }
          /* ========konec validace=========== */

         
          /* === zpracováni dat === */
          if (empty($zprava)) {

            if (!empty($_POST['id'])) {
               
              /**
               * DB dotaz pro Update záznamu
               */
              if(empty($_POST['stav'])){$statut = 1;}
              else{$statut = 2;}
              Db::query('UPDATE seznam SET skupina=?, zanr=?, nazev=?, autor=?, rok=?, popis=?, stav=?, statut=? WHERE id=?', trim($_POST['medium']), trim($_POST['zanr']), trim($_POST['nazev']), trim($_POST['autor']), trim($_POST['rok']), trim($_POST['popis']), trim($_POST['stav']), $statut, trim($_POST['id']) );
	

             /**
             * vynulujeme hodnoty 
             * ve formulari
             */
            $_POST['id'] ="";
            $_POST['medium']="";
            $_POST['zanr']="";
            $_POST['nazev']="";
            $_POST['autor']="";
            $_POST['rok']="";
            $_POST['popis']="";
            $_POST['stav']="";

                return ('<br><div class="alert alert-danger"><strong>INFO!</strong><br> ZÁZNAM BYL EDITOVÁN</div>');    
            }

            if (empty($_POST['id'])) {
              /**
               * DB dotaz pro Vloženi nového záznamu
               */
                if(empty($_POST['stav'])){$statut = 1;}
                else{$statut = 2;}
                Db::query('INSERT INTO seznam (skupina, zanr, nazev, autor, rok, popis, stav, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', trim($_POST['medium']), trim($_POST['zanr']), trim($_POST['nazev']), trim($_POST['autor']), trim($_POST['rok']), trim($_POST['popis']), trim($_POST['stav']), $statut);
                
             /**
             * vynulujeme hodnoty 
             * ve formulari
             */
            $_POST['id'] ="";
            $_POST['medium']="";
            $_POST['zanr']="";
            $_POST['nazev']="";
            $_POST['autor']="";
            $_POST['rok']="";
            $_POST['popis']="";
            $_POST['stav']="";
                return ('<br><div class="alert alert-danger"><strong>INFO!</strong><br> ZÁZNAM BYL VYTVOŘEN</div>'); 
            }



        
		  } else {
          return ('<br><div class="alert alert-danger"><strong>Pozor!</strong><br>' . $zprava . '.</div>');
		  }

        }

    }

    
    public function tabSeznamDeletPolozku()
    {   /**
      * DB dotaz pro Vymazání záznamu dle $id
      */
        if (isset($_POST['delet'])) {
            Db::query('DELETE FROM seznam WHERE id=?', $_POST['id']);
            return '<div class="alert alert-danger"><h3>Záznam s ID'.  $_POST['id'] .' byl vymazán !</h3></div>';

        }
    }


}