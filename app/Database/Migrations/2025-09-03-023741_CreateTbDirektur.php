<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbDirektur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_direktur' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
            ],
            // 0 = tidak dipublikasikan, 1 = dipublikasikan (hanya boleh satu yg 1)
            'verified_handphone' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_direktur', true);
        $this->forge->createTable('tb_direktur', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_direktur', true);
    }
}
