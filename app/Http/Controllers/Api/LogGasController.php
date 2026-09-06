<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogGas;

class LogGasController extends Controller
{
    // GET: Ambil riwayat log gas untuk Vue 3 Dashboard
    public function index()
    {
        $logs = LogGas::latest()->take(100)->get();

        return response()->json([
            'status' => 'success',
            'data' => $logs
        ], 200);
    }

    // POST: Menyimpan log gas dari ESP32
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gas_ppm' => 'required|integer',
            'batas_gas' => 'nullable|integer',
            'jadwal_pembersihan' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        if (empty($validated['keterangan'])) {
            $threshold = $validated['batas_gas'] ?? 2500;
            $validated['keterangan'] = $validated['gas_ppm'] > $threshold 
                ? 'Gas Melebihi Ambang' 
                : 'Kondisi Udara Normal';
        }

        $log = LogGas::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Log gas berhasil dicatat',
            'data' => $log
        ], 201);
    }
}
