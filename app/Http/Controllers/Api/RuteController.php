<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $rutes = DB::table('rutes as t_0')
            ->join('terminals as t_1', 't_0.asal', 't_1.id')
            ->join('terminals as t_2', 't_0.tujuan', 't_2.id')
            ->select([
                't_0.id',
                't_0.kode',
                't_1.provinsi as asal',
                't_1.kode as asal_kode',
                't_1.nama as asal_nama',
                't_2.provinsi as tujuan',
                't_2.kode as tujuan_kode',
                't_2.nama as tujuan_nama',
                't_0.waktu_tempuh'
            ])->orderBy('t_0.created_at')
            ->where('t_0.kode', 'like', '%'.$q.'%')
            ->paginate(15);
        return response()->json($rutes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'asal'  => 'required',
            'tujuan' => 'required',
            'kode' => 'required',
            'waktu_tempuh' => 'required|int',
            'checkpoints' => 'array'
        ]);

        $rute = Rute::create([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'kode' => $request->kode,
            'waktu_tempuh' => $request->waktu_tempuh
        ]);

        $rute_checkpoints = [];
        foreach($request->checkpoints as $checkpoint) {
            $rute_checkpoints[] = [
                'checkpoint_code' => $checkpoint['code'],
                'terminal_id' => $checkpoint['id'],
                'rute_id' => $rute->id,
                'waktu' => $checkpoint['waktu'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('rute_checkpoints')->insert($rute_checkpoints);

        return response()->json(['message' => 'rute berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rute = DB::table('rutes as t_0')
            ->join('terminals as t_1', 't_0.asal', 't_1.id')
            ->join('terminals as t_2', 't_0.tujuan', 't_2.id')
            ->select([
                't_0.id',
                't_0.kode',
                't_1.id as asal',
                't_1.provinsi as asal_provinsi',
                't_1.kode as asal_kode',
                't_1.nama as asal_nama',
                't_1.tipe as asal_tipe',
                't_2.id as tujuan',
                't_2.provinsi as tujuan_provinsi',
                't_2.kode as tujuan_kode',
                't_2.nama as tujuan_nama',
                't_2.tipe as tujuan_tipe',
                't_0.waktu_tempuh'
            ])
            ->where('t_0.id', $id)->first();

        $checkpoints = DB::table('rute_checkpoints')->where('rute_id', $id)->get();

        $terminals = Terminal::whereIn('id', $checkpoints->pluck('terminal_id'))
            ->select('id', 'kode', 'nama', 'alamat', 'tipe')
            ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item->terminal = $terminals->where('id', $item->terminal_id)->first();
            return $item;
        }, $checkpoints->toArray());

        return $rute;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rute $rute)
    {
        $request->validate([
            'asal'  => 'required',
            'tujuan' => 'required',
            'kode' => 'required',
            'waktu_tempuh' => 'required|int',
            'checkpoints' => 'array'
        ]);

        $rute->asal = $request->asal;
        $rute->tujuan = $request->tujuan;
        $rute->kode = $request->kode;
        $rute->waktu_tempuh = $request->waktu_tempuh;
        $rute->save();

        DB::table('rute_checkpoints')->where('rute_id', $rute->id)->delete();
        $rute_checkpoints = [];
        foreach($request->checkpoints as $checkpoint) {
            $rute_checkpoints[] = [
                'checkpoint_code' => $checkpoint['code'],
                'terminal_id' => $checkpoint['id'],
                'rute_id' => $rute->id,
                'waktu' => $checkpoint['waktu'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('rute_checkpoints')->insert($rute_checkpoints);

        return response()->json(['message' => 'data updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rute $rute)
    {
        $rute->delete();
        DB::table('rute_checkpoints')->where('rute_id', $rute->id)->delete();
        return response()->json(['message' => 'rute deleted']);
    }
}
