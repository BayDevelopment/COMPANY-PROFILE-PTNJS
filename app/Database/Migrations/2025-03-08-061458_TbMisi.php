<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbMisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_misi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_visi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true
            ],
            'misi' => [
                'type'       => 'TEXT',
                'null'       => false
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ]
        ]);

        // Tambahkan Primary Key
        $this->forge->addPrimaryKey('id_misi');

        // Tambahkan Foreign Key
        $this->forge->addForeignKey('id_visi', 'tb_visi', 'id_visi', 'CASCADE', 'CASCADE');

        // Buat tabel
        $this->forge->createTable('tb_misi');
    }

    public function down()
    {
        // Hapus tabel jika rollback
        $this->forge->dropTable('tb_misi', true);
    }
}
