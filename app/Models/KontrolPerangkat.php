<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrolPerangkat extends Model
{
    protected $table = 'kontrol_perangkat';

    protected $fillable = [
        'lampu_dalam',
        'lampu_luar',
        'kipas',
        'trigger_pakan',
        'trigger_pompa',
    ];

    protected $casts = [
        'lampu_dalam' => 'boolean',
        'lampu_luar' => 'boolean',
        'kipas' => 'boolean',
        'trigger_pakan' => 'boolean',
        'trigger_pompa' => 'boolean',
    ];
}
