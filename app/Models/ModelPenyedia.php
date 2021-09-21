<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Database\PostgreBuilder;

class ModelPenyedia extends Model {
    
    /**
     * --------------------------------------------
     * t_penyedia
     * --------------------------------------------
     * pyd_id			SERIAL
     * pyd_nama			TEXT
     * pyd_alamat		TEXT
     * pyd_pemilik		TEXT
     * pyd_jabatan		VARCHAR (256)
     * --------------------------------------------
     */

    protected $validFields = [
        "nama",
        "alamat",
        "pemilik",
        "jabatan"
    ];

    public function getRecords() {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        return $builder->get()->getResult();
    }

    public function getRecord($id) {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        $builder->where('pyd_id', $id);
        return $builder->get()->getRow();
    }

    public function insertRecord($data) {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('pyd_' . $field, $data[$field]);
            }
        }
        $result = $builder->insertWithReturning(['pyd_id'])->getRow();
        return $result ? $result->pyd_id : null;
    }

    public function updateRecord($id, $data) {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('pyd_' . $field, $data[$field]);
            }
        }
        $builder->where('pyd_id', $id);
        $builder->update();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteRecord($id) {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        $builder->where('pyd_id', $id);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }
    
    public function emptyTable() {
        $builder = new PostgreBuilder('t_penyedia', $this->db);
        $builder->emptyTable();
    }

}
