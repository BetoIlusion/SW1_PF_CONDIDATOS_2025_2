<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfertaTrabajo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'edberto',
            'email' => 'edberto@gmail.com',
            'password' => bcrypt('123456789')
        ]);
        
        \App\Models\User::factory(10)->create();

        
        $this->call(RoleSeeder::class);
        OfertaTrabajo::factory(10)->create();
    }
}
