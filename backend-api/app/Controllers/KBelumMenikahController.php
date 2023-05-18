<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganBelumMenikah;
use App\Models\Users;

class KBelumMenikahController extends BaseController
{
    public function index()
    {
        $model = new SKeteranganBelumMenikah();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = [
                'content' => $model->findAll(),
                'title' => 'Keterangan Belum Menikah',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_keterangan_belum_menikah',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat keterangan belum menikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat keterangan belum menikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKeteranganBelumMenikah();
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
                'message' => 'Gagal update surat keterangan belum menikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update keterangan belum menikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKeteranganBelumMenikah();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat keterangan belum menikah'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganBelumMenikah();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
