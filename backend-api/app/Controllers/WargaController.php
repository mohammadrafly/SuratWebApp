<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class WargaController extends BaseController
{
    public function index()
    {
        $model = new Users();
    
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'title' => 'Warga',
                'content' => $model->where('role', 'warga')->findAll(),
            ];
            return view('pages/dashboard/warga', $data);
        }
    
        $data = $this->request->getRawInput();
        $password = $data['password'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data['password'] = $hashedPassword;
        $data['role'] = 'warga';

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal menambah warga',
            ]);
        }
    
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil menambah warga',
        ]);
    }
    

    public function update($id)
    {
        $model = new Users();

        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON([
                'data' => $model->where('id', $id)->first(),
                'status' => true
            ]);
        }

        $data = $this->request->getRawInput();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal update warga',
            ]);
        }
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil update warga',
        ]);
    }

    public function delete($id)
    {
        $model = new Users();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil hapus warga',
        ]);
    }
}
