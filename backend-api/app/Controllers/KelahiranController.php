<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKelahiran;

class KelahiranController extends BaseController
{
    public function index()
    {
        $model = new SKelahiran();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = ['content' => $model->findAll()];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_kelahiran',$data);
        }

        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal menambahkan surat kelahiran'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil menambahkan surat kelahiran'
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
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update kelahiran'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil update kelahiran'
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
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil delete kelahiran'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKelahiran();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
