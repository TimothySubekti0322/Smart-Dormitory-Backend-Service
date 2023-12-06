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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            'roomId' => [
                'type'       => 'INT',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique' => true
            ],
            'menuId' => [
                'type'       => 'INT',

            ],
        ]);
        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('menuId', 'menu', 'id');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
