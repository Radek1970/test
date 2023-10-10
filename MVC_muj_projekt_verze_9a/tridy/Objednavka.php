<?php


/**
 * objednávku produktu, která je implementována podle rozhraní 
 */
class Objednavka implements RozhraniObjednavky
{

	/**
	 * @var int Jméno zákazníka
	 */
	private int $idUzivatel;
	/**
	 * @var int id produktu
	 */
	private int $idProduktu;
	/**
	 * @var string nazev
	 */
	private string $nazev;
    /**
	 * @var int castka
	 */
	private int $castka;
    /**
	 * @var string predmet
	 */
	private string $predmet;
    /**
	 * @var string od data
	 */
	private string $oddata;
    /**
	 * @var string od data
	 */
	private string $dodata;




	/**
	 * Nastaví id uzivatele
	 * @param int iduzivatele
	 * @return void
	 */
	public function nastavIdUzivatel(int $idUzivatel): void
	{
		$this->idUzivatel = $idUzivatel;
	}

	/**
	 * nastavi id produktu
	 * @param int Iproduktu
	 */
	public function nastavIdproduktu(int $idProduktu): void
	{
		$this->idProduktu = $idProduktu;
	}          

	/**
	 * nastavi nazev
	 * @param string nazev
	 */
	public function nastavNazev(string $nazev): void
	{
		$this->nazev = $nazev;
	}
    
	/**
	 * nastavi castka
	 * @param int castka
	 */
	public function nastavCastka(int $castka): void
	{
		$this->castka = $castka;
	} 

    /**
	 * nastavi predmet
	 * @param string predmet
	 */
	public function nastavPredmet(string $predmet): void
	{
		$this->predmet = $predmet;
	}


    /**
	 * Nastaví oddata
	 * @param string oddata
	 * @return void
	 */
	public function nastavOddata(string $oddata): void
	{
		$this->oddata = $oddata;
	}

    /**
	 * Nastaví dodata
	 * @param string dodata
	 * @return void
	 */
	public function nastavDodata(string $dodata): void
	{
		$this->dodata = $dodata;
	}



	/* =================== */

	/**
	 * Vrátí iduzivatel
	 * @return int iduzivatele
	 */
	public function vratIdUzivatel(): int
	{
		return $this->idUzivatel;
	}
	/**
	 * Vrátí idproduktu
	 * @return int idproduktu
	 */
	public function vratIdproduktu(): int
	{
		return $this->idProduktu;
	}

	/**
	 * Vrátí nazev
	 * @return string nazev
	 */
	public function vratNazev(): string
	{
		return $this->nazev;
	}
	
	/**
	 * Vrátí castka
	 * @return int castka
	 */
	public function vratCastka(): int
	{
		return $this->castka;
	}
    
	/**
	 * Vrátí predmet
	 * @return string predmet
	 */
	public function vratPredmet(): string
	{
		return $this->predmet;
	}
  
	/**
	 * Vrátí oddata
	 * @return string oddata
	 */
	public function vratOddata(): string
	{
		return $this->oddata;
	}

    /**
	 * Vrátí dodata
	 * @return string dodata
	 */
	public function vratDOdata(): string
	{
		return $this->dodata;
	}



}