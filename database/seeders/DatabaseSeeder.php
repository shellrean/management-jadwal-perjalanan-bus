<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BusTableSeeder::class);
        $this->call(SupirTableSeeder::class);
        $this->call(TerminalTableSeeder::class);
    }
}
