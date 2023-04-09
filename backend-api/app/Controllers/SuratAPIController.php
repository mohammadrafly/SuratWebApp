<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SKelahiran;

class SuratAPIController extends BaseController
{
    public function singleSurat($id = null)
    {
        $model = new SKelahiran();
        $dataKelahiran = $model->where('id', $id)->first();
        return $this->response->setJSON($dataKelahiran);
    }

    public function updateSurat()
    {
        $model = new SKelahiran();
    
        $data = $this->request->getVar([
            'status_ttd',
            'disposisi_surat'
        ]);
        $id = $this->request->getVar('id');
        $data['updated_at'] = date('Y-m-d H:i:s');
    
        $model->update($id, $data);
        $response = [
            'success' => 'Update sukses'
        ];
        return $this->response->setStatusCode(201)->setJSON($response);
    }
    
}
