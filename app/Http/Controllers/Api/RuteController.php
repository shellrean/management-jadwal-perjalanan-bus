<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\Terminal;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutes = Rute::select([
            'id',
            'kode',
            'asal',
            'tujuan',
            'waktu_tempuh'
        ])->paginate(15);
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
            'checkpoints' => 'required|array'
        ]);

        $rute = Rute::create([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'kode' => $request->kode,
            'waktu_tempuh' => $request->waktu_tempuh,
            'checkpoints' => json_encode($request->checkpoints)
        ]);

        $rute->checkpoints = json_decode($rute->checkpoints, true);

        $terminals = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
            ->select('id', 'kode', 'nama', 'alamat', 'tipe')
            ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item['terminal'] = $terminals->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);

        return response()->json($rute);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show(Rute $rute)
    {
        $rute->checkpoints = json_decode($rute->checkpoints, true);
        $terminals = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
            ->select('id', 'kode', 'nama', 'alamat', 'tipe')
            ->get();

        $rute->checkpoints = array_map(function($item) use ($terminals) {
            $item['terminal'] = $terminals->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);

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
            'checkpoints' => 'required|array'
        ]);

        $rute->asal = $request->asal;
        $rute->tujuan = $request->tujuan;
        $rute->kode = $request->kode;
        $rute->waktu_tempuh = $request->waktu_tempuh;
        $rute->checkpoints = json_encode($request->checkpoints);
        $rute->save();

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
        return response()->json(['message' => 'rute deleted']);
    }
}
