<?php

class InfoText {


    const PRIHL = "Jste přihlašený !!!";
    const NEPRIHL = "nejste přihlášen !!!";

    public function prihlaseny(): void
	{
		echo('info: '. self::PRIHL);
	}

	public function neprihlaseny(): void
	{
		echo('info: '. self::NEPRIHL);
	}

}