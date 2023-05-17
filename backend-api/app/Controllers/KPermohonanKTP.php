<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganPermohonanKTP;

class KPermohonanKTP extends BaseController
{
    public function index()
    {
        $model = new SKeteranganPermohonanKTP();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = ['content' => $model->findAll()];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_keterangan_permohonan_ktp',$data);
        }

        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal menambahkan surat keterangan permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil menambahkan surat keterangan permohonan ktp'
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
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update surat keterangan permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil surat update keterangan permohonan ktp'
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
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil delete surat keterangan permohonan ktp'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganPermohonanKTP();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
