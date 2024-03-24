<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesYPermisosSeeder extends Seeder
{

    public function run(): void
    {
        Role::create(['name' => 'Master']);
        Role::create(['name' => 'Administrativo']);
        Role::create(['name' => 'Administrativo Premium']);
        Role::create(['name' => 'Docente']);
        Role::create(['name' => 'Docente Premium']);
        Role::create(['name' => 'Estudiante']);
    }
}
