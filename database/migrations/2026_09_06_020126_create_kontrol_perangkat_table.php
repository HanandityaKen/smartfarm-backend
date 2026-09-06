<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kontrol_perangkat', function (Blueprint $table) {
            $table->id();
            $table->boolean('lampu_dalam')->default(false);
            $table->boolean('lampu_luar')->default(false);
            $table->boolean('kipas')->default(false);
            $table->boolean('trigger_pakan')->default(false);
            $table->boolean('trigger_pompa')->default(false);
            $table->timestamps();
        });

        DB::table('kontrol_perangkat')->insert([
            'id' => 1,
            'lampu_dalam' => false,
            'lampu_luar' => false,
            'kipas' => false,
            'trigger_pakan' => false,
            'trigger_pompa' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrol_perangkat');
    }
};
