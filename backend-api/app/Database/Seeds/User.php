<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'email'    => 'admin@gmail.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'role'     => 'admin',
            'name'     => 'admin',
        ];
        $this->db->table('users')->insert($data);
    }
}
