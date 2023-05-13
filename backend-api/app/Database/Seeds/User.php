<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = array(
            array(
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'name'     => 'admin',
            ),
            array(
                'email'    => 'warga@gmail.com',
                'password' => password_hash('warga', PASSWORD_DEFAULT),
                'role'     => 'warga',
                'name'     => 'Ahmad Kriptokurensi',
            ),
            array(
                'email'    => 'kepaladesa@gmail.com',
                'password' => password_hash('kepaladesa', PASSWORD_DEFAULT),
                'role'     => 'kepala_desa',
                'name'     => 'Bung Tomo',
            ),
        );
        
        $this->db->table('users')->insertBatch($data);
        
    }
}
