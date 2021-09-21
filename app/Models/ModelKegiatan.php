<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Database\PostgreBuilder;

class ModelKegiatan extends Model {
    
    /**
     * --------------------------------------------
     * t_kegiatan
     * --------------------------------------------
     * kg_id				SERIAL
     * kg_bulan				INT
     * kg_kegiatan			TEXT
     * kg_paket				TEXT
     * kg_prodi				VARCHAR (256)
     * kg_nilai_kwitansi	INT
     * kg_penyedia			INT
     * kg_unit				INT
     * kg_kaprodi			INT
     * --------------------------------------------
     */

    /**
     * --------------------------------------------
     * v_kegiatan
     * --------------------------------------------
     * kg_id                pyd_nama        unit_nama
     * kg_bulan             pyd_alamat      unit_nip
     * kg_kegiatan          pyd_pemilik     unit_jabatan
     * kg_paket             pyd_jabatan
     * kg_prodi                             kaprodi_nama
     * kg_nilai_kwitansi                    kaprodi_nip
     * kg_penyedia                          kaprodi_jabatan
     * kg_unit
     * kg_kaprodi
     * 
     * sp_nomor             bap_nomor       bast_nomor      tt_nomor
     * sp_tanggal           bap_tanggal     bast_tanggal    tt_tanggal
     * --------------------------------------------
     */

    protected $validFields = [
        "bulan",
        "kegiatan",
        "paket",
        "prodi",
        "nilai_kwitansi",
        "penyedia",
        "unit",
        "kaprodi"
    ];

    public function getRecords() {
        $builder = new PostgreBuilder('v_kegiatan', $this->db);
        return $builder->get()->getResult();
    }

    public function getRecord($id) {
        $builder = new PostgreBuilder('v_kegiatan', $this->db);
        $builder->where('kg_id', $id);
        return $builder->get()->getRow();
    }

    public function insertRecord($data) {
        $builder = new PostgreBuilder('t_kegiatan', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('kg_' . $field, $data[$field]);
            }
        }
        $result = $builder->insertWithReturning(['kg_id'])->getRow();
        return $result ? $result->kg_id : null;
    }

    public function updateRecord($id, $data) {
        $builder = new PostgreBuilder('t_kegiatan', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('kg_' . $field, $data[$field]);
            }
        }
        $builder->where('kg_id', $id);
        $builder->update();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteRecord($id) {
        $builder = new PostgreBuilder('t_kegiatan', $this->db);
        $builder->where('kg_id', $id);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }
    
    public function emptyTable() {
        $builder = new PostgreBuilder('t_kegiatan', $this->db);
        $builder->emptyTable();
    }

}
