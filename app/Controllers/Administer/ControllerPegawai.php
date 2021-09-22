<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelPegawai;

class ControllerPegawai extends BaseController
{
    
    public function getAllPegawai() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pgw_id,
                    "nama" => $item->pgw_nama,
                    "nip" => $item->pgw_nip,
                    "jabatan" => $item->pgw_jabatan,
                ];
            },
            (new ModelPegawai())->getRecords()
        );

        echo view('Includes/Header');
        echo view('Pages/Pegawai', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

}
