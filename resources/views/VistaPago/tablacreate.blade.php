<table class="w-full mt-4">
    <thead>
        <tr>
            <th class="px-0 py-2 text-center" style="width: 1%">Nro</th>
            <th class="px-4 py-2">Servicio</th>
            <th class="px-4 py-2">Precio</th>
            <th class="px-0 py-2 text-center" style="width: 1%">Seleccionar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicios as $servicio)
            <tr>
                <td class="border px-0 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $servicio->nombre }}</td>
                <td class="border px-4 py-2">{{ $servicio->precio }}</td>
                <td class="border px-4 py-2 text-center">
                    <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                        data-precio="{{ $servicio->precio }}">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
