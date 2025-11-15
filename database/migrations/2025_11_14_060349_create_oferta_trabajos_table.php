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
        Schema::create('oferta_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('modalidad'); // presencial, remoto, hibrido
            $table->string('tipo_contrato'); // tiempo completo, medio tiempo, practica
            $table->decimal('salario_minimo', 10, 2)->nullable();
            $table->decimal('salario_maximo', 10, 2)->nullable();
            $table->string('moneda', 3)->default('USD'); // USD, BOB
            $table->string('ubicacion')->nullable(); // ciudad o pais
            $table->integer('experiencia_min')->default(0); // años minimo de experiencia
            $table->json('skills_requeridos')->nullable(); // lista de tecnologias o habilidades
            $table->timestamp('fecha_publicacion')->useCurrent();
            $table->timestamp('fecha_cierre')->nullable();
            $table->string('estado')->default('activa'); // activa, cerrada, pausada
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario que publica la oferta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_trabajos');
    }
};
