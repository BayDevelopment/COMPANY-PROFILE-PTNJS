<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cooperation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengajuan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_perusahaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'alamat_perusahaan' => [
                'type'       => 'TEXT',
                'null' => false
            ],
            'penanggung_jawab' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null' => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique'     => true, // email harus unik
            ],
            'ruang_lingkup_kerjasama' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Construction',
                    'Electrical',
                    'Mechanical',
                    'Civil',
                    'Painting',
                    'Scafolding',
                    'Insulation',
                ],
                'null' => false,
            ],
            'proposal' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'profil_perusahaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'dokumen_npwp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'surat_pernyataan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'tanggal_pengajuan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status_pengajuan' => [
                'type' => 'ENUM',
                'constraint' => ['Menunggu persetujuan', 'Diproses', 'Diterima', 'Dibatalkan'],
                'default' => 'Menunggu persetujuan',
            ],
            'alasan' => [ // catatan bila ditolak/dibatalkan
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
            ]
        ]);
        $this->forge->addKey('id_pengajuan', true);
        $this->forge->createTable('tb_pengajuan_kerjasama');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pengajuan_kerjasama');
    }
}
