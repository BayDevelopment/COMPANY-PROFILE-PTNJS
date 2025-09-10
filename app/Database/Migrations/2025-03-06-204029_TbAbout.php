<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAbout extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_about' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'image_about' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'judul_about' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'title_about' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('id_about', true);
        $this->forge->createTable('tb_about');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_about');
    }
}
