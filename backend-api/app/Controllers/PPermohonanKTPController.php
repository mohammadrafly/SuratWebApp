<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SPengantarPermohonanKTP;

class PPermohonanKTPController extends BaseController
{
    public function index()
    {
        $model = new SPengantarPermohonanKTP();
        if ($this->request->getMethod(true) !== 'POST') {
            $isFrontEnd = $this->request->getVar('frontend');
            $data = ['content' => $model->findAll()];
            return $isFrontEnd ? $this->response->setJSON($model->findAll()) : view('pages/dashboard/surat_pengantar_permohonan_ktp',$data);
        }

        $data = $this->request->getRawInput();
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal menambahkan surat pengantar permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil menambahkan surat pengantar permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new SPengantarPermohonanKTP();
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
                'text' => 'Gagal update surat pengantar permohonan ktp'
            ];
        } else {
            $response = [
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Berhasil surat update pengantar permohonan ktp'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new SPengantarPermohonanKTP();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil delete surat pengantar permohonan ktp'
        ]);
    }

    public function getSuratByEmail($email)
    {
        $model = new SPengantarPermohonanKTP();
        return $this->response->setJSON($model->where('author', $email)->findAll());
    }
}
