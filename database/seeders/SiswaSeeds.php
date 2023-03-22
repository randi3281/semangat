<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SiswaSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 100; $i++){
            DB::table('daftarsiswa')->insert([
                "nama" => $faker->name(),
                "nim" => $faker->randomNumber(4),
                "kelas" => $faker->address()

            ]);
        }
    }
}
