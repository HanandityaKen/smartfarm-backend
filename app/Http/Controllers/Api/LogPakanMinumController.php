<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogPakanMinum;

class LogPakanMinumController extends Controller
{
    // GET: Ambil riwayat log pakan & minum untuk Vue 3 Dashboard
    public function index()
    {
        $logs = LogPakanMinum::latest()->take(100)->get();

        // Mengambil log pakan terakhir & minum terakhir secara terpisah untuk kartu statistik
        $latestPakan = LogPakanMinum::where('jenis_aksi', 'Pakan')->latest()->first();
        $latestMinum = LogPakanMinum::where('jenis_aksi', 'Minum')->latest()->first();

        return response()->json([
            'status' => 'success',
            'data' => $logs,
            'latest_pakan' => $latestPakan,
            'latest_minum' => $latestMinum
        ], 200);
    }

    // POST: Menyimpan log pakan atau minum baru dari ESP32
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_aksi' => 'required|in:Pakan,Minum',
            'sisa_pakan' => 'nullable|numeric',
            'mode_kontrol' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        $log = LogPakanMinum::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Log aktivitas ' . strtolower($validated['jenis_aksi']) . ' berhasil dicatat',
            'data' => $log
        ], 201);
    }
}
