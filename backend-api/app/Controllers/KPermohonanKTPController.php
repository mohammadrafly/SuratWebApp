<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganPermohonanKTP;
use App\Models\Users;

class KPermohonanKTPController extends BaseController
{
    public function index()
    {
        $model = new SKeteranganPermohonanKTP();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Permohonan KTP',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return view('pages/dashboard/surat_keterangan_permohonan_ktp',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat keterangan permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat keterangan permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKeteranganPermohonanKTP();
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
                'message' => 'Gagal update surat keterangan permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update keterangan permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKeteranganPermohonanKTP();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat keterangan permohonan ktp'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganPermohonanKTP();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }

    public function getAll()
    {
        $model = new SKeteranganPermohonanKTP();
        return $this->response->setJSON($model->findAll());
    }

    public function getSingle($id)
    {
        $model = new SKeteranganPermohonanKTP();
        return $this->response->setJSON($model->find($id));
    }

    public function insert()
    {
        $model = new SKeteranganPermohonanKTP();
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
