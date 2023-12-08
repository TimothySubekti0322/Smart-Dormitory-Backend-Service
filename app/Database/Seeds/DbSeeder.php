<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DbSeeder extends Seeder
{
    public function run()
    {
        $this->call('Menu');
        $this->call('Package');
        $this->call('User');
        $this->call('Order');
    }
}
