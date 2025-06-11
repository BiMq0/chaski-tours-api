<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('ruta', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tour');
            $table->unsignedBigInteger('id_sitio');
            $table->integer('orden');
            $table->timestamps();

            $table->primary(['id_tour', 'id_sitio']);

            $table->foreign('id_tour')
                  ->references('id_tour')
                  ->on('tours')
                  ->onDelete('cascade');

            $table->foreign('id_sitio')
                  ->references('id_sitio')
                  ->on('sitio')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('ruta');
    }
};
