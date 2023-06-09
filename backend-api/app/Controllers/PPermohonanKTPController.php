<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SPengantarPermohonanKTP;
use App\Models\Users;

class PPermohonanKTPController extends BaseController
{
    public function index()
    {
        $model = new SPengantarPermohonanKTP();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Pengantar Permohonan KTP',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return view('pages/dashboard/surat_pengantar_permohonan_ktp',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat pengantar permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat pengantar permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SPengantarPermohonanKTP();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal update surat pengantar permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update pengantar permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SPengantarPermohonanKTP();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat pengantar permohonan ktp'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SPengantarPermohonanKTP();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }

    public function getAll()
    {
        $model = new SPengantarPermohonanKTP();
        return $this->response->setJSON($model->findAll());
    }

    public function getSingle($id)
    {
        $model = new SPengantarPermohonanKTP();
        return $this->response->setJSON($model->find($id));
    }

    public function insert()
    {
        $model = new SPengantarPermohonanKTP();
        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status' => true,
                'text' => 'Berhasil membuat surat'
            ]);
        }
    }
}
