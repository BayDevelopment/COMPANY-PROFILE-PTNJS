<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class Visi extends Seeder
{
    public function run()
    {
        //
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'visi'    => "Menjadi perusahaan terkemuka yang menyediakan solusi konstruksi, elektrik, mekanikal, dan pengecatan yang inovatif dan berkelanjutan, dengan mengutamakan kualitas, efisiensi, dan teknologi modern dalam setiap proyek yang kami kerjakan..",
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta')
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_visi')->insert($data);
        }
    }
}
