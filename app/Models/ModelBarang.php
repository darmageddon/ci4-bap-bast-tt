<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Database\PostgreBuilder;

class ModelBarang extends Model {
    
    /**
     * --------------------------------------------
     * t_barang
     * --------------------------------------------
     * brg_id			    SERIAL
     * brg_kg_id			INT
     * brg_nama				TEXT
     * brg_spesifikasi		TEXT
     * brg_kategori			TEXT
     * brg_jumlah			INT
     * brg_satuan			VARCHAR (256)
     * brg_harga			INT
     * brg_keterangan		TEXT
     * --------------------------------------------
     */

    /**
     * --------------------------------------------
     * v_barang
     * --------------------------------------------
     * brg_id
     * brg_kg_id
     * brg_nama
     * brg_spesifikasi
     * brg_kategori
     * brg_jumlah
     * brg_satuan
     * brg_harga
     * brg_keterangan
     * brg_harga_total
     * --------------------------------------------
     */

    protected $validFields = [
        "nama",
        "spesifikasi",
        "kategori",
        "jumlah",
        "satuan",
        "harga",
        "keterangan",
    ];

    public function getRecords($kgid) {
        $builder = new PostgreBuilder('v_barang', $this->db);
        $builder->where('brg_kg_id', $kgid);
        return $builder->get()->getResult();
    }

    public function getRecord($id) {
        $builder = new PostgreBuilder('v_barang', $this->db);
        $builder->where('brg_id', $id);
        return $builder->get()->getRow();
    }

    public function insertRecord($kgid, $data) {
        $builder = new PostgreBuilder('t_barang', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('brg_' . $field, $data[$field]);
            }
        }
        $builder->set('brg_kg_id', $kgid);
        $result = $builder->insertWithReturning(['brg_id'])->getRow();
        return $result ? $result->brg_id : null;
    }

    public function updateRecord($id, $data) {
        $builder = new PostgreBuilder('t_barang', $this->db);
        foreach ($this->validFields as $field) {
            if (isset($data[$field])) {
                $builder->set('brg_' . $field, $data[$field]);
            }
        }
        $builder->where('brg_id', $id);
        $builder->update();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteRecord($id) {
        $builder = new PostgreBuilder('t_barang', $this->db);
        $builder->where('brg_id', $id);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }

    public function deleteNullRecord($kgid) {
        $builder = new PostgreBuilder('t_barang', $this->db);
        $builder->where('brg_kg_id', $kgid);
        $builder->delete();
        return ($this->db->affectedRows() != 0);
    }
    
    public function emptyTable() {
        $builder = new PostgreBuilder('t_barang', $this->db);
        $builder->emptyTable();
    }

}
