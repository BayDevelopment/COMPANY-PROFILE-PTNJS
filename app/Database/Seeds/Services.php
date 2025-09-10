<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Ramsey\Uuid\Uuid;

class Services extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'image_services'    => "mecha_work.jpg",
                'title_services' => "Mechanic",
                'slug_services' => Uuid::uuid4()->toString(),
                'deskripsi' => "Seorang mechanic bertanggung jawab untuk melakukan perawatan, perbaikan, dan inspeksi teknis pada kendaraan, mesin, atau peralatan industri. Pekerjaan ini membutuhkan keahlian dalam diagnosis kerusakan, penggunaan alat mekanik, serta pemahaman sistem teknis untuk memastikan semua mesin bekerja dengan optimal dan aman.",
                'created_at'    => Time::now('Asia/Jakarta')
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_services')->insert($data);
        }
    }
}
