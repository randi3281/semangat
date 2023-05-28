<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Pegawai2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // data faker Indonesia
        $faker = Faker::create('id_ID');

        // membuat data dummy sebanyak 10 record
        for($x = 1; $x <= 10; $x++){

            // insert data dummy pegawai dengan faker
            DB::table('pegawai2')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address
            ]);
        }
    }
}
