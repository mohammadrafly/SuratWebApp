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
                'content' => $model->findAll(),
            ];
            return view('pages/dashboard/users', $data);
        }

        $data = [
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
        ];

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Gagal menambah user',
            ]);
        }
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil menambah user',
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

        $data = [
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
        ];

        if (!$model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Gagal update user',
            ]);
        }
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil update user',
        ]);
    }

    public function delete($id)
    {
        $model = new Users();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil hapus user',
        ]);
    }
}
