<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaTrabajo>
 */
class OfertaTrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->jobTitle(),
            'descripcion' => $this->faker->paragraph(),
            'modalidad' => $this->faker->randomElement(['presencial', 'remoto', 'hibrido']),
            'tipo_contrato' => $this->faker->randomElement(['tiempo completo', 'medio tiempo', 'practica']),
            'salario_minimo' => $this->faker->numberBetween(500, 2000),
            'salario_maximo' => $this->faker->numberBetween(2001, 5000),
            'moneda' => $this->faker->randomElement(['USD', 'BOB']),
            'ubicacion' => $this->faker->city(),
            'experiencia_min' => $this->faker->numberBetween(0, 5),
            'skills_requeridos' => json_encode($this->faker->randomElements(['PHP', 'Laravel', 'Vue.js', 'React', 'MySQL', 'AWS'], $this->faker->numberBetween(1, 4))),
            'fecha_publicacion' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_cierre' => $this->faker->dateTimeBetween('now', '+1 month'),
            'estado' => $this->faker->randomElement(['activa', 'cerrada', 'pausada']),
            'is_active' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(), // Asocia con un usuario existente o crea uno nuevo
        ];
    }
}
