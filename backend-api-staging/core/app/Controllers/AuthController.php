<?php

namespace App\Controllers;

use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function register()
    {
        $model = new Users();
        $data = $this->request->getVar([
            'name',
            'email',
        ]);
        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $data['role'] = 'warga';
        $model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Berhasil daftar'
            ]
        ];
        return $this->respondCreated($response);
    }

    public function login()
    {
        $model = new Users();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userData = $model->where('email', $email)->first();
        if (!$userData) {
            return $this->failNotFound('Email not found');
        }
        $hashPassword = $userData['password'];
        if (password_verify($password, $hashPassword)) {
            $response = [
                'status' => 200,
                'id' => $userData['id'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role'],
                'isLoggedIn' => true,
            ];
            return $this->respond($response);
        } else {
            return $this->failUnauthorized('Invalid password');
        }
    }
}
