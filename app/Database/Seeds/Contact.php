<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Contact extends Seeder
{
    public function run()
    {
        //
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'name'    => "Jefri",
                'email' => "jefri@gmail.com",
                'message' => "Hai, Testing Contact Message",
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta')
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_contact')->insert($data);
        }
    }
}
