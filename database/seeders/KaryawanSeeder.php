<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Date;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawans')->insert([
            'name' => 'udin',
            'gender' => 'male',
            'address' => 'padang',
            'photo' => '-',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
