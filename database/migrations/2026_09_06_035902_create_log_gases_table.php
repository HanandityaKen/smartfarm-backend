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
        Schema::create('log_gases', function (Blueprint $table) {
            $table->id();
            $table->integer('gas_ppm');   
            $table->integer('batas_gas')->default(2500);
            $table->string('jadwal_pembersihan')->default('-');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_gases');
    }
};
