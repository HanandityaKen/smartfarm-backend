<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontrolPerangkat;

class KontrolController extends Controller
{
    // GET /api/kontrol
    public function index()
    {
        $kontrol = KontrolPerangkat::find(1);
        return response()->json($kontrol);
    }

    // PATCH /api/kontrol
    public function update(Request $request)
    {
        $kontrol = KontrolPerangkat::find(1);

        if (!$kontrol) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $kontrol->update($request->only([
            'lampu_dalam',
            'lampu_luar',
            'kipas',
            'trigger_pakan',
            'trigger_pompa'
        ]));

        return response()->json([
            'message' => 'Status kontrol berhasil diperbarui',
            'data' => $kontrol
        ]);
    }
}
