<table class="w-full mt-4">
    <thead>
        <tr>
            <th class="px-0 py-2 text-center" style="width: 1%">Nro</th>
            <th class="px-4 py-2">Materia</th>
            <th class="px-4 py-2">Grupo</th>
        </tr>
    </thead>
    <tbody>
        @php
            $materias_inscritas = $materias_inscritas ?? [];
        @endphp
        @foreach ($materias_inscritas as $index => $materia)
            <tr>
                <td class="border px-0 py-2 text-center">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $materia['nombre_materia'] }}</td>
                <td class="border px-4 py-2">{{ $materia['nombre_grupo'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
