<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'name' => 'Alfian',
            'username' => 'Alfin',
            'email' => 'alfin@gmail.com',
            'password' => bcrypt('password'),
            'nisn' => '123456',
            'nis' => '123456',
            'kelas_id' => '2',
            'user_id' => '2',
            'angkatan' => 2023,
            'no_hp' => '09876500',
            'alamat' => 'Idn',
            'foto' => 'foto.jpg'
        ]);
    }
}
