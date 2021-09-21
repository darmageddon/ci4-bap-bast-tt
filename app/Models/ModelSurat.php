<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Database\PostgreBuilder;

class ModelSurat extends Model {
    
    /**
     * --------------------------------------------
     * t_surat
     * --------------------------------------------
     * sr_kg_id		INT
     * sr_jenis		VARCHAR(4) -- bap, bast, sp, tt
     * sr_nomor		VARCHAR(256)
     * sr_tanggal	DATE -- yyyy-mm-dd
     * --------------------------------------------
     */

    protected $validFields = [
        "jenis",
        "nomor",
        "tanggal"
    ];

    public function getRecords($kgid) {
        $builder = $this->db->table('t_surat');
        $builder->where('sr_kg_id', $kgid);
        return $builder->get()->getResult();
    }

    public function getRecord($kgid, $type) {
        $builder = $this->db->table('t_surat');
        $builder->where('sr_kg_id', $kgid);
        $builder->where('sr_jenis', $type);
        return $builder->get()->getRow();
    }

    public function insertRecord($kgid, $data) {
        $builder = new PostgreBuilder('t_surat', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('sr_' . $field, $data[$field]);
            }
        }
        $builder->set('sr_kg_id', $kgid);
        $result = $builder->insert();
        return ($this->db->affectedRows() != 0);
    }

    public function updateRecord($id, $data) {
        $builder = $this->db->table('t_surat');
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('sr_' . $field, $data[$field]);
            }
        }
        $builder->where('sr_id', $id);
        $builder->update();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteRecord($id) {
        $builder = $this->db->table('t_surat');
        $builder->where('sr_id', $id);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }
    
    public function emptyTable() {
        $builder = $this->db->table('t_surat');
        $builder->emptyTable();
    }

}
