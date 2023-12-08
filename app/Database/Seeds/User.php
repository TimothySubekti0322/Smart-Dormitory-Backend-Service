<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'email'    => 'admin@gmail.com',
            'username' => 'admin',
            'roomId'   => 1,
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'quota'   => 0,
            'role'     => 'admin'
        ];

        $data2 = [
            'email'    => 'user@gmail.com',
            'username' => 'user',
            'roomId'   => 2,
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'quota'   => 0,
            'role'     => 'user'
        ];

        $this->db->table('users')->insert($data);
        $this->db->table('users')->insert($data2);
    }
}
