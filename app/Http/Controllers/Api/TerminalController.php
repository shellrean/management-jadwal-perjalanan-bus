<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $terminals = DB::table('terminals')
            ->where(function($query) use ($q) {
                $query->where('kode', 'like', '%'.$q.'%')
                    ->orWhere('nama', 'like', '%'.$q.'%')
                    ->orWhere('tipe', 'like', '%'.$q.'%');
            })
            ->orderByDesc('created_at')
            ->paginate();

        return response()->json($terminals);
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
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'tipe' => 'required|in:'.Terminal::TIPE_CHECKPOINT.','.Terminal::TIPE_TERMINAL.','.Terminal::TIPE_PUL
        ]);

        $terminal = Terminal::create($request->all());
        return response()->json($terminal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function show(Terminal $terminal)
    {
        return response()->json($terminal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Terminal $terminal)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'tipe' => 'required|in:'.Terminal::TIPE_CHECKPOINT.','.Terminal::TIPE_TERMINAL.','.Terminal::TIPE_PUL
        ]);

        $terminal->kode = $request->kode;
        $terminal->nama = $request->nama;
        $terminal->alamat = $request->alamat;
        $terminal->provinsi = $request->provinsi;
        $terminal->kota = $request->kota;
        $terminal->kecamatan = $request->kecamatan;
        $terminal->tipe = $request->tipe;
        $terminal->save();

        return response()->json($terminal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terminal $terminal)
    {
        $terminal->delete();
        return response()->json(['message' => 'terminal berhasil dihapus']);
    }
}
