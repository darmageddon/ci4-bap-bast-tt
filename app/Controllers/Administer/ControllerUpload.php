<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelPenyedia;
use App\Models\ModelPegawai;
use App\Models\ModelKegiatan;
use App\Models\ModelSurat;
use App\Models\ModelBarang;
use App\Libraries\CustomDate;
use App\Libraries\XlsxReader;

class ControllerUpload extends BaseController
{
    public function getPageUpload() {
        echo view('Includes/Header', [
            "isPageUpload" => true,
        ]);
        echo view('Pages/Upload');
        echo view('Includes/Footer');
    }

    public function processUpload() {
		if (null !== $file = $this->request->getFile('xlsx')) {
            if ($file->isValid()) {
                $this->parseXlsx($file->getTempName());
				return redirect()->to(base_url());
			}
		}
		return redirect()->to(base_url('/upload'));
	}

	private function parseXlsx($filename) {
		$modelKegiatan = new ModelKegiatan();
		$modelPenyedia = new ModelPenyedia();
		$modelPegawai = new ModelPegawai();
		$modelSurat = new ModelSurat();
		$modelBarang = new ModelBarang();

		$modelBarang->emptyTable();
		$modelSurat->emptyTable();
		$modelKegiatan->emptyTable();
		$modelPenyedia->emptyTable();
		$modelPegawai->emptyTable();

        $cachePenyedia = [];
		$cachePegawai = [];
		
		$reader = new XlsxReader($filename);

		/*
		if (null !== $id = $modelPegawai->insertRecord([
				"nama" => "I Nyoman Sudiarta",
				"nip" => "196503152005011001",
				"jabatan" => "PPK Barang/Jasa pada Fakultas Pariwisata",
			])) {

			$cachePegawai["196503152005011001"] = $id;
		}
		*/
		
		foreach ($reader->read() as $item) {
			// Insert Penyedia
			$id_penyedia = null;
			if (empty($item->penyedia->nama)) {
				$item->penyedia->nama = "- Nama Penyedia -";
				$item->penyedia->alamat = "- Alamat Penyedia -";
				$item->penyedia->pemilik = "- Nama Pemilik -";
				$item->penyedia->jabatan = "- Jabatan Pemilik -";
			}
			if (isset($cachePenyedia[$item->penyedia->nama])) {
				$id_penyedia = $cachePenyedia[$item->penyedia->nama];
			} else {
				$id_penyedia = $modelPenyedia->insertRecord([
					"nama" => $item->penyedia->nama,
					"alamat" => $item->penyedia->alamat,
					"pemilik" => $item->penyedia->pemilik,
					"jabatan" => $item->penyedia->jabatan,
				]);
				$cachePenyedia[$item->penyedia->nama] = $id_penyedia;
			}

			// Insert Pegawai (Unit)
			$id_unit = null;
			if (empty($item->unit->nip)) {
				$item->unit->nip = "- NIP Kepala Unit -";
				$item->unit->nama = "- Nama Kepala Unit -";
				$item->unit->jabatan = "- Kepala Unit -";
			}
			if (isset($cachePegawai[$item->unit->nip])) {
				$id_unit = $cachePegawai[$item->unit->nip];
			} else {
				$id_unit = $modelPegawai->insertRecord([
					"nama" => $item->unit->nama,
					"nip" => $item->unit->nip,
					"jabatan" => $item->unit->jabatan,
				]);
				$cachePegawai[$item->unit->nip] = $id_unit;
			}

			// Insert or Update Pegawai (Kaprodi)
			$id_kaprodi = null;
			if (empty($item->kaprodi->nip)) {
				$item->kaprodi->nip = "- NIP Kaprodi -";
				$item->kaprodi->nama = "- Nama Kaprodi -";
				$item->kaprodi->jabatan = "- Kaprodi -";
			}
			if (isset($cachePegawai[$item->kaprodi->nip])) {
				$id_kaprodi = $cachePegawai[$item->kaprodi->nip];
			} else {
				$id_kaprodi = $modelPegawai->insertRecord([
					"nama" => $item->kaprodi->nama,
					"nip" => $item->kaprodi->nip,
					"jabatan" => $item->kaprodi->jabatan,
				]);
				$cachePegawai[$item->kaprodi->nip] = $id_kaprodi;
			}

			// Insert Kegiatan
			$id_kegiatan = $modelKegiatan->insertRecord([
				"bulan" => $item->bulan,
				"kegiatan" => $item->kegiatan,
				"paket" => $item->paket,
				"prodi" => $item->prodi,
				"nilai_kwitansi" => $item->nilai_kwitansi,
				"penyedia" => $id_penyedia,
				"unit" => $id_unit,
				"kaprodi" => $id_kaprodi,
			]);

			// Insert BAP
			$modelSurat->insertRecord($id_kegiatan, "bap", [
				"nomor" => $item->bap->nomor,
				"tanggal" => CustomDate::withFormat($item->bap->tanggal)
			]);

			// Insert BAST
			$modelSurat->insertRecord($id_kegiatan, "bast", [
				"nomor" => $item->bast->nomor,
				"tanggal" => CustomDate::withFormat($item->bast->tanggal)
			]);

			// Insert SP
			$modelSurat->insertRecord($id_kegiatan, "sp", [
				"nomor" => $item->sp->nomor,
				"tanggal" => CustomDate::withFormat($item->sp->tanggal)
			]);

			// Insert Tanda Terima
			$modelSurat->insertRecord($id_kegiatan, "tt", [
				"nomor" => $item->tt->nomor,
				"tanggal" => CustomDate::withFormat($item->tt->tanggal)
			]);

			foreach ($item->barang as $barang) {
				$modelBarang->insertRecord($id_kegiatan, [
					"nama" => $barang->nama,
					"spesifikasi" => $barang->spesifikasi,
					"kategori" => $barang->kategori,
					"jumlah" => $barang->jumlah,
					"satuan" => $barang->satuan,
					"harga" => $barang->harga,
					"keterangan" => $barang->keterangan,
				]);
			}
		}
	}

}
