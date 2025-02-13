<?php

/**
 * opatřeni proti spamu
 */

class CaptchaRok implements Captcha
{
    /**
	 * Výpis frmularoveho 
	 * pole
	 * @return string
	 */

	public function vypis(): string
	{
		return '<p>*Zadejte aktuální rok (antispam)</p><input type="text" name="overeni" /><br>';
	}

	/**
	 * Metoda pro ověření
	 * @return string True prazdny retezec pokud je 
	 * overeni ok, jinak false vypise hlasku
	 */
    
	public function over(): string
	{
		if(trim($_POST['overeni']) == ''){

			return 'ANTISPAM  musi být vyplněný';
			
		}
	
		else if ($_POST['overeni'] != date('Y')){ 
			return 'ANTISPAM španě zadaná hodnota';
			
		}
        else{
			return '';
		}


	}

}
