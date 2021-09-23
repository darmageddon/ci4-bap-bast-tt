<?php
namespace App\Libraries;

use Carbon\Carbon;

class CustomDate {

    public $date = null;
    public $date_string;

    public function __construct($date_string, $monthFirst = true) {
        $this->date_string = $date_string;
        if (preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $date_string)) {
            $format = $monthFirst ? 'n/j/Y' : 'd/m/Y';
            $this->date = Carbon::createFromFormat($format, $date_string)->locale('id');
        } elseif (preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $date_string)) {
            $this->date = Carbon::createFromFormat('Y-m-d', $date_string)->locale('id');
        } else {
            $this->date = Carbon::createFromFormat('Y-m-d', '1900-01-01')->locale('id');
        }
    }

    public function format($value = 'Y-m-d') {
        return $this->date->format($value);
    }

    public function getDate() {
        return $this->date->day . ' ' . $this->date->monthName . ' ' . $this->date->year;
    }

    public function getDay() {
        return ucwords($this->date->dayName);
    }

    public function getMonthString() {
        return ucwords($this->date->monthName);
    }

    public function getDayString() {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        return ucwords($formatter->format($this->date->day));
    }

    public function getYearString() {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        return ucwords($formatter->format($this->date->year));
    }

    public function getDateString() {
        return $this->getDayString() . " "
            . $this-> getMonthString() . " "
            . $this->getYearString();
    }

    public static function getMonthName($index) {
        $i = $index - 1;
        $data = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];
        if ($i < 0) {
            return $data[0];
        }
        if ($i > 11) {
            return $data[11];
        }
        return $data[$i];
    }

}
