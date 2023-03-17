<?php

namespace Database\Seeders;

use App\Models\Spp;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spp::create([
            'nominal' => 210000,
            'tahun' => 2023,
        ]);
    }
}
