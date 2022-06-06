<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            ['plat_number' => 'B98012JK', 'bus_number' => 'AKP-20220101-001-AKL', 'distributor' => 'SCANIA', 'ukuran' => 20],
            ['plat_number' => 'B98013JK', 'bus_number' => 'AKP-20220101-002-AKB', 'distributor' => 'HINO', 'ukuran' => 21],
            ['plat_number' => 'B98014JK', 'bus_number' => 'AKP-20220101-002-AKB', 'distributor' => 'HINO', 'ukuran' => 21],
            ['plat_number' => 'B98015JK', 'bus_number' => 'AKP-20220101-002-AKA', 'distributor' => 'MICHELIN', 'ukuran' => 25],
            ['plat_number' => 'B98016JK', 'bus_number' => 'AKP-20220101-002-AKD', 'distributor' => 'SCANIA', 'ukuran' => 10],
            ['plat_number' => 'B98017JK', 'bus_number' => 'AKP-20220101-002-AKC', 'distributor' => 'SCANIA', 'ukuran' => 15],
        ]);
    }
}
