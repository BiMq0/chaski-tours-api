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
        Schema::create('turistas', function (Blueprint $table) {
            $table->string('cod_visitante', 10)->primary()->default('uwu');
            $table->string('correo_electronico', 50)->unique();
            $table->string('contrasenia', 255);
            $table->string('documento', 20);
            $table->string('nombre', 20);
            $table->string('ap_pat', 20);
            $table->string('ap_mat', 20)->nullable();
            $table->date('fecha_nac');
            $table->string('nacionalidad', 20);
            $table->string('telefono', 20);
            $table->timestamps();

            $table->foreign('cod_visitante')->references('cod_visitante')->on('visitantes')->onDelete('cascade');
            $table->foreign('nacionalidad')->references('nacionalidad')->on('nacionalidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turistas');
    }
};
