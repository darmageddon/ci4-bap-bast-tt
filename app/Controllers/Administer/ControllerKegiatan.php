<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelPenyedia;
use App\Models\ModelPegawai;
use App\Models\ModelSurat;
use App\Models\ModelBarang;
use App\Libraries\CustomDate;
use App\Libraries\CustomFormatter;

class ControllerKegiatan extends BaseController
{   
    public function getPageAllKegiatan() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->kg_id,
                    "paket" => $item->kg_paket,
                    "bulan" => CustomDate::getMonthName($item->kg_bulan),
                    "kwitansi" => CustomFormatter::getCurrency($item->kg_nilai_kwitansi)
                ];
            },
            (new ModelKegiatan())->getRecords()
        );

        echo view('Includes/Header', [
            "isPageDashboard" => true,
        ]);
        echo view('Pages/Dashboard', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

    public function getPageKegiatan($id) {
        $model = new ModelKegiatan();
        if (null !== $item = $model->getRecord($id)) {
            $listPenyedia = array_map(
                function ($item) {
                    return (object) [
                        "id" => $item->pyd_id,
                        "nama" => $item->pyd_nama,
                    ];
                }, (new ModelPenyedia())->getRecords()
            );

            $listPegawai = array_map(
                function ($item) {
                    return (object) [
                        "id" => $item->pgw_id,
                        "nama" => $item->pgw_nama,
                    ];
                }, (new ModelPegawai())->getRecords()
            );

            $listBarang = array_map(
                function ($item) {
                    return (object) [
                        "id" => $item->brg_id,
                        "nama" => $item->brg_nama,
                        "spesifikasi" => $item->brg_spesifikasi,
                        "kategori" => $item->brg_kategori,
                        "jumlah" => $item->brg_jumlah,
                        "satuan" => $item->brg_satuan,
                        "harga" => CustomFormatter::getCurrency($item->brg_harga),
                        "keterangan" => $item->brg_keterangan,
                        "harga_total" => CustomFormatter::getCurrency($item->brg_harga_total),
                    ];
                }, (new ModelBarang())->getRecords($id)
            );

            echo view('Includes/Header', [
                "isPageDashboard" => true,
            ]);
            echo view('Pages/Kegiatan/View', [
                "listPenyedia" => $listPenyedia,
                "listPegawai" => $listPegawai,
                "listBarang" => $listBarang,

                "id" => $id,
                "bulan" => $this->getFlashdata('k_bulan', $item->kg_bulan),
                "kegiatan" => $this->getFlashdata('k_kegiatan', $item->kg_kegiatan),
                "paket" => $this->getFlashdata('k_paket', $item->kg_paket),
                "prodi" => $this->getFlashdata('k_prodi', $item->kg_prodi),
                "nilai_kwitansi" => $this->getFlashdata('k_nilai_kwitansi', $item->kg_nilai_kwitansi),
                "penyedia" => (object) [
                    "id" => $this->getFlashdata('k_penyedia', $item->kg_penyedia),
                ],
                "unit" => (object) [
                    "id" => $this->getFlashdata('k_unit', $item->kg_unit),
                ],
                "kaprodi" => (object) [
                    "id" => $this->getFlashdata('k_kaprodi', $item->kg_kaprodi),
                ],
                "bap" => (object) [
                    "nomor" => $this->getFlashdata('k_bap_nomor', $item->bap_nomor),
                    "tanggal" => $this->getFlashdata('k_bap_tanggal', (new CustomDate($item->bap_tanggal))->format('d/m/Y')),
                ],
                "bast" => (object) [
                    "nomor" => $this->getFlashdata('k_bast_nomor', $item->bast_nomor),
                    "tanggal" => $this->getFlashdata('k_bast_tanggal', (new CustomDate($item->bast_tanggal))->format('d/m/Y')),
                ],
                "sp" => (object) [
                    "nomor" => $this->getFlashdata('k_sp_nomor', $item->sp_nomor),
                    "tanggal" => $this->getFlashdata('k_sp_tanggal', (new CustomDate($item->sp_tanggal))->format('d/m/Y')),
                ],
                "tt" => (object) [
                    "tanggal" => $this->getFlashdata('k_tt_tanggal', (new CustomDate($item->tt_tanggal))->format('d/m/Y')),
                ],
                "errorMessage" => $this->getFlashdata('k_error'),
                "successMessage" => $this->getFlashdata('k_success'),
            ]);
            echo view('Includes/Footer');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPageAddKegiatan() {
        $listPenyedia = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pyd_id,
                    "nama" => $item->pyd_nama,
                ];
            }, (new ModelPenyedia())->getRecords()
        );

        $listPegawai = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pgw_id,
                    "nama" => $item->pgw_nama,
                ];
            }, (new ModelPegawai())->getRecords()
        );

        echo view('Includes/Header', [
            "isPageDashboard" => true,
        ]);
        echo view('Pages/Kegiatan/Add', [
            "listPenyedia" => $listPenyedia,
            "listPegawai" => $listPegawai,
            
            "bulan" => $this->getFlashdata('k_bulan'),
            "kegiatan" => $this->getFlashdata('k_kegiatan'),
            "paket" => $this->getFlashdata('k_paket'),
            "prodi" => $this->getFlashdata('k_prodi'),
            "nilai_kwitansi" => $this->getFlashdata('k_nilai_kwitansi'),
            "penyedia" => (object) [
                "id" => $this->getFlashdata('k_penyedia'),
            ],
            "unit" => (object) [
                "id" => $this->getFlashdata('k_unit'),
            ],
            "kaprodi" => (object) [
                "id" => $this->getFlashdata('k_kaprodi'),
            ],
            "bap" => (object) [
                "nomor" => $this->getFlashdata('k_bap_nomor'),
                "tanggal" => $this->getFlashdata('k_bap_tanggal'),
            ],
            "bast" => (object) [
                "nomor" => $this->getFlashdata('k_bast_nomor'),
                "tanggal" => $this->getFlashdata('k_bast_tanggal'),
            ],
            "sp" => (object) [
                "nomor" => $this->getFlashdata('k_sp_nomor'),
                "tanggal" => $this->getFlashdata('k_sp_tanggal'),
            ],
            "tt" => (object) [
                "tanggal" => $this->getFlashdata('k_tt_tanggal'),
            ],
            "errorMessage" => $this->getFlashdata('k_error'),
            "successMessage" => $this->getFlashdata('k_success'),
        ]);
        echo view('Includes/Footer');
    }

    public function processAddKegiatan() {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'kegiatan')) {
            $modelKegiatan = new ModelKegiatan();
            $modelSurat = new ModelSurat();

            $data_sp = [
                'nomor' => $data['sp_nomor'],
                'tanggal' => $data['sp_tanggal'],
            ];

            $data_bap = [
                'nomor' => $data['bap_nomor'],
                'tanggal' => $data['bap_tanggal'],
            ];

            $data_bast = [
                'nomor' => $data['bast_nomor'],
                'tanggal' => $data['bast_tanggal'],
            ];

            $data_tt = [
                'tanggal' => $data['tt_tanggal'],
            ];

            if (null !== $id = $modelKegiatan->insertRecord($data)) {
                if ($modelSurat->insertRecord($id, 'sp', $data_sp)
                        && $modelSurat->insertRecord($id, 'bap', $data_bap)
                        && $modelSurat->insertRecord($id, 'bast', $data_bast)
                        && $modelSurat->insertRecord($id, 'tt', $data_bast)
                        ) {
                    
                    return redirect()->to(base_url("/kegiatan/$id"));
                }
                return redirect()->to(base_url('/kegiatan'));
            }
            $this->setFlashdata('k_error', 'Gagal menambahkan Kegiatan.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('k_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('k_' . $key, $value);
        }

        return redirect()->to(base_url('/kegiatan/new'));
    }

    public function processActionKegiatan($id) {
        if (null !== $this->request->getPost('action_update')) {
            return $this->processUpdateKegiatan($id);
        } elseif (null !== $this->request->getPost('action_delete')) {
            return $this->processDeleteKegiatan($id);
        } else {
            return redirect()->to(base_url("/kegiatan/$id"));
        }
    }

    private function processUpdateKegiatan($id) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'kegiatan')) {
            $modelKegiatan = new ModelKegiatan();
            $modelSurat = new ModelSurat();

            $data_sp = [
                'nomor' => $data['sp_nomor'],
                'tanggal' => $data['sp_tanggal'],
            ];

            $data_bap = [
                'nomor' => $data['bap_nomor'],
                'tanggal' => $data['bap_tanggal'],
            ];

            $data_bast = [
                'nomor' => $data['bast_nomor'],
                'tanggal' => $data['bast_tanggal'],
            ];

            $data_tt = [
                'tanggal' => $data['tt_tanggal'],
            ];
            
            if ($modelKegiatan->updateRecord($id, $data)
                    && $modelSurat->updateRecord($id, 'sp', $data_sp)
                    && $modelSurat->updateRecord($id, 'bap', $data_bap)
                    && $modelSurat->updateRecord($id, 'bast', $data_bast)
                    && $modelSurat->updateRecord($id, 'tt', $data_bast)
                    ) {
                    
                $this->setFlashdata('k_success', 'Berhasil mengupdate Kegiatan.');
                return redirect()->to(base_url("/kegiatan/$id"));
            }
            $this->setFlashdata('k_error', 'Gagal mengupdate Kegiatan.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('k_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('k_' . $key, $value);
        }

        return redirect()->to(base_url("/kegiatan/$id"));
    }

    private function processDeleteKegiatan($id) {
        $modelKegiatan = new ModelKegiatan();
        $modelBarang = new ModelBarang();
        $modelSurat = new ModelSurat();
        
        $modelSurat->deleteNullRecord($id);
        $modelBarang->deleteNullRecord($id);
        if ($modelKegiatan->deleteRecord($id)) {
            return redirect()->to(base_url());
        }
        $this->setFlashdata('k_error', 'Gagal menghapus Kegiatan.');
        return redirect()->to(base_url("/kegiatan/$id"));
    }

}
