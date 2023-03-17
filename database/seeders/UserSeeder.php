<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrator',
            'username' => 'administrator',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('administrator'),
            'level' => 'administrator'
        ]);
    }
}
