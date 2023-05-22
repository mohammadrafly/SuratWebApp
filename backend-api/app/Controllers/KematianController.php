<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKematian;
use App\Models\Users;

class KematianController extends BaseController
{
    public function index()
    {
        $model = new SKematian();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Kematian',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return view('pages/dashboard/surat_kematian',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat kematian'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat kematian'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SKematian();
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
                'message' => 'Gagal update kematian'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil update kematian'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SKematian();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete kematian'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKematian();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }

    public function getAll()
    {
        $model = new SKematian();
        return $this->response->setJSON($model->findAll());
    }

    public function getSingle($id)
    {
        $model = new SKematian();
        return $this->response->setJSON($model->find($id));
    }

    public function insert()
    {
        $model = new SKematian();
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
