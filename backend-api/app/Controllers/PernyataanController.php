<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SPernyataan;
use App\Models\Users;

class PernyataanController extends BaseController
{
    public function index()
    {
        $model = new SPernyataan();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Pernyataan',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return view('pages/dashboard/surat_pernyataan',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat pernyataan'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat pernyataan'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SPernyataan();
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
                'message' => 'Gagal update surat pernyataan'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update pernyataan'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SPernyataan();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat pernyataan'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SPernyataan();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }

    public function getAll()
    {
        $model = new SPernyataan();
        return $this->response->setJSON($model->findAll());
    }

    public function getSingle($id)
    {
        $model = new SPernyataan();
        return $this->response->setJSON($model->find($id));
    }

    public function insert()
    {
        $model = new SPernyataan();
        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if ($model->insert($data)) {
            return $this->response->setJSON([
                'status' => true,
                'text' => 'Berhasil membuat surat'
            ]);
        }
    }
}
