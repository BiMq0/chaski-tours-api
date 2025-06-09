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
    Schema::create('Instituciones', function (Blueprint $table) {
        $table->string('cod_visitante', 10)->primary()->default('uwu');
        $table->string('nombre', 100);
        $table->string('correo_electronico', 50)->unique();
        $table->string('contrasenia', 255);
        $table->string('nacionalidad', 20);
        $table->string('telefono', 20)->nullable();
        $table->string('nombre_represent', 20);
        $table->string('ap_pat_represent', 20);
        $table->string('correo_electronico_represent', 50);
        $table->string('telefono_represent', 20);
        $table->timestamps();

        $table->foreign('cod_visitante')
                ->references('cod_visitante')
                ->on('Visitantes')
                ->onDelete('cascade');
        $table->foreign('nacionalidad')
                ->references('nacionalidad')
                ->on('Nacionalidades')
                ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
