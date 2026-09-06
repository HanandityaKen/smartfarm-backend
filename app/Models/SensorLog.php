<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    use HasFactory;

    protected $table = 'sensor_logs';

    protected $fillable = [
        'suhu',
        'gas_ppm',
        'sisa_pakan',
        'status_kipas',
    ];
}
