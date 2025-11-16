<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CvBase;
use App\Models\OfertaTrabajo;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postulacion>
 */
class PostulacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_postulacion' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'mensaje' => $this->faker->optional()->paragraph(),
            'estado' => $this->faker->randomElement(['pendiente', 'aceptado', 'rechazado']),
            'calificacion' => $this->faker->optional()->numberBetween(1, 5),
            'notas_reclutador' => $this->faker->optional()->sentence(),
            'cv_base_id' => CvBase::factory(),
            'oferta_trabajo_id' => OfertaTrabajo::factory(),
            'user_id' => User::factory(),
        ];
    }
}
