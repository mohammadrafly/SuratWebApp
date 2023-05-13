<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\ResetPassword;
use App\Models\Users;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
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

    private function setSession($userData)
    {
        return session()->set([
            'isLoggedIn' => TRUE,
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'role' => $userData['role'],
            'created_at' => $userData['created_at'],
        ]);
    }

    private function sendResetPasswordEmail($to, $data)
    {
        $email = \Config\Services::email();
        $email->setMailType('html')
            ->setTo($to)
            ->setFrom('suratapp@gmail.com', 'SWP')
            ->setSubject('Reset Password')
            ->setMessage(view('email/emailRwp.php', $data))
            ->setNewLine("\r\n");

        return $email->send("X-Priority: 1 (Highest)\n");
    }

    private function indonesiaLocalDate()
    {
        $timezone = new Time('now', 'Asia/Jakarta', 'id_ID');
        $current_date = $timezone->now();
        return $current_date->toLocalizedString('yyyy-MM-dd HH:mm:ss');

    }

    private function checkTokenStatus(string $token, ?array $tokenData): array
    {
        $tokenModel = new ResetPassword();
        if (!$tokenData) {
            return ['isValid' => false, 'message' => 'Invalid token!'];
        }
    
        if ($this->request->isAJAX() && $this->request->getMethod(true) === 'POST') {
            return ['isValid' => true];
        }
    
        if ($this->indonesiaLocalDate() > $tokenData['expired']) {
            return ['isValid' => false, 'message' => 'Token expired!'];
        }
    
        if (!$tokenModel->where('token', $token)->first()) {
            return ['isValid' => false, 'message' => 'Invalid token!'];
        }
    
        return ['isValid' => true];
    }    

    public function SignIn()
    {
        $model = new Users();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $isFrontEnd = $this->request->getVar('frontend');

        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/SignIn');
        }

        $checkPoint = $model->where('email', $email)->first();
        
        if (!$checkPoint) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Email invalid.'
            ]);
        }

        if (password_verify($password, $checkPoint['password'])) {
            if ($isFrontEnd) {
                $token = $this->generateToken(100);
                $data['token'] = $token;
                $model->update($checkPoint['id'], $data);
            }
            $this->setSession($checkPoint);
            return $this->response->setJSON([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Login berhasil.',
                'dataUser' => $checkPoint,
                'token' => $isFrontEnd ? $token : null
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Password invalid.'
            ]);
        }
    }

    public function SignUp()
    {
        $model = new Users();
        $data = [
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'warga'
        ];

        if ($model->where('email', $data['email'])->first()) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Email sudah digunakan.'
            ]);
        }

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Gagal melakukan pendaftaran.'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil melakukan pendaftaran.'
        ]);
    }

    public function resetPassword()
    {
        $model = new Users();
        $resetToken = new ResetPassword();
        if (!$this->request->isAJAX() || $this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/ResetPassword', ['page' => 'Reset Password']);
        }
        $email = $this->request->getPost('email');
        $checkPoint = $model->where('email', $email)->first();
        if (!$checkPoint) {
            return $this->response->setJSON([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Email invlaid.'
            ]);
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
                return $this->response->setJSON([
                    'status' => true, 
                    'icon' => 'success', 
                    'title' => 'Success!', 
                    'text' => 'Permintaan reset password berhasil.'
                ]);
            } else {
                $email = \Config\Services::email();
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }
        } else {
            return $this->response->setJSON([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Permintaan reset password gagal.'
            ]);
        }
    }

    public function newPassword(string $email, string $token)
    {
        $usersModel = new Users();
        $tokenModel = new ResetPassword();
        $password = $this->request->getPost('password');
        if (!$password) {
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Peringatan!', 
                'text' => 'Password tidak boleh kosong.'
            ]);
        }
        $user = $usersModel->where('email', $email)->first();
        $tokenData = $tokenModel->where('email', $email)->first();
    
        if (!$user) {
            return redirect()->to('/')->with('error', 'Invalid email!');
        }
    
        $tokenStatus = $this->checkTokenStatus($token, $tokenData);
    
        if (!$tokenStatus['isValid']) {
            $tokenModel->where('token', $token)->delete();
            return redirect()->to('/')->with('error', $tokenStatus['message']);
        }
    
        $usersModel->update($user['id'], ['password' => $password]);
        return $this->response->setJSON([
            'status' => true, 
            'icon' => 'success', 
            'title' => 'Success!', 
            'text' => 'Reset password berhasil.'
        ]);
        return view('pages/auth/NewPassword', ['page' => 'New Password']);
    }
}
