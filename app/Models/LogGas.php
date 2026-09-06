<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogGas extends Model
{
    use HasFactory;

    protected $table = 'log_gases';

    protected $fillable = [
        'gas_ppm',
        'batas_gas',
        'jadwal_pembersihan',
        'keterangan',
    ];

    protected $casts = [
        'gas_ppm' => 'integer',
        'batas_gas' => 'integer',
        'created_at' => 'datetime',
    ];
}
