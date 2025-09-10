<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbHomeFirst extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_home_first' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul_jumbotron' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'paragraft_jumbo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'judul_about' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'paragraft_about' => [
                'type'       => 'TEXT'
            ],
            'image_about' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id_home_first', true);
        $this->forge->createTable('tb_home_first');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_home_first');
    }
}
