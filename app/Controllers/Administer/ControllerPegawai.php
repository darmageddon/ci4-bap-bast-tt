<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelPegawai;

class ControllerPegawai extends BaseController
{
    public function getPageAllPegawai() {
        $items = array_map(
            function ($item) {
                return (object) [
                    "id" => $item->pgw_id,
                    "nama" => $item->pgw_nama,
                    "nip" => $item->pgw_nip,
                    "jabatan" => $item->pgw_jabatan,
                ];
            },
            (new ModelPegawai())->getRecords()
        );

        echo view('Includes/Header', [
            "isPagePegawai" => true,
        ]);
        echo view('Pages/Pegawai', [
            "items" => (object) $items
        ]);
        echo view('Includes/Footer');
    }

    public function getPagePegawai($id) {
        $model = new ModelPegawai();
        if (null !== $item = $model->getRecord($id)) {
            $from = $this->request->getGet('kegiatan');
            echo view('Includes/Header', [
                "isPagePegawai" => true,
            ]);
            echo view('Pages/Pegawai/View', [
                "from" => isset($from) ? "?kegiatan=$from" : "",
                "id" => $id,
                "nama" => $this->getFlashdata('pegawai_nama', $item->pgw_nama),
                "nip" => $this->getFlashdata('pegawai_nip', $item->pgw_nip),
                "jabatan" => $this->getFlashdata('pegawai_jabatan', $item->pgw_jabatan),
                "errorMessage" => $this->getFlashdata('pegawai_error'),
                "successMessage" => $this->getFlashdata('pegawai_success'),
            ]);
            echo view('Includes/Footer');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPageAddPegawai() {
        $from = $this->request->getGet('kegiatan');
        echo view('Includes/Header', [
            "isPagePegawai" => true,
        ]);
        echo view('Pages/Pegawai/Add', [
            "from" => isset($from) ? "?kegiatan=$from" : "",
            "nama" => $this->getFlashdata('pegawai_nama'),
            "nip" => $this->getFlashdata('pegawai_nip'),
            "jabatan" => $this->getFlashdata('pegawai_jabatan'),
            "errorMessage" => $this->getFlashdata('pegawai_error'),
        ]);
        echo view('Includes/Footer');
    }

    public function processAddPegawai() {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        if ($this->validation->run($data, 'pegawai')) {
            $model = new ModelPegawai();
            if (null !== $id = $model->insertRecord($data)) {
                return redirect()->to(base_url($redirect ?? '/pegawai'));
            }
            $this->setFlashdata('pegawai_error', 'Gagal menambahkan Pegawai.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('pegawai_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('pegawai_' . $key, $value);
        }

        return redirect()->to(base_url($redirect ?? '/pegawai/new'));
    }

    public function processActionPegawai($id) {
        if (null !== $this->request->getPost('action_update')) {
            return $this->processUpdatePegawai($id);
        } elseif (null !== $this->request->getPost('action_delete')) {
            return $this->processDeletePegawai($id);
        } else {
            return redirect()->to(base_url("/pegawai/$id"));
        }
    }

    private function processUpdatePegawai($id) {
        $data = array_map(function($item) {
            return trim($item);
        }, $this->request->getPost());

        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        if ($this->validation->run($data, 'pegawai')) {
            $model = new ModelPegawai();
            if ($model->updateRecord($id, $data)) {
                $this->setFlashdata('pegawai_success', 'Berhasil mengupdate Pegawai.');
                return redirect()->to(base_url($redirect ?? "/pegawai/$id"));
            }
            $this->setFlashdata('pegawai_error', 'Gagal mengupdate Pegawai.');
        } else {
            $errors = $this->validation->getErrors();
            reset($errors);
            $this->setFlashdata('pegawai_error', $errors[key($errors)]);
        }

        foreach ($data as $key => $value) {
            $this->setFlashdata('pegawai_' . $key, $value);
        }

        return redirect()->to(base_url($redirect ?? "/pegawai/$id"));
    }

    private function processDeletePegawai($id) {
        $from = $this->request->getGet('kegiatan');
        $redirect = null;
        if (isset($from)) {
            $redirect = $from > 0 ? "/kegiatan/$from" : "/kegiatan/new";
        }

        $modelKegiatan = new ModelKegiatan();
        $modelPegawai = new ModelPegawai();
        $modelKegiatan->updateNullRecord('unit', $id);
        $modelKegiatan->updateNullRecord('kaprodi', $id);
        if ($modelPegawai->deleteRecord($id)) {
            return redirect()->to(base_url($redirect ?? '/pegawai'));
        }
        $this->setFlashdata('pegawai_error', 'Gagal mengupdate Pegawai.');
        return redirect()->to(base_url($redirect ?? "/pegawai/$id"));
    }

}
