<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin_password', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
            [
                'username' => 'user',
                'password' => password_hash('user_password', PASSWORD_DEFAULT),
                'role'     => 'user',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
