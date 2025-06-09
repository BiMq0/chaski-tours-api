<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id('id_reserva'); 
            $table->string('cod_visitante', 10);
            $table->unsignedBigInteger('id_salida');
            $table->integer('cantidad_personas');
            $table->double('costo_total_reserva', 10, 2);
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Completada'])->default('Pendiente');
            $table->timestamp('fecha_reservacion')->useCurrent();

            
            $table->foreign('cod_visitante')
                  ->references('cod_visitante')
                  ->on('visitantes')
                  ->onDelete('cascade');

            $table->foreign('id_salida')
                  ->references('id_salida')
                  ->on('calendario_salidas')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
