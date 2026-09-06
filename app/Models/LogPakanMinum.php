<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogPakanMinum extends Model
{
    use HasFactory;

    protected $table = 'log_pakan_minums';

    protected $fillable = [
        'jenis_aksi',
        'sisa_pakan',
        'mode_kontrol',
        'keterangan',
    ];

    protected $casts = [
        'sisa_pakan' => 'float',
        'created_at' => 'datetime',
    ];
}
