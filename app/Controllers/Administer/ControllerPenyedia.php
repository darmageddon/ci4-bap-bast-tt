<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelPenyedia;

class ControllerPenyedia extends BaseController
{
    
    public function getAllPenyedia() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pyd_id,
                    "nama" => $item->pyd_nama,
                    "alamat" => $item->pyd_alamat,
                    "pemilik" => $item->pyd_pemilik,
                ];
            },
            (new ModelPenyedia())->getRecords()
        );

        echo view('Includes/Header');
        echo view('Pages/Penyedia', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

}
