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
        Schema::create('postulacions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_postulacion')->useCurrent();
            $table->text('mensaje')->nullable();
            $table->string('estado')->default('pendiente');
            $table->integer('calificacion')->nullable();
            $table->text('notas_reclutador')->nullable();
            $table->foreignId('cv_base_id')->nullable()->constrained('cv_bases')->onDelete('set null');
            $table->foreignId('oferta_trabajo_id')->constrained('oferta_trabajos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulacions');
    }
};
