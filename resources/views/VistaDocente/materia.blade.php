@extends('Panza')
@section('Panza')

<main class="w-full max-w-4xl mx-auto px-4 py-8 md:px-6 md:py-12">
    <h1 class="text-3xl font-bold mb-4">Materia: Base de datos</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h2 class="text-xl font-semibold mb-2">Detalles de la materia</h2>
        <div class="space-y-2">
          <p>
            <span class="font-medium">Descripción:</span> Introducción a los conceptos y principios fundamentales de
            los sistemas de gestión de bases de datos. Incluye temas como modelado de datos, lenguajes de consulta,
            transacciones y seguridad.
          </p>
          <p>
            <span class="font-medium">Profesor:</span> Dr. Juan Pérez
          </p>
          <p>
            <span class="font-medium">Créditos:</span> 4
          </p>
          <p>
            <span class="font-medium">Horario:</span> Lunes y Miércoles, 10:00 - 11:30
          </p>
        </div>
      </div>
      <div>
        <h2 class="text-xl font-semibold mb-2">Estudiantes inscritos</h2>
        <div class="border rounded-lg overflow-hidden">
          <table class="w-full table-auto">
            <thead class="bg-gray-100 dark:bg-gray-800">
              <tr>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Correo</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border-b px-4 py-2">María Gómez</td>
                <td class="border-b px-4 py-2">maria.gomez@example.com</td>
              </tr>
              <tr>
                <td class="border-b px-4 py-2">Juan Rodríguez</td>
                <td class="border-b px-4 py-2">juan.rodriguez@example.com</td>
              </tr>
              <tr>
                <td class="border-b px-4 py-2">Ana Fernández</td>
                <td class="border-b px-4 py-2">ana.fernandez@example.com</td>
              </tr>
              <tr>
                <td class="border-b px-4 py-2">Carlos Sánchez</td>
                <td class="border-b px-4 py-2">carlos.sanchez@example.com</td>
              </tr>
              <tr>
                <td class="px-4 py-2">Sofía Martínez</td>
                <td class="px-4 py-2">sofia.martinez@example.com</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="mt-8">
      <h2 class="text-xl font-semibold mb-2">Actividades</h2>
      <div class="border rounded-lg overflow-hidden">
        <table class="w-full table-auto">
          <thead class="bg-gray-100 dark:bg-gray-800">
            <tr>
              <th class="px-4 py-2 text-left">Actividad</th>
              <th class="px-4 py-2 text-left">Fecha</th>
              <th class="px-4 py-2 text-left">Hora</th>
              <th class="px-4 py-2 text-left">Descripción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border-b px-4 py-2">Examen parcial</td>
              <td class="border-b px-4 py-2">15 de mayo</td>
              <td class="border-b px-4 py-2">10:00 - 12:00</td>
              <td class="border-b px-4 py-2">Examen sobre los temas vistos hasta la fecha</td>
            </tr>
            <tr>
              <td class="border-b px-4 py-2">Taller de SQL</td>
              <td class="border-b px-4 py-2">22 de mayo</td>
              <td class="border-b px-4 py-2">14:00 - 16:00</td>
              <td class="border-b px-4 py-2">Taller práctico sobre consultas SQL</td>
            </tr>
            <tr>
              <td class="border-b px-4 py-2">Proyecto final</td>
              <td class="border-b px-4 py-2">5 de junio</td>
              <td class="border-b px-4 py-2">09:00 - 17:00</td>
              <td class="border-b px-4 py-2">Desarrollo de un sistema de gestión de base de datos</td>
            </tr>
            <tr>
              <td class="px-4 py-2">Examen final</td>
              <td class="px-4 py-2">12 de junio</td>
              <td class="px-4 py-2">10:00 - 12:00</td>
              <td class="px-4 py-2">Examen comprensivo sobre todos los temas vistos</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

@endsection
