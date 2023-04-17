<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\PasswordToken;
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

    private function setSession(array $userData): bool
    {
        $sessionData = [
            'isLoggedIn' => true,
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'role' => $userData['role'],
            'created_at' => $userData['created_at'],
        ];
    
        session()->set($sessionData);
    
        return true;
    }

    private function notificationMessage(array $fields)
    {
        return $this->response->setJSON($fields);
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
        $tokenModel = new PasswordToken();
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
        if (!$this->request->isAJAX() || $this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/SignIn', ['page' => 'Sign In']);
        }
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $checkPoint = $model->where('email', $email)->first();
        if (isset($checkPoint) && isset($checkPoint['password'])) {
            if (password_verify($password, $checkPoint['password'])) {
                if ($checkPoint['role'] !== 'warga') {
                    $this->setSession($checkPoint);
                    $response = $this->notificationMessage([
                        'status' => true, 
                        'icon' => 'success', 
                        'title' => 'Success!', 
                        'text' => 'Login berhasil.'
                    ]);
                    return $response;
                } else {
                    $response = $this->notificationMessage([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Caution!',
                        'text' => 'Citizen are not allowed.',
                    ]);
                    return $response;
                }
            } else {
                $response = $this->notificationMessage([
                    'status' => false,
                    'icon' => 'error',
                    'title' => 'Peringatan!',
                    'text' => 'Password invalid.',
                ]);
                return $response;
            }
        } else {
            $response = $this->notificationMessage([
                'status' => false,
                'icon' => 'error',
                'title' => 'Peringatan!',
                'text' => 'Email invalid.',
            ]);
            return $response;
        }

    }

    public function SignUp()
    {
        $model = new Users();
        if (!$this->request->isAJAX() || $this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/SignUp', ['page' => 'Sign Up']);
        }
        $data = $this->request->getPost([
            'name',
            'email',
            'password'
        ]);
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $data['role'] = 'warga';
        if ($model->where('email', $data['email'])->first()) {
            $response = $this->notificationMessage([
                'status' => false,
                'icon' => 'error',
                'title' => 'Peringatan!',
                'text' => 'Email telah digunakan.',
            ]);
            return $response;
        }
        $model->insert($data);
        $response = $this->notificationMessage([
            'status' => true, 
            'icon' => 'success', 
            'title' => 'Success!', 
            'text' => 'Daftar berhasil.'
        ]);
        return $response;
    }

    public function resetPassword()
    {
        $model = new Users();
        $resetToken = new PasswordToken();
        if (!$this->request->isAJAX() || $this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/ResetPassword', ['page' => 'Reset Password']);
        }
        $email = $this->request->getPost('email');
        $checkPoint = $model->where('email', $email)->first();
        if (!$checkPoint) {
            $response = $this->notificationMessage([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Email invlaid.'
            ]);
            return $response;
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
                $response = $this->notificationMessage([
                    'status' => true, 
                    'icon' => 'success', 
                    'title' => 'Success!', 
                    'text' => 'Permintaan reset password berhasil.'
                ]);
                return $response;
            } else {
                $email = \Config\Services::email();
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }
        } else {
            $response = $this->notificationMessage([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Permintaan reset password gagal.'
            ]);
            return $response;
        }
    }

    public function newPassword(string $email, string $token)
    {
        $usersModel = new Users();
        $tokenModel = new PasswordToken();
        $password = $this->request->getPost('password');
        if (!$password) {
            $this->notificationMessage(false, 'error', 'Peringatan!', 'Password cannot be nulled.');
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
        $this->notificationMessage(true, 'success', 'Success!', 'Password reset successful.');
        return view('pages/auth/NewPassword', ['page' => 'New Password']);
    }
}
