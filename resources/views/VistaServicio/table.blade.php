<div class="overflow-x-auto">
    <table class="w-full border-collapse table-fixed">
        <thead>
            <tr class="bg-blue-300">
                <th class="w-1/12 py-3 border border-gray-400">No.</th>
                <th class="w-2/12 py-3 border border-gray-400">Nombre</th>
                <th class="w-4/12 py-3 border border-gray-400">Descripción</th>
                <th class="w-2/12 py-3 border border-gray-400">Fecha</th>
                <th class="w-1/12 py-3 border border-gray-400">Precio</th>
                <th class="w-2/12 py-3 border border-gray-400">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($servicios as $servicio)
                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="text-center py-2 border border-gray-400">{{ $counter++ }}</td>
                    <td class="py-2 px-4 border border-gray-400">{{ $servicio->nombre }}</td>
                    <td class="py-2 px-4 border border-gray-400">{{ $servicio->descripcion }}</td>
                    <td class="text-center py-2 border border-gray-400">{{ $servicio->fecha }}</td>
                    <td class="text-center py-2 border border-gray-400">{{ $servicio->precio }}</td>
                    <td class="py-2 px-4 text-center border border-gray-400">
                        <a href="{{ route('Servicio.edit', $servicio->id) }}" class="text-blue-500 hover:text-blue-700 font-bold mr-3">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <form action="{{ route('Servicio.destroy', $servicio->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold mr-3">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>
                        </form>
                        <a href="{{ route('Servicio.show', $servicio->id) }}" class="text-gray-500 hover:text-blue-500 font-bold">
                            <i class="fas fa-eye fa-lg"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
