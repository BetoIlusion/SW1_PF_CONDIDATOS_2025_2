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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->text('perfil_profesional')->nullable(); // resumen del perfil
            $table->integer('experiencia_total')->nullable(); // experiencia total en años
            $table->json('skills')->nullable(); // lista de habilidades
            $table->json('experiencias')->nullable(); // [{empresa: '', puesto: '', inicio: '', fin: ''}]
            $table->json('certificaciones')->nullable(); // [{nombre: '', institucion: '', fecha: ''}]
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
