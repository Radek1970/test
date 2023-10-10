<?php

interface Captcha
{

	/**
	 * Výpis frmularoveho 
	 * pole
	 * @return void
	 */
	public function vypis(): void;

	/**
	 * Metoda pro ověření
	 * @return string True prazdny retezec pokud je 
	 * overeni ok, jinak false vypise hlasku
	 */
	public function over(): string;



}
