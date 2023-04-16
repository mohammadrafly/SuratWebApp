<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKelahiran;
use App\Models\Users;

class SuratAPIController extends BaseController
{
    public function getRecordById($id, $modelClassName)
    {
        $model = new $modelClassName();
        $data = $model->find($id);
        if (!$data) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Record not found']);
        }
        return $this->response->setJSON($data);
    }

    public function singleSuratKelahiran($id = null, $modelClassName = 'App\Models\SKelahiran')
    {
        return $this->getRecordById($id, $modelClassName);
    }

    public function singleSuratKematian($id = null, $modelClassName = 'App\Models\SKematian')
    {
        return $this->getRecordById($id, $modelClassName);
    }

    public function updateSurat()
    {
        $model = new SKelahiran();
        $modelUser = new Users();
        $data = $this->request->getJSON();

        $authHeader = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);
        $user = $modelUser->where('token', $token)->first();

        $id = $data->id;
        unset($data->id);
        $data->updated_at = date('Y-m-d H:i:s');
    
        $model->update($id, (array) $data);
        $response = [
            'success' => 'Update sukses'
        ];
        return $this->response->setStatusCode(201)->setJSON($response);
    }
}
