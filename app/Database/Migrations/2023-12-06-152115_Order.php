<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'userId' => [
                'type'       => 'INT',
                'null'       =>  false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'roomId' => [
                'type'       => 'INT',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'menuId' => [
                'type'       => 'INT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
