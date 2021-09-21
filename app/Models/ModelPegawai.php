<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Database\PostgreBuilder;

class ModelPegawai extends Model {
    
    /**
     * --------------------------------------------
     * t_pegawai
     * --------------------------------------------
     * pgw_id			SERIAL
     * pgw_nama			TEXT
     * pgw_nip			VARCHAR (256)
     * pgw_jabatan		VARCHAR (256)
     * --------------------------------------------
     */

    protected $validFields = [
        "nama",
        "nip",
        "jabatan"
    ];

    public function getRecords() {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        return $builder->get()->getResult();
    }

    public function getRecord($id) {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        $builder->where('pgw_id', $id);
        return $builder->get()->getRow();
    }

    public function insertRecord($data) {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('pgw_' . $field, $data[$field]);
            }
        }
        $result = $builder->insertWithReturning(['pgw_id'])->getRow();
        return $result ? $result->pgw_id : null;
    }

    public function updateRecord($id, $data) {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('pgw_' . $field, $data[$field]);
            }
        }
        $builder->where('pgw_id', $id);
        $builder->update();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteRecord($id) {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        $builder->where('pgw_id', $id);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }
    
    public function emptyTable() {
        $builder = new PostgreBuilder('t_pegawai', $this->db);
        $builder->emptyTable();
    }

}
