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
            $table->unsignedBigInteger('id_vehiculo');
            $table->foreign('id_vehiculo')
                  ->references('id_vehiculo')
                  ->on('transporte')
                  ->onDelete('cascade');
                  
            $table->unsignedBigInteger('id_reserva');
            $table->foreign('id_reserva')
                  ->references('id_reserva') 
                  ->on('reserva')
                  ->onDelete('cascade');
                  
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transporte_reservas');
    }
};
