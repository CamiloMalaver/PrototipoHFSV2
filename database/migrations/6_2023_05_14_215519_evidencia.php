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
        Schema::create('evidencia', function (Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('funcion_sustantiva_id');
            $table->foreign('funcion_sustantiva_id')->references('id')->on('funcion_sustantiva');
            
            $table->string('nombre_archivo', 500);
            $table->string('url', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
