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
        Schema::create('calendario_salidas', function (Blueprint $table) {
            $table->id('id_salida');
            $table->unsignedBigInteger('id_tour');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_regreso');
            $table->timestamps();

            $table->foreign('id_tour')->references('id_tour')->on('tours')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE calendario_salidas ADD CONSTRAINT chk_fechas_validas CHECK (fecha_regreso > fecha_salida)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_salidas');
    }
};
