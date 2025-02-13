<?php
/**
 * Rozhrani - interface
 */
interface Captcha
{

	/**
	 * Výpis formularoveho 
	 * pole
	 * @return string
	 */
	public function vypis(): string;

	/**
	 * Metoda pro ověření
	 * @return string True prazdny retezec pokud je 
	 * overeni ok, jinak false vypise hlasku
	 */
	public function over(): string;



}
