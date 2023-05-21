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
        Schema::create('funcion_sustantiva', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->string('lugar', 80);
            $table->string('descripcion_actividad', 1000)->nullable();
            $table->string('observaciones', 500)->nullable();
            $table->string('observaciones_auditor', 500)->nullable();
            
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estado');

            $table->unsignedBigInteger('tipo_funcion_id');
            $table->foreign('tipo_funcion_id')->references('id')->on('tipo_funcion');

            $table->tinyInteger('is_drop')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
