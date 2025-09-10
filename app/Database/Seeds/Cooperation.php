<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Cooperation extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_perusahaan'      => 'PT. Teknologi Cerdas',
                'alamat_perusahaan'    => 'Jl. Raya No. 123, Jakarta',
                'penanggung_jawab'     => 'Andi Wijaya',
                'jabatan'              => 'Direktur Utama',
                'telepon'              => '08123456789',
                'email'                => 'contact@teknologicerdas.com',
                'ruang_lingkup_kerjasama' => 'Pengembangan perangkat lunak',
                'proposal'             => 'proposal1.pdf',
                'profil_perusahaan'    => 'profil1.jpg',
                'dokumen_npwp'         => 'npwp1.pdf',
                'surat_pernyataan'     => 'surat_pernyataan1.pdf',
                'tanggal_pengajuan'    => Time::now('Asia/Jakarta'),
                'created_at'           => Time::now('Asia/Jakarta'),
                'updated_at'           => Time::now('Asia/Jakarta'),
            ]
        ];

        // Menyimpan data ke dalam tabel tb_pengajuan_kerjasama
        $this->db->table('tb_pengajuan_kerjasama')->insertBatch($data);
    }
}
