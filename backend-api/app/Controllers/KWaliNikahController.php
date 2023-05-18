<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganWaliNikah;
use App\Models\Users;

class KWaliNikahController extends BaseController
{
    public function index()
    {
        $model = new SKeteranganWaliNikah();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = [
                'content' => $model->findAll(),
                'title' => 'Keterangan Wali Nikah',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_keterangan_wali_nikah',$data);
        }
        
        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat keterangan wali nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat keterangan wali nikah'
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
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal update surat keterangan wali nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update keterangan wali nikah'
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
            'message' => 'Berhasil delete surat keterangan wali nikah'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganWaliNikah();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
