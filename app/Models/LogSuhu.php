<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogSuhu extends Model
{
    use HasFactory;

    protected $table = 'log_suhus';

    protected $fillable = [
        'suhu',
        'batas_ambang',
        'status_kipas',
        'mode_kontrol',
        'keterangan',
    ];

    protected $casts = [
        'suhu' => 'float',
        'batas_ambang' => 'float',
        'created_at' => 'datetime',
    ];
}
