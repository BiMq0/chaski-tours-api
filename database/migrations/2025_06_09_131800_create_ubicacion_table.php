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
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id('id_ubicacion');
            $table->enum('departamento', [
                'La Paz', 
                'Santa Cruz', 
                'Cochabamba', 
                'Potosí', 
                'Oruro', 
                'Tarija', 
                'Chuquisaca', 
                'Beni', 
                'Pando'
            ]);
            $table->string('municipio', 30);
            $table->string('zona', 30);
            $table->string('calle', 30);
            $table->decimal('latitud', 10, 6);
            $table->decimal('longitud', 10, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};
