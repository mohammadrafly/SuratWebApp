<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganWaliNikah;

class KWaliNikahController extends BaseController
{
    public function index()
    {
        $model = new SKeteranganWaliNikah();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = ['content' => $model->findAll()];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_keterangan_wali_nikah',$data);
        }

        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal menambahkan surat keterangan wali nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil menambahkan surat keterangan wali nikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKeteranganWaliNikah();
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
                'text' => 'Gagal update surat keterangan wali nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil surat update keterangan wali nikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKeteranganWaliNikah();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil delete surat keterangan wali nikah'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganWaliNikah();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
