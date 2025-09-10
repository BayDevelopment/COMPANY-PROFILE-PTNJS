<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class HomeFirst extends Seeder
{
    public function run()
    {
        //
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'judul_jumbotron'    => "PT. Najwa Jaya Sukses",
                'paragraft_jumbo' => "Construction, Electrical, Mechanical, Civil, Painting, Scafolding, Insulation & Switchboard panel",
                'judul_about' => "About Us",
                'paragraft_about' => "PT. Najwa Jaya Sukses adalah perusahaan yang berdedikasi untuk menciptakan solusi inovatif dalam dunia konstruksi dan kelistrikan.",
                'image_about'   => 'backup_jumbo.svg',
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta')
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_home_first')->insert($data);
        }
    }
}
