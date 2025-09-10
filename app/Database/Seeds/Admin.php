<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use CodeIgniter\I18n\Time;

class Admin extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 1; $i++) {
            $data = [
                'nama'    => $faker->name(),
                'email' => $faker->email(),
                'password' => password_hash("bayudev", PASSWORD_ARGON2I),
                'no_hp' => '081212341234',
                'jabatan' => 'supervisor',
                'alamat' => $faker->address(),
                'status' => 'active',
                'role' => 'admin',
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta')
            ];

            // Simple Queries
            // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

            // Using Query Builder
            $this->db->table('tb_admin')->insert($data);
        }
    }
}
