<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/seeders/data/terminal.json");
        $data = json_decode($json);

        $data_final = [];
        foreach($data as $terminal) {
            $data_final[] = [
                "kode" => $terminal->id.uniqid(),
                "nama" => $terminal->name,
                "alamat" => isset($terminal->kota) ? $terminal->kota : "-".",".$terminal->province,
                "provinsi" => $terminal->province,
                "kota" => isset($terminal->kota) ? $terminal->kota : "-",
                "kecamatan" => implode("", array_slice(explode(" ", $terminal->name), 1)),
                "tipe" => "TERMINAL"
            ];
        }

        DB::table('terminals')->insert($data_final);
    }
}
