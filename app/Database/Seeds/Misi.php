<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Misi extends Seeder
{
    public function run()
    {

        $data = [
            [
                'id_visi'   => 2,
                'misi'      => 'Menjadi perusahaan terkemuka yang menyediakan solusi konstruksi, elektrik, mekanikal, dan pengecatan yang inovatif dan berkelanjutan, dengan mengutamakan kualitas, efisiensi, dan teknologi modern dalam setiap proyek yang kami kerjakan.',
                'created_at' => Time::now('Asia/Jakarta'),
                'updated_at' => Time::now('Asia/Jakarta'),
            ],
            [
                'id_visi'   => 2,
                'misi'      => 'Inovasi dan Teknologi: Menggunakan teknologi terbaru dan metode konstruksi yang efisien untuk menciptakan solusi yang modern, ramah lingkungan, dan cost-effective dalam setiap proyek.',
                'created_at' => Time::now('Asia/Jakarta'),
                'updated_at' => Time::now('Asia/Jakarta'),
            ]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('tb_misi')->insertBatch($data);
    }
}
