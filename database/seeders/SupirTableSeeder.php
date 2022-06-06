<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supirs')->insert([
            ['no_reg' => 'INLM-90123-20220101', 'nama_lengkap' => 'Hendra Mahesa', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90124-20220101', 'nama_lengkap' => 'Siti Herlina', 'alamat' => 'Jakarta', 'jk' => 'P'],
            ['no_reg' => 'INLM-90125-20220101', 'nama_lengkap' => 'Agustia Ramadhani', 'alamat' => 'Jakarta', 'jk' => 'P'],
            ['no_reg' => 'INLM-90126-20220101', 'nama_lengkap' => 'Cahyono Librani', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90127-20220101', 'nama_lengkap' => 'Arif Mahesa', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90128-20220101', 'nama_lengkap' => 'Rian Andrian', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90129-20220101', 'nama_lengkap' => 'Sunandar', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90130-20220101', 'nama_lengkap' => 'Tresno Mahungka', 'alamat' => 'Jakarta', 'jk' => 'L'],
            ['no_reg' => 'INLM-90131-20220101', 'nama_lengkap' => 'Jack Amri', 'alamat' => 'Jakarta', 'jk' => 'L']
        ]);
    }
}
