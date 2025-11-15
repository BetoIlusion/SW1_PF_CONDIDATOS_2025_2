<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🟢 Crear permisos (puedes agregar más)
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        // 🟣 Crear roles
        $admin = Role::create(['name' => 'candidato']);
        $editor = Role::create(['name' => 'empleador']);


        // 🔗 Asignar permisos a roles
        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo(['ver usuarios', 'editar usuarios']);
        // $viewer->givePermissionTo('ver usuarios');
    }
}
