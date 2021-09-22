<?php
namespace App\Libraries;

class CustomFormatter {

    public static function getNumberString($number, $firstWordOnly = true) {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        if ($firstWordOnly)
            return ucfirst($formatter->format($number));
        return ucwords($formatter->format($number));
    }

    public static function getCurrency($number, $currency = true) {
        $currencyString = $currency ? 'Rp ' : '';
        $currencyString .= number_format($number, 0, ",", ".");
        $currencyString .= $currency ? ',00' : '';
        return $currencyString;
    }

}
