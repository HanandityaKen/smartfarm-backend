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
        Schema::create('log_pakan_minums', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_aksi', ['Pakan', 'Minum']);   // Jenis aktivitas
            $table->float('sisa_pakan', 4, 1)->default(0.0);   // Persentase sisa pakan (misal 85.5)
            $table->string('mode_kontrol', 20)->default('Otomatis'); // Otomatis / Manual / Web
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_pakan_minums');
    }
};
