<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'  => 'Admin',
                'email'     => 'admin@example.com',
                'password'  => password_hash('password123', PASSWORD_DEFAULT),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'User',
                'email'     => 'user@example.com',
                'password'  => password_hash('user12345', PASSWORD_DEFAULT),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel users
        $this->db->table('users')->insertBatch($data);
    }
}
