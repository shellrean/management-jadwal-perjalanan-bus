<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::orderByDesc('created_at')->paginate(5);
        return response()->json($buses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_number' => 'required',
            'bus_number' => 'required',
            'distributor' => 'required',
            'ukuran' => 'required|int'
        ]);

        $bus = Bus::create([
            'plat_number' => $request->plat_number,
            'bus_number' => $request->bus_number,
            'distributor' => $request->distributor,
            'ukuran' => $request->ukuran
        ]);

        return response()->json($bus);
    }

    public function show(Bus $bus)
    {
        return response()->json($bus);
    }

    public function update(Bus $bus, Request $request)
    {
        $request->validate([
            'plat_number' => 'required',
            'bus_number' => 'required',
            'distributor' => 'required',
            'ukuran' => 'required|int'
        ]);

        $bus->plat_number = $request->plat_number;
        $bus->bus_number = $request->bus_number;
        $bus->distributor = $request->distributor;
        $bus->ukuran = $request->ukuran;
        $bus->save();

        return response()->json($bus);
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json();
    }
}
