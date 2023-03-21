<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeds extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 500; $i++){
            DB::table('pegawai')->insert([
                'Nama' => $faker->name,
                'Alamat' => $faker->address
            ]);
        }
    }
}
