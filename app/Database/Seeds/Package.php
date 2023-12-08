<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Package extends Seeder
{
    public function run()
    {
        $data = [
            'name'    => 'Paket 1',
            'price' => 400000,
            'description'   => 'Paket standard berisi 20 kuota',
            'quota' => 20,
        ];

        $data2 = [
            'name'    => 'Paket 2',
            'price' => 600000,
            'description'   => 'paket promo khusus desember berisi 40 kuota',
            'quota' => 40,
        ];

        $this->db->table('packages')->insert($data);
        $this->db->table('packages')->insert($data2);
    }
}
