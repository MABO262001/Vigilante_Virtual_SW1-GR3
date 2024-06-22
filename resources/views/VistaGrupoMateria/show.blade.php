@extends('Panza')
@section('Panza')
<div class="mt-8 overflow-x-auto">
    <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <thead class="bg-gradient-to-r from-blue-500 to-teal-500 text-white uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">No.</th>
                <th class="py-3 px-6 text-left">Nombre del Estudiante</th>
                <th class="py-3 px-6 text-center">Carnet de Identidad</th>
                <th class="py-3 px-6 text-center">Correo Electrónico</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm font-light">
            @forelse ($grupoMateria->boletaInscripcion as $index => $inscripcion)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200 ease-in-out">
                    <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 text-left">{{ $inscripcion->userEstudiante->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $inscripcion->userEstudiante->carnet_identidad }}</td>
                    <td class="py-3 px-6 text-center">{{ $inscripcion->userEstudiante->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No hay estudiantes inscritos</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
