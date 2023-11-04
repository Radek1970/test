<?php

/**
 * opatřeni proti spamu
 */

class RVS_captcha_rok
{
    /**
	 * Výpis frmularoveho 
	 * pole
	 * @return void
	 */

	public function vypis()
	{
		
		return ('<label>*Zadejte aktuální rok (antispam)</label><br><input type="text" class="input-group border border-primary" name="overeni" /><br>');
	}

	/**
	 * Metoda pro ověření
	 * @return string True prazdny retezec pokud je 
	 * overeni ok, jinak false vypise hlasku
	 */
    
	public function over(): string
	{
		if(trim($_POST['overeni']) == ''){

			return"antispam musi být vyplněný";
			
		}
	
		else if ($_POST['overeni'] != date('Y')){ 
			return 'antispam španě zadaná hodnota';
			
		}
        else{
			return '';
		}


	}

}