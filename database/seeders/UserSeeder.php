<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'id' => 1,
            'name' => 'MABO',
            'email' => 'ballivian02@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('Master');

        $user = User::create([
            'id' => 2,
            'name' => 'Ing. Papitas',
            'email' => 'papitas@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        $user->assignRole('Master');

        $user = User::create([
            'id' => 3,
            'name' => 'David',
            'email' => 'davidchalarq@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('Estudiante');

        $user = User::create([
            'id' => 4,
            'name' => 'Rene',
            'email' => 'renechungara03@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('Docente');

        $user = User::create([
            'id' => 5,
            'name' => 'Julius',
            'email' => 'juliogutierrezv15@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('Administrativo');

        $user = User::create([
            'id' => 6,
            'name' => 'Micakes',
            'email' => 'micaelaorocag@gmail.com ',
            'password' => Hash::make('123456789'),
        ]);
        $user->assignRole('Estudiante');
    }
}
