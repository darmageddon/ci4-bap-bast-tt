<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelBarang;
use App\Libraries\CustomFormatter;

class ControllerBarang extends BaseController
{
    public function getPageBarang($kgid, $id) {
        $model = new ModelBarang();
        if (null !== $item = $model->getRecord($id)) {
            echo view('Includes/Header', [
                "isPageDashboard" => true,
            ]);
            echo view('Pages/Barang/View', [
                "kgid" => $kgid,
                "id" => $id,
                "nama" => $this->getFlashdata('b_nama', $item->brg_nama),
                "spesifikasi" => $this->getFlashdata('b_spesifikasi', $item->brg_spesifikasi),
                "kategori" => $this->getFlashdata('b_kategori', $item->brg_kategori),
                "jumlah" => $this->getFlashdata('b_jumlah', $item->brg_jumlah),
                "satuan" => $this->getFlashdata('b_satuan', $item->brg_satuan),
                "harga" => $this->getFlashdata('b_harga', $item->brg_harga),
                "keterangan" => $this->getFlashdata('b_keterangan', $item->brg_keterangan),
                "errorMessage" => $this->getFlashdata('b_error'),
            ]);
            echo view('Includes/Footer');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPageAddKegiatan($kgid) {
        echo view('Includes/Header', [
            "isPageDashboard" => true,
        ]);
        echo view('Pages/Barang/Add', [
            "kgid" => $kgid,
            "nama" => $this->getFlashdata('b_nama'),
            "spesifikasi" => $this->getFlashdata('b_spesifikasi'),
            "kategori" => $this->getFlashdata('b_kategori'),
            "jumlah" => $this->getFlashdata('b_jumlah'),
            "satuan" => $this->getFlashdata('b_satuan'),
            "harga" => $this->getFlashdata('b_harga'),
            "keterangan" => $this->getFlashdata('b_keterangan'),
            "errorMessage" => $this->getFlashdata('b_error'),
        ]);
        echo view('Includes/Footer');
    }

    public function processAddBarang($kgid) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'barang')) {
            $modelBarang = new ModelBarang();
            if (null !== $id = $modelBarang->insertRecord($kgid, $data)) {
                return redirect()->to(base_url("/kegiatan/$kgid"));
            }
            $this->setFlashdata('b_error', 'Gagal menambahkan Barang.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('b_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('b_' . $key, $value);
        }

        return redirect()->to(base_url("/kegiatan/$kgid/barang/new"));
    }

    public function processActionBarang($kgid, $id) {
        if (null !== $this->request->getPost('action_update')) {
            return $this->processUpdateBarang($kgid, $id);
        } elseif (null !== $this->request->getPost('action_delete')) {
            return $this->processDeleteBarang($kgid, $id);
        } else {
            return redirect()->to(base_url("/kegiatan/$kgid/barang/$id"));
        }
    }

    private function processUpdateBarang($kgid, $id) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'barang')) {
            $modelBarang = new ModelBarang();
            if ($modelBarang->updateRecord($id, $data)) {
                return redirect()->to(base_url("/kegiatan/$kgid"));
            }
            $this->setFlashdata('b_error', 'Gagal mengupdate Barang.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('b_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('b_' . $key, $value);
        }

        return redirect()->to(base_url("/kegiatan/$id"));
    }

    private function processDeleteBarang($kgid, $id) {
        $modelBarang = new ModelBarang();
        if ($modelBarang->deleteRecord($id)) {
            return redirect()->to(base_url("/kegiatan/$kgid"));
        }
        $this->setFlashdata('b_error', 'Gagal menghapus Barang.');
        return redirect()->to(base_url("/kegiatan/$kgid/barang/$id"));
    }

}
