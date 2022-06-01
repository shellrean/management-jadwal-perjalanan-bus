<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Rute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = DB::table('jadwals as t_0')
            ->join('buses as t_1', 't_0.bus_id', 't_1.id')
            ->join('supirs as t_2', 't_0.supir_id', 't_2.id')
            ->join('rutes as t_3', 't_0.rute_id', 't_3.id')
            ->whereDate('t_0.berangkat', now())
            ->select([
                't_0.*',
                't_1.bus_number',
                't_2.no_reg as supir_no_reg',
                't_2.nama_lengkap as supir_nama_lengkap',
                't_3.kode as rute_kode',
                't_3.waktu_tempuh as rute_waktu_tempuh'
            ])
            ->paginate(15);
        return response()->json($jadwal);
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
            'bus_id' => 'required|exists:buses,id',
            'supir_id' => 'required|exists:supirs,id',
            'rute_id' => 'required|exists:rutes,id',
            'berangkat' => 'required'
        ]);

        $rute = Rute::find($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable()->setTimezone('Asia/Jakarta');
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal = Jadwal::create([
            'bus_id' => $request->bus_id,
            'supir_id' => $request->supir_id,
            'rute_id' => $request->rute_id,
            'berangkat' => $berangkat,
            'tiba' => $tiba,
            'status' => Jadwal::NGY
        ]);

        return response()->json(['data' => $jadwal]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return response()->json(['data' => $jadwal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'supir_id' => 'required|exists:supirs,id',
            'rute_id' => 'required|exists:rutes,id',
            'berangkat' => 'required',
            'status' => 'required'
        ]);

        $rute = Rute::find($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable()->setTimezone('Asia/Jakarta');
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal->bus_id = $request->bus_id;
        $jadwal->supir_id = $request->supir_id;
        $jadwal->rute_id = $request->rute_id;
        $jadwal->berangkat = $berangkat;
        $jadwal->tiba = $tiba;
        $jadwal->status = $request->status;
        $jadwal->save();

        return response()->json($jadwal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json(['message' => 'jadwal deleted']);
    }
}
