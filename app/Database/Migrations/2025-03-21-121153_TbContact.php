<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbContact extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_contact' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,  // Tambahkan agar lebih eksplisit
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_contact', true);
        $this->forge->createTable('tb_contact');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_contact');
    }
}
