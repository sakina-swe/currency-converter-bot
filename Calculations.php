<?php

require 'DB.php';

class Calculations{

    const CB_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    private GuzzleHttp\Client $http;


    public function __construct()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => self::CB_URL]);
    }

    public function getRates()
    {
        return json_decode($this->http->get('')->getBody()->getContents());
    }

    public function getUsd()
    {
        return $this->getRates()[0];
    }



    public function convert(
        string $originalCurrency,
        string $targetCurrency,
        float  $amount
    ) {
        $rate   = $this->getUsd()->Rate;

        if ($originalCurrency === 'usd') {
            $result = $amount * $rate;
        } else {
            $result = $amount / $rate;
        }

        $result = number_format($result, 0, '', '.');

        return $result." $targetCurrency";
    }
}
