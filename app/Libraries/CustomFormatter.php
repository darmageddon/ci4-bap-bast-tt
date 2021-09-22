<?php
namespace App\Libraries;

class CustomFormatter {

    public static function getNumberString($number, $firstWordOnly = true) {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        if ($firstWordOnly)
            return ucfirst($formatter->format($number));
        return ucwords($formatter->format($number));
    }

    public static function getCurrency($number) {
        return number_format($number, 0, ",", ".");
    }

}
