@extends('Panza')
@section('Panza')

<div class="w-full max-w-4xl mx-auto py-8 px-4 md:px-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Calificaciones</h1>
      <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
        Descargar PDF
      </button>
    </div>
    <div class="overflow-x-auto">
      <div class="relative w-full overflow-auto">
        <table class="w-full caption-bottom text-sm">
          <thead class="[&amp;_tr]:border-b">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Examen
              </th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Fecha y Hora
              </th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Materia
              </th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Grupo
              </th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Docente
              </th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                Calificación
              </th>
            </tr>
          </thead>
          <tbody class="[&amp;_tr:last-child]:border-0">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Parcial 1</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">2023-05-01 10:00 AM</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Base de Datos 1</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">SB</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Prof. Juana Pérez</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">85</td>
            </tr>
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Examen Final</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">2023-06-15 2:00 PM</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Estructura de Datos</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">SG</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Prof. Juan Gómez</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">92</td>
            </tr>
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Parcial 2</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">2023-04-20 9:30 AM</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Calculo 2</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">SA</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Prof. María Rodríguez</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">78</td>
            </tr>
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Examen Oral</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">2023-03-10 11:00 AM</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Calculo 3</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">SB</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Prof. Ana Sánchez</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">90</td>
            </tr>
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Parcial 1</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">2023-09-05 1:30 PM</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Fisica 2</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">SG</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Prof. Carlos Díaz</td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">82</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection