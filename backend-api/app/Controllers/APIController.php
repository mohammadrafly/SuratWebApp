<?php

namespace App\Controllers;

use App\Models\PasswordToken;
use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $format = 'json';

    function generateToken($length = 150)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomCharacter = $characters[mt_rand(0, strlen($characters) - 1)];
            $token .= $randomCharacter;
        }
        
        return $token;
    }

    private function resetPasswordData($token, $email, $expired)
    {
        return [
            'token' => $token,
            'email' => $email,
            'expired' => $expired
        ];
    }

    private function oneHourFromNowIs() 
    {
        helper('date');
        date_default_timezone_set('Asia/Jakarta');
        $now = time();
        $one_hour_later = strtotime('+1 hour', $now);
        $date_one_hour_later = date('Y-m-d H:i:s', $one_hour_later);
        return $date_one_hour_later;
    }

    private function sendResetPasswordEmail($to, $data)
    {
        $email = \Config\Services::email();
        $email->setMailType('html')
            ->setTo($to)
            ->setFrom('suratwebapp@gmail.com', 'SWP')
            ->setSubject('Reset Password')
            ->setMessage(view('email/emailRwp.php', $data))
            ->setNewLine("\r\n");

        return $email->send("X-Priority: 1 (Highest)\n");
    }

    private function APIResponse($status, $error, $message)
    {
        $response = [
            'status' => $status,
            'error' => $error,
            'messages' => [
                'success' => $message
            ]
        ];
        return $response;
    }

    public function myProfile($token)
    {
        $model = new Users();
        $dataUser = $model->where('token', $token)->first();
        return $this->response->setJSON([
            'token' => $token,
            'name' => $dataUser['name'],
            'email'=> $dataUser['email'],
            'role' => $dataUser['role'],
        ]);
    }

    public function register()
    {
        $model = new Users();
        $data = $this->request->getVar([
            'name',
            'email',
        ]);
        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $data['role'] = 'warga';
        if ($model->where('email', $data['email'])->first()) {
            return $this->respondCreated($this->APIResponse(400, 'error', 'Email telah digunakan!'));
        }

        $model->insert($data);
        return $this->respondCreated($this->APIResponse(201, 'success', 'Berhasil daftar!'));
    }

    public function login()
    {
        $model = new Users();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userData = $model->where('email', $email)->first();
        if (!$userData) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Email tidak ada di database.']);
        }
    
        if (!password_verify($password, $userData['password'])) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Password salah.']);
        }
    
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $model->updateToken($email, $token);
        $response = $this->response->setJSON(['token' => $token]);
        return $response;
    }

    public function sendEmailLinkResetPassword()
    {
        $model = new Users();
        $resetToken = new PasswordToken();
        $email = $this->request->getVar('email');
        $checkPoint = $model->where('email', $email)->first();
        if (!$checkPoint) {
            return $this->respondCreated($this->APIResponse(false, 'error', 'Email invalid'));
        } elseif ($resetToken->where('email', $checkPoint['email'])->first()) {
            return $this->respondCreated($this->APIResponse(false, 'error', 'You already send request, please try again later.'));
        }
        $token = $this->generateToken(150);
        $data = [
            'email' => $email,
            'name' => $checkPoint['name'],
            'token' => $token,
        ];
        if ($resetToken->insert($this->resetPasswordData($token, $email, $this->oneHourFromNowIs()))) {
            $emailSent = $this->sendResetPasswordEmail($email, $data);
            if ($emailSent) {
                return $this->respondCreated($this->APIResponse(201, 'success', 'Permintaan reset password berhasil!'));
            } else {
                $email = \Config\Services::email();
                $data = $email->printDebugger(['headers']);
                return $this->respondCreated($this->APIResponse(400, 'error', $data));
            }
        } else {
            return $this->respondCreated($this->APIResponse(400, 'error', 'Permintaan reset password gagal!'));
        }
    }
}
