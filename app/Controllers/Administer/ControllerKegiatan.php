<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Libraries\CustomDate;
use App\Libraries\CustomFormatter;

class ControllerKegiatan extends BaseController
{
    
    public function getAllKegiatan() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->kg_id,
                    "paket" => $item->kg_paket,
                    "bulan" => CustomDate::getMonthName($item->kg_bulan),
                    "kwitansi" => CustomFormatter::getCurrency($item-> kg_nilai_kwitansi)
                ];
            },
            (new ModelKegiatan())->getRecords()
        );

        echo view('Includes/Header');
        echo view('Pages/Dashboard', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

}
