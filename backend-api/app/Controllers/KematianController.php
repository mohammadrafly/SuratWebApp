<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKematian;

class KematianController extends BaseController
{
    public function index()
    {
        $model = new SKematian();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = ['content' => $model->findAll()];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_kematian',$data);
        }

        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal menambahkan surat kematian'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil menambahkan surat kematian'
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
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update kematian'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil update kematian'
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
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil delete kematian'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SKematian();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
