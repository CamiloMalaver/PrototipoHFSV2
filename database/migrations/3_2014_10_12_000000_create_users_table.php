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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('documento')->length(50)->unique();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            
            $table->bigInteger('celular');
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rol');

            $table->unsignedBigInteger('auditor_id')->nullable();
            $table->foreign('auditor_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
