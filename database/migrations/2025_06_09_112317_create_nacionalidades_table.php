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
    Schema::create('Nacionalidades', function (Blueprint $table) {
        $table->string('nacionalidad', 20)->primary();
        $table->string('prefijo_telefonico', 8);
        
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Nacionalidades');
    }
};
