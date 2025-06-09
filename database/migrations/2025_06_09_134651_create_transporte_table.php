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
        Schema::create('Transporte', function (Blueprint $table) {
            $table->id('id_vehiculo');
            $table->string('matricula', 10)->unique();
            $table->string('marca', 10);
            $table->string('modelo', 10);
            $table->integer('capacidad');
            $table->year('año');
            $table->boolean('disponible')->default(true);
            $table->boolean('activo')->default(true);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('Transporte');
    }
};
