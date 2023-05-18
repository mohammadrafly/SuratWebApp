<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKeteranganTidakMampu;
use App\Models\Users;

class KTidakMampuController extends BaseController
{
    public function index()
    {
        $model = new SKeteranganTidakMampu();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = [
                'content' => $model->findAll(),
                'title' => 'Keterangan Tidak Mampu',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_keterangan_tidak_mampu',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat keterangan tidak mampu'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat keterangan tidak mampu'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKeteranganTidakMampu();
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
                'message' => 'Gagal update surat keterangan tidak mampu'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update keterangan tidak mampu'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKeteranganTidakMampu();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat keterangan tidak mampu'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKeteranganTidakMampu();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
