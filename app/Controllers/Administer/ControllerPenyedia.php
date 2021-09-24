<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelPenyedia;
use App\Models\ModelKegiatan;

class ControllerPenyedia extends BaseController
{
    public function getPageAllPenyedia() {
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

        echo view('Includes/Header', [
            "isPagePenyedia" => true,
        ]);
        echo view('Pages/Penyedia', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

    public function getPagePenyedia($id) {
        $model = new ModelPenyedia();
        if (null !== $item = $model->getRecord($id)) {
            $from = $this->request->getGet('kegiatan');

            echo view('Includes/Header', [
                "isPagePenyedia" => true,
            ]);
            echo view('Pages/Penyedia/View', [
                "from" => isset($from) ? "?kegiatan=$from" : "",
                "id" => $id,
                "nama" => $this->getFlashdata('penyedia_nama', $item->pyd_nama),
                "alamat" => $this->getFlashdata('penyedia_alamat', $item->pyd_alamat),
                "pemilik" => $this->getFlashdata('penyedia_pemilik', $item->pyd_pemilik),
                "jabatan" => $this->getFlashdata('penyedia_jabatan', $item->pyd_jabatan),
                "errorMessage" => $this->getFlashdata('penyedia_error'),
                "successMessage" => $this->getFlashdata('penyedia_success'),
            ]);
            echo view('Includes/Footer');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPageAddPenyedia() {
        $from = $this->request->getGet('kegiatan');
        echo view('Includes/Header', [
            "isPagePenyedia" => true,
        ]);
        echo view('Pages/Penyedia/Add', [
            "from" => isset($from) ? "?kegiatan=$from" : "",
            "nama" => $this->getFlashdata('penyedia_nama'),
            "alamat" => $this->getFlashdata('penyedia_alamat'),
            "pemilik" => $this->getFlashdata('penyedia_pemilik'),
            "jabatan" => $this->getFlashdata('penyedia_jabatan'),
            "errorMessage" => $this->getFlashdata('penyedia_error'),
        ]);
        echo view('Includes/Footer');
    }

    public function processAddPenyedia() {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        if ($this->validation->run($data, 'penyedia')) {
            $model = new ModelPenyedia();
            if (null !== $id = $model->insertRecord($data)) {
                return redirect()->to(base_url($redirect ?? "/kegiatan"));
            }
            $this->setFlashdata('penyedia_error', 'Gagal menambahkan Penyedia.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('penyedia_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('penyedia_' . $key, $value);
        }

        return redirect()->to(base_url($redirect ?? "/kegiatan/new"));
    }

    public function processActionPenyedia($id) {
        if (null !== $this->request->getPost('action_update')) {
            return $this->processUpdatePenyedia($id);
        } elseif (null !== $this->request->getPost('action_delete')) {
            return $this->processDeletePenyedia($id);
        } else {
            return redirect()->to(base_url("/penyedia/$id"));
        }
    }

    private function processUpdatePenyedia($id) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        if ($this->validation->run($data, 'penyedia')) {
            $model = new ModelPenyedia();
            if ($model->updateRecord($id, $data)) {
                $this->setFlashdata('penyedia_success', 'Berhasil mengupdate Penyedia.');
                return redirect()->to(base_url($redirect ?? "/penyedia/$id"));
            }
            $this->setFlashdata('penyedia_error', 'Gagal mengupdate Penyedia.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('penyedia_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('penyedia_' . $key, $value);
        }

        return redirect()->to(base_url($redirect ?? "/penyedia/$id"));
    }

    private function processDeletePenyedia($id) {
        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        $modelKegiatan = new ModelKegiatan();
        $modelPenyedia = new ModelPenyedia();
        $modelKegiatan->updateNullRecord('penyedia', $id);
        if ($modelPenyedia->deleteRecord($id)) {
            return redirect()->to(base_url($redirect ?? '/penyedia'));
        }
        $this->setFlashdata('penyedia_error', 'Gagal mengupdate Penyedia.');
        return redirect()->to(base_url($redirect ?? "/penyedia/$id"));
    }

}
