<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbVisi extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_visi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'visi' => [
                'type'       => 'TEXT',
                'null'       => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_visi', true);
        $this->forge->createTable('tb_visi');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_visi');
    }
}
