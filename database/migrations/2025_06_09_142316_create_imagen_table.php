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
        Schema::create('Imagen', function (Blueprint $table) {
            $table->id('id_img');
            $table->unsignedBigInteger('id_sitio');
            $table->text('url_img');

            $table->foreign('id_sitio')
                ->references('id_sitio')
                ->on('Sitio')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen');
    }
};
