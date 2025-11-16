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
        /**
         * Define la estructura de la tabla `empleadors`.
         * - Crea los campos básicos de identificación, industria, tipo y ubicación de la empresa.
         * - Establece la relación uno a muchos con la tabla `users` mediante la clave foránea `user_id`.
         * - Guarda datos de contacto como teléfono y logotipo.
         * - Incluye un indicador `verified` por defecto en falso y marcas de tiempo automáticas.
         */
        Schema::create('empleadors', function (Blueprint $table) {
            $table->id(); // Identificador único autoincremental
            $table->string('nombre_empresa'); // Nombre de la empresa
            $table->string('industria'); // Industria a la que pertenece la empresa
            $table->string('tipo'); // Tipo de empresa
            $table->string('country'); // País de ubicación
            $table->string('city'); // Ciudad de ubicación
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->string('phone'); // Teléfono de contacto
            $table->string('photo_logo'); // Ruta o nombre del logotipo
            $table->boolean('verified')->default(false); // Indica si está verificada
            $table->timestamps(); // Sellos de tiempo de creación y actualización

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Llave foránea a usuarios
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleadors');
    }
};
