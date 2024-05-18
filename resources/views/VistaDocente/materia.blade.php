@extends('Panza')
@section('Panza')

<main class="w-full max-w-4xl mx-auto px-4 py-8 md:px-6 md:py-12">
    <h1 class="text-3xl font-bold mb-4">Materia: {{ $materia->nombre }} - Grupo: {{ $grupo->nombre }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h2 class="text-xl font-semibold mb-2">Detalles de la materia</h2>
        <div class="space-y-2">
          <p>
            <span class="font-medium">Profesor:</span> {{ Auth::user()->name }}
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td class="border-b px-4 py-2">{{ $estudiante->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
      </div>
    </div>

  </main>

@endsection
