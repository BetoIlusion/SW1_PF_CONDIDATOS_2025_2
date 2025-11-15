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
        Schema::create('cv_bases', function (Blueprint $table) {
            $table->id();
            $table->integer('experiencia_total')->nullable(); // experiencia total en años
            $table->string('idiomas')->nullable(); // idiomas separados por coma
            $table->json('skills')->nullable(); // lista de habilidades
            $table->json('educacion')->nullable(); // [{institucion: '', carrera: ''}]
            $table->decimal('pretension_salarial', 10, 2)->nullable();
            $table->string('disponibilidad')->nullable(); // inmediata, 15 dias, 1 mes
            $table->string('portafolio_url')->nullable(); // url del portafolio
            $table->string('cv_path')->nullable(); // ruta del archivo PDF del CV
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_bases');
    }
};
