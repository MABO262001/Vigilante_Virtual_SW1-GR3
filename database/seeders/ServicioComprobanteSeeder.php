<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ServicioComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $adminIds = range(1, 11);
        $studentIds = range(12, 125);
        shuffle($studentIds); // Mezclar los IDs de estudiantes para asegurar aleatoriedad

        foreach ($studentIds as $studentId) {
            $adminId = $faker->randomElement($adminIds);
            DB::table('comprobantes')->insert([
                'user_estudiante_id' => $studentId,
                'user_administrativo_id' => $adminId,
                'hora' => $faker->time(),
                'fecha' => $faker->date(),
                'monto_total' => 45.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $comprobanteIds = DB::table('comprobantes')->pluck('id');
        $servicioId = 1;

        foreach ($comprobanteIds as $comprobanteId) {
            DB::table('servicio_comprobantes')->insert([
                'comprobante_id' => $comprobanteId,
                'servicio_id' => $servicioId,
                'usado' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
