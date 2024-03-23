<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Miguel Angel Ballivian Ocampo',
            'email' => 'ballivian02@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        User::create([
            'id' => 2,
            'name' => 'Ing. Papitas',
            'email' => 'papitas@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
