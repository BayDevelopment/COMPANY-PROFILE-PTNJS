<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbServices extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_services' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'image_services' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'title_services' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug_services' => [
                'type'       => 'VARCHAR',
                'constraint' => '50', //menggunakan library UUID
            ],
            'deskripsi' => [
                'type'       => 'TEXT'
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
        $this->forge->addKey('id_services', true);
        $this->forge->createTable('tb_services');
    }

    public function down()
    {
        $this->forge->dropTable('tb_services');
    }
}
