<?php


/**
 * rozhraní implementovane v objednávce
 */
interface RozhraniObjednavky
{

	function vratIdUzivatel(): int;

	function vratIdproduktu(): int;

	function vratNazev(): string;

	function vratCastka(): int;

	function vratPredmet(): string;

	function vratOddata(): string;

	function vratDodata(): string;


} 