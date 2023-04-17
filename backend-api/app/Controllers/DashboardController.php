<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class DashboardController extends BaseController
{
    private function notificationMessage(array $fields)
    {
        return $this->response->setJSON($fields);
    }

    public function index()
    {
        return view('pages/dashboard/index');
    }

    public function DataUsers()
    {
        $model = new Users();
        $data = [
            'content' => $model->findAll(),
        ];
        return view('pages/dashboard/users', $data);
    }

    public function LogOut()
    {
        session()->destroy();
        $response = $this->notificationMessage([
            'status' => true, 
            'icon' => 'success', 
            'title' => 'Success!', 
            'text' => 'Logout berhasil.'
        ]);
        return $response;
    }
}
