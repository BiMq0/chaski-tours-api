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
        Schema::create('transporte_reservas', function (Blueprint $table) {
            $table->id('id_asignacion');
            $table->foreignId('id_vehiculo')->constrained('transporte')->onDelete('cascade');
            $table->foreignId('id_reserva')->constrained('reserva')->onDelete('cascade');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporte_reservas');
    }
};
