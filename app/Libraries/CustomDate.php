<?php
namespace App\Libraries;

use Carbon\Carbon;

class CustomDate {

    public $date = null;
    public $date_string;

    public function __construct($date_string) {
        $this->date_string = $date_string;
        if (preg_match('/\d{1,2}\/\d{1,2}\/\d{4}/', $date_string)) {
            $this->date = Carbon::createFromFormat('n/j/Y', $date_string)->locale('id');
        } elseif (preg_match('/\d{4}-\d{1,2}-\d{1,2}/', $date_string)) {
            $this->date = Carbon::createFromFormat('Y-m-d', $date_string)->locale('id');
        }
    }

    public function format($value = 'Y-m-d') {
        if ($this->date !== null) {
            return $this->date->format($value);
        }
        return null;
    }

    public function getDate() {
        if (!is_null($this->date)) {
            return $this->date->day . ' ' . $this->date->monthName . ' ' . $this->date->year;
        }
        return '1 Januari 1900';
    }

    public function getDay() {
        if (!is_null($this->date)) {
            return ucwords($this->date->dayName);
        }
    }

    public function getMonthString() {
        if (!is_null($this->date)) {
            return ucwords($this->date->monthName);
        }
        return "Januari";
    }

    public function getDayString() {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        if (!is_null($this->date)) {
            return ucwords($formatter->format($this->date->day));
        }
        return "Satu";
    }

    public function getYearString() {
        $formatter = new \NumberFormatter("id_ID", \NumberFormatter::SPELLOUT);
        if (!is_null($this->date)) {
            return ucwords($formatter->format($this->date->year));
        }
        return ucwords($formatter->format(1900));
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
