<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiSistem extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_sistem';

    protected $fillable = [
        'batas_gas',
        'batas_suhu',
        'jam_pakan_1',
        'jam_pakan_2',
        'jam_pakan_3',
        'jam_lampu_mati',
        'jam_lampu_nyala',
    ];

    public $timestamps = false;
}
