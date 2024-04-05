<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia;


class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materia::create([
            'id' => 1,
            'sigla' => 'BD-205',
            'nombre' => 'Base de Datos  I',
        ]);
        Materia::create([
            'id' => 2,
            'sigla' => 'INF-110',
            'nombre' => 'Introduccion A La Informatica',
        ]);
        Materia::create([
            'id' => 3,
            'sigla' => 'ED-100',
            'nombre' => 'Estructura de Datos I',
        ]);
        Materia::create([
            'id' => 4,
            'sigla' => 'RDS-100',
            'nombre' => 'Redes I',
        ]);
        Materia::create([
            'id' => 5,
            'sigla' => 'BD-210',
            'nombre' => 'Base de Datos II',
        ]);
    }
}
