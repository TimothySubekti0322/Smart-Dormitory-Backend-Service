<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Order extends Seeder
{
    public function run()
    {
        $data = [
            'userId'    => 2,
            'name' => 'user',
            'roomId'   => 2,
            'phone' => '081234567890',
            'menuId' => 1,
        ];

        $data2 = [
            'userId'    => 2,
            'name' => 'user',
            'roomId'   => 2,
            'phone' => '081234567890',
            'menuId' => 2,
        ];

        $this->db->table('orders')->insert($data);
        $this->db->table('orders')->insert($data2);
    }
}
