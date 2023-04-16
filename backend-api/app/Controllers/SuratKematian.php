<?php

namespace App\Controllers;

use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;

class SuratKematian extends ResourceController
{
    protected $modelName = 'App\Models\SKematian';
    protected $format    = 'json';

    private function APIResponse($status, $error, $message)
    {
        $response = [
            'status' => $status,
            'error' => $error,
            'messages' => [
                'success' => $message
            ]
        ];
        return $response;
    }

    public function index()
    {
        $modelUser = new Users();
        $authHeader = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
        $user = $modelUser->where('token', $token)->first();
        
        if ($user['role'] === 'warga') {
            return $this->respond($this->model->where('author', $user['email'])->find());
        } else {
            return $this->respond($this->model->findAll());
        }
    }
    

    public function create()
    {
        $data = $this->request->getVar([
            'author',
            'nama_lengkap',
            'jenis_kelamin',
            'dilahirkan_di',
            'kelahiran_ke',
            'anak_ke',
            'penolong_kelahiran',
            'alamat_anak',
            'nik'
        ]);
        if ($this->model->where('author', $data['author'])->first()) {
            return $this->respondCreated($this->APIResponse(403, 'error', 'Anda sudah melakukan pembuatan surat, silahkan tunggu 1x24 jam!'));
        }

        $this->model->insert($data);
        return $this->respondCreated($this->APIResponse(201, 'success', 'Berhasil mengirim surat!'));
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $this->model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'data updated successfully'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'data deleted successfully'
            ]
        ];
        return $this->respondDeleted($response);
    }
}
