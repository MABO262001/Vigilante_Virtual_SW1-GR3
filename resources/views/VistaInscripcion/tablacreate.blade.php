<table class="w-full mt-4">
    <thead>
        <tr>
            <th class="px-0 py-2 text-center" style="width: 1%">Nro</th>
            <th class="px-4 py-2">Materia Y Grupo</th>
            <th class="px-0 py-2 text-center" style="width: 1%">Seleccionar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grupomaterias as $grupomateria)
            <tr>
                <td class="border px-0 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $grupomateria->materia->nombre }} - {{ $grupomateria->grupo->nombre }}</td>
                <td class="border px-4 py-2 text-center">
                    <input type="checkbox" name="grupomaterias[]" value="{{ $grupomateria->id }}"
                        {{ in_array($grupomateria->id, $inscribedGrupoMaterias) ? 'checked' : '' }}>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
