<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'id' => 1,
            'name' => 'MABO',
            'email' => 'ballivian02@gmail.com',
            'password' => Hash::make('123456789'),
            'nombre' => 'Miguel Angel',
            'apellido_paterno' => 'Ballivian',
            'apellido_materno' => 'Ocampo',
            'carnet_identidad' => '6312127',
            'profile_photo_path' => 'public/images/user/MABINHO.jpg'
        ]);
        $user->assignRole('Master');

        $user = User::create([
            'id' => 2,
            'name' => 'Ing. Papitas',
            'email' => 'papitas@gmail.com',
            'password' => Hash::make('1234'),
            'carnet_identidad' => '12345',
            'nombre' => 'Elio Andres',
            'apellido_paterno' => 'Osinaga',
            'apellido_materno' => 'Vargas',
            'profile_photo_path' => 'public/images/user/papita.jpeg'

        ]);
        $user->assignRole('Master');

        $user = User::create([
            'id' => 3,
            'name' => 'David',
            'email' => 'davidchalarq@gmail.com',
            'password' => Hash::make('123456789'),
            'carnet_identidad' => '67890',
            'nombre' => 'David Arturo',
            'apellido_paterno' => 'Chalar',
            'apellido_materno' => 'Quiroz',
            'profile_photo_path' => 'public/images/user/david.jpg'
        ]);
        $user->assignRole('Estudiante');

        $user = User::create([
            'id' => 4,
            'name' => 'Rene Eduardo',
            'email' => 'renechungara03@gmail.com',
            'password' => Hash::make('123456789'),
            'nombre' => 'Rene Eduardo',
            'apellido_paterno' => 'Chungara',
            'apellido_materno' => 'Martinez',
            'profile_photo_path' => 'public/images/user/rene.jpeg'
        ]);
        $user->assignRole('Docente');

        $user = User::create([
            'id' => 5,
            'name' => 'Julius',
            'email' => 'juliogutierrezv15@gmail.com',
            'password' => Hash::make('123456789'),

            'nombre' => 'Julio Alejandro',
            'apellido_paterno' => 'Gutierrez',
            'apellido_materno' => 'Velasco',
            'profile_photo_path' => 'public/images/user/juli.png'
        ]);
        $user->assignRole('Master');

        $user = User::create([
            'id' => 6,
            'name' => 'Micakes',
            'email' => 'micaelaorocag@gmail.com ',
            'password' => Hash::make('123456789'),

            'carnet_identidad' => '123456',
            'nombre' => 'Micaela Olga',
            'apellido_paterno' => 'Roca',
            'apellido_materno' => 'Garnica',
            'profile_photo_path' => 'public/images/user/Micakes.jpg'

        ]);
        $user->assignRole('Estudiante');
    }
}
