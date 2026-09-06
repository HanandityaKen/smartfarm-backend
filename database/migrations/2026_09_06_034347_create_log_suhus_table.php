<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_suhus', function (Blueprint $table) {
            $table->id();
            $table->float('suhu', 4, 1); // Memuat nilai suhu, misal: 32.5
            $table->float('batas_ambang', 4, 1)->default(30.0); // Threshold batas suhu
            $table->enum('status_kipas', ['ON', 'OFF'])->default('OFF');
            $table->string('mode_kontrol', 20)->default('Otomatis'); // Otomatis / Manual
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_suhus');
    }
};
