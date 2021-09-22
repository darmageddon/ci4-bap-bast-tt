<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelPenyedia;
use App\Models\ModelKegiatan;

class ControllerPenyedia extends BaseController
{
    
    public function getAllPenyedia() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pyd_id,
                    "nama" => $item->pyd_nama,
                    "alamat" => $item->pyd_alamat,
                    "pemilik" => $item->pyd_pemilik,
                ];
            },
            (new ModelPenyedia())->getRecords()
        );

        echo view('Includes/Header');
        echo view('Pages/Penyedia', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

    public function getPenyedia($id) {
        $model = new ModelPenyedia();
        if (null !== $item = $model->getRecord($id)) {
            echo view('Includes/Header');
            echo view('Pages/Penyedia/View', [
                "id" => $id,
                "nama" => $this->session->getFlashdata('flash_penyedia_nama') ?? $item->pyd_nama,
                "alamat" => $this->session->getFlashdata('flash_penyedia_alamat') ?? $item->pyd_alamat,
                "pemilik" => $this->session->getFlashdata('flash_penyedia_pemilik') ?? $item->pyd_pemilik,
                "jabatan" => $this->session->getFlashdata('flash_penyedia_jabatan') ?? $item->pyd_jabatan,
                "errorMessage" => $this->session->getFlashdata('flash_penyedia_error'),
                "successMessage" => $this->session->getFlashdata('flash_penyedia_success'),
            ]);
            echo view('Includes/Footer');
        }
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function getPageAddPenyedia() {
        echo view('Includes/Header');
        echo view('Pages/Penyedia/Add', [
            "nama" => $this->session->getFlashdata('flash_penyedia_nama'),
            "alamat" => $this->session->getFlashdata('flash_penyedia_alamat'),
            "pemilik" => $this->session->getFlashdata('flash_penyedia_pemilik'),
            "jabatan" => $this->session->getFlashdata('flash_penyedia_jabatan'),
            "errorMessage" => $this->session->getFlashdata('flash_penyedia_error'),
        ]);
        echo view('Includes/Footer');
    }

    public function processAddPenyedia() {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'penyedia')) {
            $model = new ModelPenyedia();
            if (null !== $id = $model->insertRecord($data)) {
                return redirect()->to(base_url('/penyedia'));
            }
            $this->session->setFlashdata('flash_penyedia_error', 'Gagal menambahkan Penyedia.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->session->setFlashdata('flash_penyedia_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->session->setFlashdata('flash_penyedia_' . $key, $value);
        }

        return redirect()->to(base_url('/penyedia/new'));
    }

    public function processUpdatePenyedia($id) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        if ($this->validation->run($data, 'penyedia')) {
            $model = new ModelPenyedia();
            if ($model->updateRecord($id, $data)) {
                $this->session->setFlashdata('flash_penyedia_success', 'Berhasil mengupdate Penyedia.');
                return redirect()->to(base_url("/penyedia/$id"));
            }
            $this->session->setFlashdata('flash_penyedia_error', 'Gagal mengupdate Penyedia.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->session->setFlashdata('flash_penyedia_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->session->setFlashdata('flash_penyedia_' . $key, $value);
        }

        return redirect()->to(base_url("/penyedia/$id"));
    }

    public function processDeletePenyedia($id) {
        $model = new ModelPenyedia();
        if ($model->deleteRecord($id)) {
            return redirect()->to(base_url('/penyedia'));
        }
        $this->session->setFlashdata('flash_penyedia_error', 'Gagal mengupdate Penyedia.');
        return redirect()->to(base_url("/penyedia/$id"));
    }

}
