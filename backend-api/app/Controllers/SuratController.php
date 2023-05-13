<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKelahiran;

class SuratController extends BaseController
{
    public function suratKelahiran()
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

    public function suratKelahiranByEmail($email)
    {
        $model = new SKelahiran();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }

    public function suratKelahiranSingle($id)
    {
        $model = new SKelahiran();
        return $this->response->setJSON($model->find($id));
    }
    

    public function suratKelahiranUpdate($id)
    {

    }

    public function suratKelahiranDelete($id)
    {

    }
}
