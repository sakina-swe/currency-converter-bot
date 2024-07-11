<?php

class Calculations{
    public function exchange($text)
    {
        $exp = explode('-', $text);
        $cb_url = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/$exp[1]/";
        $rate = json_decode(file_get_contents($cb_url), true);
        return $exp[0] / $rate[0]['Rate'];
    }
}