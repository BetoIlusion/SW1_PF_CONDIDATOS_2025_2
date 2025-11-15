<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CvBase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CvBase>
 */
class CvBaseFactory extends Factory
{
    protected $model = CvBase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'experiencia_total' => $this->faker->numberBetween(0, 15),
            'idiomas' => $this->faker->randomElement(['Español, Inglés', 'Inglés', 'Alemán, Inglés']),
            'skills' => json_encode($this->faker->randomElements(['PHP', 'Laravel', 'Vue.js', 'React', 'Angular', 'MySQL', 'PostgreSQL', 'AWS', 'Docker', 'Kubernetes', 'Python', 'Django', 'Flask', 'JavaScript', 'Node.js', 'Express.js', 'MongoDB', 'Git', 'Jira', 'Scrum', 'Agile'], $this->faker->numberBetween(2, 5))),
            'educacion' => json_encode([
                ['institucion' => 'Universidad ABC', 'carrera' => 'Ingeniería'],
                ['institucion' => 'Instituto XYZ', 'carrera' => 'Marketing']
            ]),
            'pretension_salarial' => $this->faker->randomFloat(2, 5000, 20000),
            'disponibilidad' => $this->faker->randomElement(['Inmediata', '15 días', '1 mes']),
            'portafolio_url' => $this->faker->url(),
            'cv_path' => $this->faker->filePath(),
            'user_id' => 1, // Si quieres probar, puedes poner un ID fijo
        ];
    }
}
