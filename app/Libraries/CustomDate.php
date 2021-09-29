<?php
namespace App\Libraries;

use Carbon\Carbon;

class CustomDate {

    public $date = null;
    public $date_string;

    public static function create($date_string, $monthFirst = true) {
        $format = 'Y-m-d';
        if (preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $date_string)) {
            $format = $monthFirst ? 'n/j/Y' : 'd/m/Y';
        } elseif (preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $date_string)) {
        } else {
            $date_string = '1900-01-01';
        }
        $customDate = new self();
        $customDate->date_string = $date_string;
        $customDate->date = Carbon::createFromFormat($format, $date_string)->locale('id');
        return $customDate;
    }

    public static function withFormat($date_string, $formatString = 'Y-m-d', $monthFirst = true) {
        $customDate = self::create($date_string, $monthFirst);
        return $customDate->format($formatString);
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
