<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('pages/dashboard/index');
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
