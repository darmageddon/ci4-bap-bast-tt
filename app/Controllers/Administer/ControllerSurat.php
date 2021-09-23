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
use App\Libraries\PdfStream;

class ControllerSurat extends BaseController
{   
    public function getDownloadBAP($kgid) {
        $modelKegiatan = new ModelKegiatan();
        if (null !== $item = $modelKegiatan->getRecord($kgid)) {
            $title = $this->getRandomName('bap', $kgid);

			$html = view('Templates/Header', [
                'title' => $title,
				'margin' => '7mm 18mm 7mm 17mm',
			]);
			$html .= view('Templates/Bap', $this->getRecordKegiatan($item));

            $this->response->setHeader('Content-Type', 'application/pdf');
			$pdf = new PdfStream();
			$pdf->stream($html, $title);
		}
    }

    public function getDownloadLampiranBAP($kgid) {
        $modelKegiatan = new ModelKegiatan();
        $modelBarang = new ModelBarang();
        if (null !== $item = $modelKegiatan->getRecord($kgid)) {
            $title = $this->getRandomName('lampiran_bap', $kgid);
            $barang = $this->getRecordBarang($modelBarang->getRecords($kgid));

			$html = view('Templates/Header', [
                'title' => $title,
				'margin' => '7mm 12mm 7mm 11mm',
			]);
			$html .= view('Templates/LampiranBap', $this->getRecordKegiatan($item, $barang));

            $this->response->setHeader('Content-Type', 'application/pdf');
			$pdf = new PdfStream();
			$pdf->stream($html, $title);
		}
    }

    public function getDownloadBAST($kgid) {
        $modelKegiatan = new ModelKegiatan();
        if (null !== $item = $modelKegiatan->getRecord($kgid)) {
            $title = $this->getRandomName('bast', $kgid);

			$html = view('Templates/Header', [
                'title' => $title,
				'margin' => '7mm 18mm 7mm 17mm',
			]);
			$html .= view('Templates/Bast', $this->getRecordKegiatan($item));

            $this->response->setHeader('Content-Type', 'application/pdf');
			$pdf = new PdfStream();
			$pdf->stream($html, $title);
		}
    }

    public function getDownloadLampiranBAST($kgid) {
        $modelKegiatan = new ModelKegiatan();
        $modelBarang = new ModelBarang();
        if (null !== $item = $modelKegiatan->getRecord($kgid)) {
            $title = $this->getRandomName('lampiran_bast', $kgid);
            $barang = $this->getRecordBarang($modelBarang->getRecords($kgid));

			$html = view('Templates/Header', [
                'title' => $title,
				'margin' => '7mm 12mm 7mm 11mm',
			]);
			$html .= view('Templates/LampiranBast', $this->getRecordKegiatan($item, $barang));

            $this->response->setHeader('Content-Type', 'application/pdf');
			$pdf = new PdfStream();
			$pdf->stream($html, $title);
		}
    }

    public function getDownloadTT($kgid) {
        $modelKegiatan = new ModelKegiatan();
        $modelBarang = new ModelBarang();
        if (null !== $item = $modelKegiatan->getRecord($kgid)) {
            $title = $this->getRandomName('lampiran_bast', $kgid);
            $barang = $this->getRecordBarang($modelBarang->getRecords($kgid));

			$html = view('Templates/Header', [
                'title' => $title,
				'margin' => '7mm 12mm 7mm 11mm',
			]);
			$html .= view('Templates/TandaTerima', $this->getRecordKegiatan($item, $barang));

            $this->response->setHeader('Content-Type', 'application/pdf');
			$pdf = new PdfStream();
			$pdf->stream($html, $title);
		}
    }

    private function getRecordKegiatan($item, $barang = []) {
        $total = 0;
        foreach ($barang as $b) {
            $total += $b->total->value;
        }

        return [
            "paket" => $item->kg_paket,
            "prodi" => $item->kg_prodi,
            "kwitansi" => (object) [
                "number" => CustomFormatter::getCurrency($item->kg_nilai_kwitansi, false),
                "text" => CustomFormatter::getNumberString($item->kg_nilai_kwitansi),
            ],
            "penyedia" => (object) [
                "nama" => $item->pyd_nama,
                "alamat" => $item->pyd_alamat,
                "pemilik" => $item->pyd_pemilik,
                "jabatan" => $item->pyd_jabatan,
            ],
            "unit" => (object) [
                "nama" => $item->unit_nama,
                "nip" => $item->unit_nip,
                "jabatan" => $item->unit_jabatan,
            ],
            "kaprodi" => (object) [
                "nama" => $item->kaprodi_nama,
                "nip" => $item->kaprodi_nip,
                "jabatan" => $item->kaprodi_jabatan,
            ],
            "sp" => (object) [
                "nomor" => $item->sp_nomor,
                "tanggal" => new CustomDate($item->sp_tanggal),
            ],
            "bap" => (object) [
                "nomor" => $item->bap_nomor,
                "tanggal" => new CustomDate($item->bap_tanggal),
            ],
            "bast" => (object) [
                "nomor" => $item->bast_nomor,
                "tanggal" => new CustomDate($item->bast_tanggal),
            ],
            "tt" => (object) [
                "tanggal" => new CustomDate($item->tt_tanggal),
            ],
            "barang" => (object) [
                "items" => $barang,
                "total" => (object) [
                    "value" => $total,
                    "number" => CustomFormatter::getCurrency($total, false),
                    "text" => CustomFormatter::getNumberString($total),
                ]
            ]
        ];
    }

    private function getRecordBarang($items) {
        $nomor = 0;
        return array_map(
            function ($item) use ($nomor) {
                $nomor++;
                return (object) [
                    "nomor" => $nomor,
                    "nama" => $item->brg_nama,
                    "spesifikasi" => $item->brg_spesifikasi,
                    "kategori" => $item->brg_kategori,
                    "jumlah" => $item->brg_jumlah,
                    "satuan" => $item->brg_satuan,
                    "harga" => (object) [
                        "value" => $item->brg_harga,
                        "number" => CustomFormatter::getCurrency($item->brg_harga, false),
                        "text" => CustomFormatter::getNumberString($item->brg_harga),
                    ],
                    "keterangan" => $item->brg_keterangan,
                    "total" => (object) [
                        "value" => $item->brg_harga_total,
                        "number" => CustomFormatter::getCurrency($item->brg_harga_total, false),
                        "text" => CustomFormatter::getNumberString($item->brg_harga_total),
                    ],
                ];
            }, $items
        );
    }

    private function getRandomName($type, $kgid) {
		return $type . '_'  . $kgid . '_' .time() . '_'  . bin2hex(random_bytes(16)) . '.pdf';
	}
}
