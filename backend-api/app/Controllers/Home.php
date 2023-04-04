<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('pages/home');
    }

    public function login()
    {
        return view('pages/auth/SignIn');
    }

    public function register()
    {
        return view('pages/auth/SignUp');
    }
}
