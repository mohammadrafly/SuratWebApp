<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class UserController extends BaseController
{
    public function index()
    {
        $model = new Users();
    
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'title' => 'User',
                'content' => $model->findAll(),
            ];
            return view('pages/dashboard/users', $data);
        }
    
        $data = $this->request->getRawInput();
        $password = $data['password'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data['password'] = $hashedPassword;

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal menambah user',
            ]);
        }
    
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil menambah user',
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

        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal update user',
            ]);
        }
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil update user',
        ]);
    }

    public function delete($id)
    {
        $model = new Users();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil hapus user',
        ]);
    }
}
