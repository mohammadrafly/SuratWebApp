<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'nik',
        'email',
        'alamat',
        'nomor_hp',
        'foto_ktp',
        'password',
        'role',
        'token',
        'status',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function authenticate($email, $password)
    {
        $userData = $this->db->table('users')
                             ->where('email', $email)
                             ->get()->getResultArray();
        if (!$userData) {
            return null;
        }
        $hashPassword = $userData[0]['password'];
        if (password_verify($password, $hashPassword)) {
            return $userData[0];
        } else {
            return null;
        }
    }

    public function updateToken($email, $token)
    {
        return $this->db->table('users')
                        ->where('email', $email)
                        ->update(['token' => $token]);
    }
}
