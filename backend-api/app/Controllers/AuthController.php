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
    
        if ($this->request->getMethod(true) === 'POST') {
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

        $checkPoint = $model->like('email', $email)
                            ->orLike('nik', $email)
                            ->get()
                            ->getResultArray();
        
        if (!$checkPoint[0]) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Email invalid.',
                'message' => 'Email invalid.'
            ]);
        }

        if (password_verify($password, $checkPoint[0]['password'])) {
            if ($isFrontEnd) {
                if ($checkPoint[0]['status'] != 'verified') {
                    return $this->response->setJSON([
                        'status' => false, 
                        'message' => 'Akun anda belum terverfikasi.'
                    ]);
                } else {
                    $token = $this->generateToken(100);
                    $data['token'] = $token;
                    $model->update($checkPoint[0]['id'], $data);
                    $this->setSession($checkPoint[0]);
                    return $this->response->setJSON([
                        'status' => true, 
                        'icon' => 'success', 
                        'title' => 'Success!', 
                        'text' => 'Login berhasil.',
                        'message' => 'Login berhasil.',
                        'dataUser' => $checkPoint[0],
                        'token' => $isFrontEnd ? $token : null
                    ]);
                }
            } elseif (!$isFrontEnd){
                if ($checkPoint[0]['role'] == 'warga') {
                    return $this->response->setJSON([
                        'status' => false,
                        'icon' => 'error',
                        'title' => 'Error!',
                        'text' => 'Invalid role or access denied.',
                        'message' => 'Invalid role or access denied.',
                        'dataUser' => null,
                        'token' => null
                    ]);
                } else {
                    $this->setSession($checkPoint[0]);
                    return $this->response->setJSON([
                        'status' => true, 
                        'icon' => 'success', 
                        'title' => 'Success!', 
                        'text' => 'Login berhasil.',
                        'message' => 'Login berhasil.',
                        'dataUser' => $checkPoint[0],
                        'token' => null
                    ]);
                }
            }            
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Password invalid.',
                'message' => 'Password invalid.'
            ]);
        }
    }

    function generateRandomFileName($originalFileName) {
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $randomFileName = uniqid() . '.' . $extension;
        return $randomFileName;
    }

    public function SignUp()
    {
        $model = new Users();
        $email = $this->request->getVar('email');

        if ($model->where('email', $email)->first()) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Email sudah digunakan.'
            ]);
        }

        $data = [
            'alamat' => $this->request->getVar('alamat'),
            'foto_ktp' => null,
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'nik' => $this->request->getVar('nik'),
            'email' => $email,
            'name' => $this->request->getVar('name'),
            'password' => null,
            'token' => $this->generateToken(100),
            'role' => 'warga',
            'status' => 'unverified'
        ];

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Gagal melakukan pendaftaran.'
            ]);
        }

        $emailService = \Config\Services::email();
        $emailService->setMailType('html')
            ->setTo($email)
            ->setFrom('suratapp@gmail.com', 'SWA')
            ->setSubject('Verifikasi Akun')
            ->setMessage(view('email/emailVerifying.php', $data))
            ->setNewLine("\r\n");
        $emailService->send("X-Priority: 1 (Highest)\n");

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil melakukan pendaftaran.'
        ]);
    }

    public function VerifikasiAkun($email, $token)
    {
        $model = new Users();
        $checkPoint = $model->where('email', $email)->first();
        
        if (!$checkPoint || $checkPoint['token'] !== $token) {
            return view('pages/auth/invalidVerifikasi');
        }
        
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'email' => $email,
                'token' => $token,
            ];
            return view('pages/auth/verifikasiAkun', $data);
        }

        $picture = $this->request->getFile('foto_ktp');
        
        if ($picture->isValid() && !$picture->hasMoved()) {
            $extension = $picture->getExtension();
            $randName = uniqid() . '.' . $extension;
            $picture->move('./uploads/foto_ktp', $randName);
            
            $data = [
                'foto_ktp' => $randName,
            ];
            
            $model->update($checkPoint['id'], $data);
            return $this->response->setJSON([
                'status' => true, 
                'icon' => 'success', 
                'title' => 'Success!', 
                'text' => 'Sukses melakukan verifikasi, silahkan tunggu konfirmasi dari admin.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Error!', 
                'text' => 'Gagal melakukan verifikasi, silahkan lakukan verifikasi ulang.'
            ]);
        }
    }

    public function resetPassword()
    {
        $model = new Users();
        $resetToken = new ResetPassword();
        $email = $this->request->getVar('email');
        $checkPoint = $model->where('email', $email)->where('status', 'verified')->first();
        if (!$checkPoint) {
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Error!', 
                'text' => 'Email invalid atau belum terverifikasi.'
            ]);
        }

        if ($resetToken->where('email', $email)->first()) {
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Error!', 
                'text' => 'Opps.. anda sudah meminta reset password! silahkan cek email anda.'
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

    public function newPassword($email, $token)
    {
        $usersModel = new Users();
        $tokenModel = new ResetPassword();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'email' => $email,
                'token' => $token,
                'page' => 'New Password'
            ];
            return view('pages/auth/ResetPassword', $data);
        }
        $password = $this->request->getVar('password');
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
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Error!', 
                'text' => 'Email invalid.'
            ]);
        }
    
        $tokenStatus = $this->checkTokenStatus($token, $tokenData);
    
        if (!$tokenStatus['isValid']) {
            $tokenModel->where('token', $token)->delete();
            return $this->response->setJSON([
                'status' => false, 
                'icon' => 'error', 
                'title' => 'Error!', 
                'text' => 'Token invalid.'
            ]);
        }
    
        $usersModel->update($user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        $tokenModel->where('token', $token)->delete();
        return $this->response->setJSON([
            'status' => true, 
            'icon' => 'success', 
            'title' => 'Success!', 
            'text' => 'Reset password berhasil.'
        ]);
    }
}
