<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('Habitacion', function (Blueprint $table) {
        $table->integer('nro_habitacion');
        $table->unsignedBigInteger('id_alojamiento');
        $table->enum('tipo_habitacion', ['Individual', 'Doble', 'Suite', 'Familiar']);
        $table->integer('capacidad');
        $table->boolean('disponible')->default(true);

        $table->primary(['nro_habitacion', 'id_alojamiento']);
        $table->foreign('id_alojamiento')
              ->references('id_alojamiento')
              ->on('Alojamiento')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion');
    }
};
