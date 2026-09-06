<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorLog;
use App\Models\KonfigurasiSistem;

class SensorController extends Controller
{
    public function getLogs() {
        $logs = SensorLog::latest()->take(10)->get()->reverse()->values();
        return response()->json(['status' => 'success', 'data' => $logs]);
    }

    public function storeLog(Request $request)
    {
        $validated = $request->validate([
            'suhu'         => 'required|numeric',
            'gas_ppm'      => 'required|integer',
            'sisa_pakan'   => 'required|numeric',
            'status_kipas' => 'required|string',
        ]);

        $log = SensorLog::create($validated);
        return response()->json(['status' => 'success', 'data' => $log], 201);
    }

    public function getConfig()
    {
        $config = KonfigurasiSistem::first();
        return response()->json(['status' => 'success', 'data' => $config]);
    }

    public function updateConfig(Request $request)
    {
        $validated = $request->validate([
            'batas_gas'       => 'nullable|numeric',
            'batas_suhu'      => 'nullable|numeric',
            'jam_pakan_1'     => 'nullable',
            'jam_pakan_2'     => 'nullable',
            'jam_pakan_3'     => 'nullable',
            'jam_lampu_mati'  => 'nullable',
            'jam_lampu_nyala' => 'nullable',
        ]);

        $config = KonfigurasiSistem::first();
        if ($config) {
            $config->update($validated);
        } else {
            $config = KonfigurasiSistem::create($validated);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Konfigurasi berhasil diperbarui',
            'data'    => $config
        ]);
    }
}
