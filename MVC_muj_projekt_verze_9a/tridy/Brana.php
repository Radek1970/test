<?php

class Brana
{

	/**
	 * Simuluje zpracování objednávky platební bránou, v našem případě jen data vypíše do tabulky
	 * @param RozhraniObjednavky $objednavka Instance objednávky podle jejího rozhraní
	 * @return void
	 */
	public function zpracuj(RozhraniObjednavky $objednavka): void
	{
		echo('

		<div class="card mb-4">
		<div class="card-header">Rekapitulace</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12 btn-group ">
                  <h4>' . htmlspecialchars($objednavka->vratNazev()) . '</h4>
                  <br>
					<ul>
					<li> předmět: ' . htmlspecialchars($objednavka->vratPredmet()) . '</li>
					<li> částka: ' . htmlspecialchars($objednavka->vratCastka()) . ' kč</li>
					<li> od data: ' . htmlspecialchars($objednavka->vratOddata()) . '</li>
					<li> do data: ' . htmlspecialchars($objednavka->vratDodata()) . '</li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>






			
		');
	}
}