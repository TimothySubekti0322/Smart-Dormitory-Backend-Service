<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menu extends Seeder
{
    public function run()
    {
        $data = [
            'imgpath' => 'http://localhost:8080/uploads/mie_goreng.png',
            'name' => 'Mie Goreng',
            'description'   => 'Mie Goreng dengan topping ayam, sosis, dan sayur',
            'date' => '2023/12/17',
            'category' => 'pagi',
        ];

        $data2 = [
            'imgpath' => 'http://localhost:8080/uploads/nasi_katsu.png',
            'name' => 'Nasi Katsu Curry',
            'description'   => 'Ayam goreng katsu dengan kuah curry penuh topping kentang dan wortel dan satu porsi nasi',
            'date' => '2023/12/17',
            'category' => 'malam',
        ];

        $this->db->table('menus')->insert($data);
        $this->db->table('menus')->insert($data2);
    }
}
