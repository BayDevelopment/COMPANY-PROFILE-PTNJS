<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class About extends Seeder
{
    public function run()
    {
        //
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'image_about'    => "img_about.webp",
                'judul_about' => "PT. Najwa Jaya Sukses",
                'title_about' => "PT. Najwa Jaya Sukses adalah perusahaan yang berdedikasi untuk menciptakan solusi inovatif dalam dunia konstruksi dan kelistrikan. Dengan pengalaman yang luas dan tim profesional yang handal, kami hadir untuk membangun masa depan yang lebih baik melalui proyek-proyek yang berkualitas dan berkelanjutan. Kami percaya bahwa setiap bangunan dan sistem kelistrikan harus dirancang dengan ketelitian, keamanan, dan efisiensi. Oleh karena itu, PT. Najwa Jaya Sukses selalu berkomitmen untuk memberikan hasil terbaik, menggunakan teknologi terkini dan prinsip kerja yang mengutamakan kepuasan pelanggan.",
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta'),
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_about')->insert($data);
        }
    }
}
