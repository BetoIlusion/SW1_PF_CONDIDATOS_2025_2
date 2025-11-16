<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfertaTrabajo;
use App\Models\CvBase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'edberto',
            'email' => 'edberto@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('candidato');
        $empleador = \App\Models\User::factory()->create([
            'name' => 'empleador',
            'email' => 'empleador@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        $empleador->assignRole('empleador');

        \App\Models\User::factory(3)->create()->each(function ($user) {
            $user->assignRole('empleador');
        });

        \App\Models\User::factory(10)->create();
        CvBase::factory(20)->create();
        OfertaTrabajo::factory(10)->create();
    }
}
