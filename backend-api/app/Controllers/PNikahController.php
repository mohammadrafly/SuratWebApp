<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SPengantarNikah;
use App\Models\Users;

class PNikahController extends BaseController
{
    public function index()
    {
        $model = new SPengantarNikah();
        $user = new Users();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = [
                'content' => $model->findAll(),
                'title' => 'Pengantar Nikah',
                'email' => $user->where('role', 'warga')->findAll(),
            ];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_pengantar_nikah',$data);
        }

        $data = $this->request->getRawInput();
        if ($this->request->getVar('frontend')) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Gagal menambahkan surat pengantar nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil menambahkan surat pengantar nikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SPengantarNikah();
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
                'message' => 'Gagal update surat pengantar nikah'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Berhasil surat update pengantar nikah'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SPengantarNikah();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Berhasil delete surat pengantar nikah'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SPengantarNikah();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
