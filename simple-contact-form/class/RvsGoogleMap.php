<?php

class RvsGoogleMap
{
    private $encodedAddress;

    // Konstruktor pro inicializaci adresy
    public function __construct($address)
    {
        // Zakóduj adresu pro použití v URL
        $this->encodedAddress = urlencode($address);
    }

    // Funkce pro generování Google Maps src URL
    public function generateGoogleMapSrc()
    {
        // Vytvoř URL pro veřejné Google Maps zobrazení
        return "https://www.google.com/maps?q=" . $this->encodedAddress . "&output=embed";
    }
}
