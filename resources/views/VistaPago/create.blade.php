@extends('Panza')
@section('Panza')
    <form action="{{ route('PagoServicio.store') }}" method="POST"
        class="w-full mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="flex mb-4">
            <div class="w-1/2 mr-2">
                <label for="carnet_identidad" class="block text-gray-700 font-bold mb-2">Carnet de Identidad</label>
                <input type="number" name="carnet_identidad" id="carnet_identidad" placeholder="Carnet de Identidad"
                    min="0"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="w-1/2 mr-2">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nombre Del Usuario</label>
                <input type="text" name="name" id="name" placeholder="Nombre Del Usuario"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
            </div>
        </div>
        <div class="flex mb-4">
            <div class="w-1/3 mr-2">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
            </div>
            <div class="w-1/3 mr-2">
                <label for="apellido_paterno" class="block text-gray-700 font-bold mb-2">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
            </div>
            <div class="w-1/3 ml-2">
                <label for="apellido_materno" class="block text-gray-700 font-bold mb-2">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar</button>
        </div>

        
    </form>


    <script>
        document.getElementById('carnet_identidad').addEventListener('change', function() {
            fetch('/obtener-carnet/' + this.value)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('name').value = data.name;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('apellido_paterno').value = data.apellido_paterno;
                    document.getElementById('apellido_materno').value = data.apellido_materno;
                });
        });
    </script>
@endsection
