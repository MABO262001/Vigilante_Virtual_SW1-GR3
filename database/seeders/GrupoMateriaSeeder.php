<?php

namespace Database\Seeders;

use App\Models\GrupoMateria;
use Illuminate\Database\Seeder;

class GrupoMateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GrupoMateria::create([
            'id' => 1,
            'grupo_id' => '2',
            'materia_id' => '1',
            'user_docente_id' => '4',
            'contraseña' => '123456789',
            'cantidad_estudiantes' => '15',
            'cantidad_estudiantes_inscritos' => '0',
        ]);

        GrupoMateria::create([
            'id' => 2,
            'grupo_id' => '2',
            'materia_id' => '1',
            'user_docente_id' => '4',
            'contraseña' => '123456789',
            'cantidad_estudiantes' => '10',
            'cantidad_estudiantes_inscritos' => '0',
        ]);

        GrupoMateria::create([
            'id' => 3,
            'grupo_id' => '1',
            'materia_id' => '2',
            'user_docente_id' => '2',
            'contraseña' => '123456789',
            'cantidad_estudiantes' => '30',
            'cantidad_estudiantes_inscritos' => '0',
        ]);
    }
}
