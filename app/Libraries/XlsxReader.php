<?php
namespace App\Libraries;

use App\Libraries\XlsxReader\DataKegiatan;
use App\Libraries\XlsxReader\DataSurat;
use App\Libraries\XlsxReader\DataBarang;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class XlsxReader {

    private const COL_NOMOR         = 1; // A
    private const COL_KEGIATAN      = 2; // B
    private const COL_PAKET         = 3; // C
    private const COL_KWITANSI      = 4; // D
    private const COL_JENIS_SURAT   = 5; // E
    private const COL_NO_SURAT      = 6; // F
    private const COL_PRODI         = 7; // G
    private const COL_TANGGAL_SURAT = 8; // H
    private const COL_KATEGORI      = 9; // I
    private const COL_NAMA_PENYEDIA = 10; // J
    private const COL_NAMA_PEMILIK  = 11; // K
    private const COL_JABATAN       = 12; // L
    private const COL_ALAMAT        = 13; // M
    private const COL_NAMA_BARANG   = 15; // O
    private const COL_JUMLAH        = 16; // P
    private const COL_SATUAN        = 17; // Q
    private const COL_SPESIFIKASI   = 18; // R
    private const COL_PEMAKAI       = 19; // S
    private const COL_NIP_PEMAKAI   = 20; // T
    private const COL_KAPRODI       = 21; // U
    private const COL_NIP_KAPRODI   = 22; // V

    private const COL_HARGA         = 23; // W

    private $bulan = [
        'Januari' => 1,
        'Februari' => 2, 'Pebruari' => 2,
        'Maret' => 3,
        'April' => 4,
        'Mei' => 5,
        'Juni' => 6,
        'Juli' => 7,
        'Agustus' => 8,
        'September' => 9,
        'Oktober' => 10,
        'November' => 11, 'Nopember' => 11,
        'Desember' => 12
    ];

    private $filename;
    private $sheet;
    private $data = [];

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function getData(): array {
        return $this->data;
    }
    
    public function read() {
        $reader = new Xlsx();
        $this->data = [];
        $spreadsheet = $reader->load($this->filename);
        $sheetcount = $spreadsheet->getSheetCount();
        $kegiatan = null;

        for ($i = 0; $i < $sheetcount; $i++) {
            $this->sheet = $spreadsheet->getSheet($i);
            $highestRow = $this->sheet->getHighestRow();

            for ($row = 2; $row <= $highestRow; $row++) {
                if ($this->getNumericValue(self::COL_NOMOR, $row) > 0) {
                    if (!is_null($kegiatan)) {
                        array_push($this->data, $kegiatan);
                        $kegiatan = null;
                    }

                    $kegiatan = new DataKegiatan();
                    $kegiatan->bulan = $this->bulan[ucfirst($this->sheet->getTitle())];
                    $kegiatan->kegiatan = $this->getValue(self::COL_KEGIATAN, $row);
                    $kegiatan->paket = $this->getValue(self::COL_PAKET, $row);
                    $kegiatan->prodi = $this->getValue(self::COL_PRODI, $row);
                    $kegiatan->nilai_kwitansi = $this->getNumericValue(self::COL_KWITANSI, $row);
                    $kegiatan->penyedia->nama = $this->getValue(self::COL_NAMA_PENYEDIA, $row);
                    $kegiatan->penyedia->pemilik = $this->getValue(self::COL_NAMA_PEMILIK, $row);
                    $kegiatan->penyedia->jabatan = $this->getValue(self::COL_JABATAN, $row);
                    $kegiatan->penyedia->alamat = $this->getValue(self::COL_ALAMAT, $row);
                    $kegiatan->unit->nama = $this->getValue(self::COL_PEMAKAI, $row);
                    $kegiatan->unit->nip = $this->getValue(self::COL_NIP_PEMAKAI, $row);
                    $kegiatan->kaprodi->nama = $this->getValue(self::COL_KAPRODI, $row);
                    $kegiatan->kaprodi->nip = $this->getValue(self::COL_NIP_KAPRODI, $row);
                }

                if (!is_null($kegiatan)) {
                    $surat = $this->getValue(self::COL_JENIS_SURAT, $row);
                    if (strtoupper($surat) == 'BAP') {
                        $kegiatan->bap->nomor = $this->getValue(self::COL_NO_SURAT, $row);
                        $kegiatan->bap->tanggal = $this->getValue(self::COL_TANGGAL_SURAT, $row);
                    }
                    if (strtoupper($surat) == 'BAST') {
                        $kegiatan->bast->nomor = $this->getValue(self::COL_NO_SURAT, $row);
                        $kegiatan->bast->tanggal = $this->getFormattedValue(self::COL_TANGGAL_SURAT, $row);
                    }
                    if (strtoupper($surat) == 'TT') {
                        $kegiatan->tt->nomor = $this->getValue(self::COL_NO_SURAT, $row);
                        $kegiatan->tt->tanggal = $this->getFormattedValue(self::COL_TANGGAL_SURAT, $row);
                    }
                    if (strtoupper($surat) == 'SP') {
                        $kegiatan->sp->nomor = $this->getValue(self::COL_NO_SURAT, $row);
                        $kegiatan->sp->tanggal = $this->getFormattedValue(self::COL_TANGGAL_SURAT, $row);
                    }

                    if ("" != $barang = $this->getValue(self::COL_NAMA_BARANG, $row)) {
                        $data_barang = new DataBarang();
                        $data_barang->nama = $barang;
                        $data_barang->spesifikasi = $this->getValue(self::COL_SPESIFIKASI, $row);
                        $data_barang->kategori = $this->getValue(self::COL_KATEGORI, $row);
                        $data_barang->jumlah = $this->getNumericValue(self::COL_JUMLAH, $row);
                        $data_barang->satuan = $this->getValue(self::COL_SATUAN, $row);
                        $data_barang->harga = $this->getNumericValue(self::COL_HARGA, $row);
                        array_push($kegiatan->barang, $data_barang);
                    }
                }
            }

            if (!is_null($kegiatan)) {
                array_push($this->data, $kegiatan);
                $kegiatan = null;
            }
        }
        return $this->data;
	}

    private function getValue($col, $row) {
        if (!is_null($this->sheet)) {
            return $this->sheet->getCellByColumnAndRow($col, $row)->getValue();
        }
        return null;
    }

    private function getNumericValue($col, $row) {
        if ($value = $this->getValue($col, $row)) {
            return is_numeric($value) ? $value: 0;
        }
        return 0;
    }

    private function getFormattedValue($col, $row) {
        return $this->sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
    }

}
