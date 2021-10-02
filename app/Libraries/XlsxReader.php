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
    private const COL_HARGA         = 18; // R
    private const COL_SPESIFIKASI   = 19; // S
    private const COL_PEMAKAI       = 20; // T
    private const COL_NIP_PEMAKAI   = 21; // U
    private const COL_KAPRODI       = 22; // V
    private const COL_NIP_KAPRODI   = 23; // W

    

    private $bulan = [
        'januari' => 1,
        'februari' => 2, 'pebruari' => 2,
        'maret' => 3,
        'april' => 4,
        'mei' => 5,
        'juni' => 6,
        'juli' => 7,
        'agustus' => 8,
        'september' => 9,
        'oktober' => 10,
        'november' => 11, 'nopember' => 11,
        'desember' => 12
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
        $itembarang = null;
        $tmpkegiatan = [];
        $tmppenyedia = [];
        $tmpunit = [];
        $tmpkaprodi = [];
        $tmpbarang = [];

        for ($i = 0; $i < $sheetcount; $i++) {
            $this->sheet = $spreadsheet->getSheet($i);
            $highestRow = $this->sheet->getHighestRow();

            $bulan = strtolower($this->sheet->getTitle());
            $indexBulan = 1;
            if (isset($this->bulan[$bulan])) {
                $indexBulan = $this->bulan[$bulan];
            }

            for ($row = 2; $row <= $highestRow; $row++) {

                if ($this->getNumericValue(self::COL_NOMOR, $row) > 0) {
                    if (!is_null($kegiatan)) {
                        array_push($this->data, $kegiatan);
                    }
                    $kegiatan = new DataKegiatan();
                    $tmpkegiatan = [];
                    $tmpbarang = [];
                }

                if (!is_null($kegiatan)) {
                    $kegiatan->bulan = $indexBulan;

                    $datakegiatan = [
                        'kegiatan' => $this->getValue(self::COL_KEGIATAN, $row),
                        'paket' => $this->getValue(self::COL_PAKET, $row),
                        'prodi' => $this->getValue(self::COL_PRODI, $row),
                        'nilai_kwitansi' => $this->getNumericValue(self::COL_KWITANSI, $row),
                    ];

                    $datapenyedia = [
                        'nama' => $this->getValue(self::COL_NAMA_PENYEDIA, $row),
                        'pemilik' => $this->getValue(self::COL_NAMA_PEMILIK, $row),
                        'jabatan' => $this->getValue(self::COL_JABATAN, $row),
                        'alamat' => $this->getValue(self::COL_ALAMAT, $row),
                    ];

                    $dataunit = [
                        'nama' => $this->getValue(self::COL_PEMAKAI, $row),
                        'nip' => $this->getValue(self::COL_NIP_PEMAKAI, $row),
                    ];

                    $datakaprodi = [
                        'nama' => $this->getValue(self::COL_KAPRODI, $row),
                        'nip' => $this->getValue(self::COL_NIP_KAPRODI, $row),
                    ];

                    foreach ($datakegiatan as $key => $value) {
                        if (!empty($value)) {
                            $tmpkegiatan[$key] = $value;
                        } elseif (isset($tmpkegiatan[$key])) {
                            $datakegiatan[$key] = $tmpkegiatan[$key];
                        }
                        $kegiatan->$key = $datakegiatan[$key];
                    }

                    foreach ($datapenyedia as $key => $value) {
                        if (!empty($value)) {
                            $tmppenyedia[$key] = $value;
                        } elseif (isset($tmppenyedia[$key])) {
                            $datapenyedia[$key] = $tmppenyedia[$key];
                        }
                        $kegiatan->penyedia->$key = $datapenyedia[$key];
                    }

                    foreach ($dataunit as $key => $value) {
                        if (!empty($value)) {
                            $tmpunit[$key] = $value;
                        } elseif (isset($tmpunit[$key])) {
                            $dataunit[$key] = $tmpunit[$key];
                        }
                        $kegiatan->unit->$key = $dataunit[$key];
                    }

                    foreach ($datakaprodi as $key => $value) {
                        if (!empty($value)) {
                            $tmpkaprodi[$key] = $value;
                        } elseif (isset($tmpkaprodi[$key])) {
                            $datakaprodi[$key] = $tmpkaprodi[$key];
                        }
                        $kegiatan->kaprodi->$key = $datakaprodi[$key];
                    }

                    if ($surat = strtolower($this->getValue(self::COL_JENIS_SURAT, $row))) {
                        if (in_array($surat, ['sp', 'bap', 'bast', 'tt'])) {
                            $kegiatan->$surat->nomor = $this->getValue(self::COL_NO_SURAT, $row);
                            $kegiatan->$surat->tanggal = $this->getDate(self::COL_TANGGAL_SURAT, $row);
                        }
                    }

                    if ($barang = $this->getValue(self::COL_NAMA_BARANG, $row)) {
                        $brg = new DataBarang();
                        $brg->nama = $barang;
                        $databrg = [
                            'spesifikasi' => $this->getValue(self::COL_SPESIFIKASI, $row),
                            'kategori' => $this->getValue(self::COL_KATEGORI, $row),
                            'jumlah' => $this->getNumericValue(self::COL_JUMLAH, $row),
                            'satuan' => $this->getValue(self::COL_SATUAN, $row),
                            'harga' => $this->getNumericValue(self::COL_HARGA, $row),
                        ];
                        foreach ($databrg as $key => $value) {
                            if (!empty($value)) {
                                $tmpbarang[$key] = $value;
                            } elseif (isset($tmpbarang[$key])) {
                                $databrg[$key] = $tmpbarang[$key];
                            }
                            $brg->$key = $databrg[$key];
                        }
                        array_push($kegiatan->barang, $brg);
                    }
                }

                if ($row == $highestRow) {
                    if (!is_null($kegiatan)) {
                        array_push($this->data, $kegiatan);
                        $kegiatan = null;
                        $itembarang = null;
                        $tmpkegiatan = [];
                        $tmppenyedia = [];
                        $tmpunit = [];
                        $tmpkaprodi = [];
                        $tmpbarang = [];
                    }
                }
            }
        }
        return $this->data;
	}

    private function getValue($col, $row) {
        if (!is_null($this->sheet)) {
            if ($this->sheet->getCellByColumnAndRow($col, $row)->isFormula()) {
                return $this->sheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
            }
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

    private function getDate($col, $row) {
        if (!is_null($this->sheet)) {
            $value = null;
            if ($this->sheet->getCellByColumnAndRow($col, $row)->isFormula()) {
                $value = $this->sheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
            } else {
                $value = $this->sheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if (!empty($value)) {
                if ($date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)) {
                    return $date->format('d/m/Y');
                }
            }
        }
        return null;
    }

    private function getFormattedValue($col, $row) {
        if (!is_null($this->sheet)) {
            if ($this->sheet->getCellByColumnAndRow($col, $row)->isFormula()) {
                return $this->sheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
            }
            return $this->sheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
        }
        return null;
    }

}
