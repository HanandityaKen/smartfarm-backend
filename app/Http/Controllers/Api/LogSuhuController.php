<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogSuhu;

class LogSuhuController extends Controller
{
    // GET: Ambil riwayat log suhu untuk Vue 3 Dashboard
    public function index()
    {
        $logs = LogSuhu::latest()->take(100)->get();

        return response()->json([
            'status' => 'success',
            'data' => $logs
        ], 200);
    }

    // POST: Menyimpan data baru yang dikirim oleh ESP32
    public function store(Request $request)
    {
        $validated = $request->validate([
            'suhu' => 'required|numeric',
            'batas_ambang' => 'nullable|numeric',
            'status_kipas' => 'required|in:ON,OFF',
            'mode_kontrol' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        // Auto-generate keterangan jika tidak dikirim dari ESP32
        if (empty($validated['keterangan'])) {
            $threshold = $validated['batas_ambang'] ?? 30.0;
            $validated['keterangan'] = $validated['suhu'] > $threshold 
                ? 'Suhu Tinggi (Peringatan)' 
                : 'Suhu Normal';
        }

        $log = LogSuhu::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Log suhu berhasil dicatat',
            'data' => $log
        ], 201);
    }
}
