<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKelahiran;
use App\Models\Users;

class KelahiranController extends BaseController
{
    public function index()
    {
        $model = new SKelahiran();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = [
                'content' => $model->findAll(),
                'title' => 'Kelahiran',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_kelahiran',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat kelahiran'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat kelahiran'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKelahiran();
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
                'message' => 'Gagal update kelahiran'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil update kelahiran'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKelahiran();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete kelahiran'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKelahiran();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
