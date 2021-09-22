<?php
namespace App\Libraries\XlsxReader;

use App\Libraries\XlsxReader\DataSurat;
use App\Libraries\XlsxReader\DataPenyedia;
use App\Libraries\XlsxReader\DataPegawai;

class DataKegiatan {

    public $bulan;
    public $kegiatan;
    public $paket;
    public $prodi;
    public $nilai_kwitansi;

    public DataPenyedia $penyedia;
    public DataPegawai $unit;
    public DataPegawai $kaprodi;

    public DataSurat $sp;
    public DataSurat $bap;
    public DataSurat $bast;
    public DataSurat $tt;
    public array $barang;

    public function __construct() {
        $this->penyedia = new DataPenyedia();
        $this->unit = new DataPegawai();
        $this->kaprodi = new DataPegawai();
        $this->sp = new DataSurat();
        $this->bap = new DataSurat();
        $this->bast = new DataSurat();
        $this->tt = new DataSurat();
        $this->barang = [];
    }
}
