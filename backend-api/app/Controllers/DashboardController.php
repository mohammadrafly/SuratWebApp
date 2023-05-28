<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\SKelahiran;
use App\Models\SKematian;
use App\Models\SKeteranganBelumMenikah;
use App\Models\SKeteranganPenghasilan;
use App\Models\SKeteranganPermohonanKTP;
use App\Models\SKeteranganSKCK;
use App\Models\SKeteranganTidakMampu;
use App\Models\SKeteranganWaliNikah;
use App\Models\SPengantarNikah;
use App\Models\SPengantarPermohonanKTP;
use App\Models\SPernyataan;

class DashboardController extends BaseController
{
    public function index()
    {
        $modelUser = new Users();
        $modelKelahiran = new SKelahiran();
        $modelKematian = new SKematian();
        $modelBelumMenikah = new SKeteranganBelumMenikah();
        $modelPenghasilan = new SKeteranganPenghasilan();
        $modelKPermohonanKTP = new SKeteranganPermohonanKTP();
        $modelSKCK = new SKeteranganSKCK();
        $modelTidakMampu = new SKeteranganTidakMampu();
        $modelWaliNikah = new SKeteranganWaliNikah();
        $modelPengantarNikah = new SPengantarNikah();
        $modelPPermohonanKTP = new SPengantarPermohonanKTP();
        $modelPernyataan = new SPernyataan();
        $data = [
            'total_users' => $modelUser->countAllResults(),
            'total_kelahiran' => $modelKelahiran->countAllResults(),
            'total_kematian' => $modelKematian->countAllResults(),
            'total_k_belum_menikah' => $modelBelumMenikah->countAllResults(),
            'total_k_penghasilan' => $modelPenghasilan->countAllResults(),
            'total_k_permohonan_ktp' => $modelKPermohonanKTP->countAllResults(),
            'total_skck' => $modelSKCK->countAllResults(),
            'total_tidak_mampu' => $modelTidakMampu->countAllResults(),
            'total_wali_nikah' => $modelWaliNikah->countAllResults(),
            'total_pengantar_nikah' => $modelPengantarNikah->countAllResults(),
            'total_p_permohonan_ktp' => $modelPPermohonanKTP->countAllResults(),
            'total_pernyataan' => $modelPernyataan->countAllResults(),
        ];
        return view('pages/dashboard/index', $data);
    }

    public function myProfile($token)
    {
        $model = new Users();
        return $this->response->setJSON($model->where('token', $token)->first());
    }

    public function LogOut()
    {
        session()->destroy();
        return $this->response->setJSON([
            'status' => true, 
            'icon' => 'success', 
            'title' => 'Success!', 
            'text' => 'Logout berhasil.'
        ]);
    }
}
