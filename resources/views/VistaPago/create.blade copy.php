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

    {{-- <div class="mt-8 flex justify-center">
        <form id="searchForm" method="GET" action="{{ route('PagoServicio.create') }}" class="w-full max-w-lg">
            <div class="flex items-center border-b-2 border-teal-500 py-2">
                <input type="text" id="searchInput" name="search" placeholder="Buscar Comprobante"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
                <button type="submit" id="searchButton"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Buscar</button>
                <button type="button" id="clearButton"
                    class="flex-shrink-0 bg-red-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-sm border-4 text-white py-1 px-2 rounded ml-2"
                    style="display: none;">Eliminar filtro</button>
            </div>
        </form>
    </div> --}}

    {{-- <div id="total" class="text-center font-bold mb-4">Total: 0 Bs</div>

    <div class="mt-8 overflow-x-auto" id="tableContainer">
        @include('VistaPago.tablacreate')
    </div> --}}

    <script>
        var total = parseFloat(localStorage.getItem('total')) || 0;
        var selectedServices = JSON.parse(localStorage.getItem('selectedServices')) || [];
        document.getElementById('total').textContent = 'Total: ' + total.toFixed(2) + ' Bs';

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

        // function updateSelectedServices() {
        //     selectedServices = [];
        //     document.querySelectorAll('input[name="servicios[]"]:checked').forEach(function(checkedBox) {
        //         selectedServices.push(checkedBox.value);
        //     });
        //     localStorage.setItem('selectedServices', JSON.stringify(selectedServices));
        // }

        // function addCheckboxListeners() {
        //     document.querySelectorAll('input[name="servicios[]"]').forEach(function(checkbox) {
        //         // Marcar los checkboxes de los servicios seleccionados
        //         if (selectedServices.includes(checkbox.value)) {
        //             checkbox.checked = true;
        //         }

        //         checkbox.addEventListener('change', function() {
        //             if (this.checked) {
        //                 total += parseFloat(this.dataset.precio);
        //                 // Verificar si el total es negativo
        //                 if (total < 0) {
        //                     total = 0;
        //                 }
        //                 selectedServices.push(this.value);
        //             } else {
        //                 total -= parseFloat(this.dataset.precio);
        //                 // Verificar si el total es negativo
        //                 if (total < 0) {
        //                     total = 0;
        //                 }
        //                 var index = selectedServices.indexOf(this.value);
        //                 if (index !== -1) selectedServices.splice(index, 1);
        //             }
        //             document.getElementById('total').textContent = 'Total: ' + total.toFixed(2) + ' Bs';
        //             // Guardar el total y los servicios seleccionados en el almacenamiento local cada vez que cambian
        //             localStorage.setItem('total', total);
        //             localStorage.setItem('selectedServices', JSON.stringify(selectedServices));
        //         });
        //     });
        // }


        // addCheckboxListeners();
        // document.querySelector('form[action="{{ route('PagoServicio.store') }}"]').addEventListener('submit', function(
        //     event) {
        //     document.querySelectorAll('input[name="servicios[]"]').forEach(function(checkbox) {
        //         checkbox.checked = false;
        //     });
        //     total = 0;
        //     selectedServices = [];
        //     localStorage.setItem('total', total);
        //     localStorage.setItem('selectedServices', JSON.stringify(selectedServices));

        //     document.getElementById('total').textContent = 'Total: ' + total.toFixed(2) + ' Bs';
        // });
        // $(document).ready(function() {
        //     $('#miTabla tr').click(function() {
        //         // Obtener el ID del servicio seleccionado desde la fila de la tabla
        //         var servicioId = $(this).find('td:eq(0)').text();

        //         // Marcar la casilla de verificación correspondiente al servicio seleccionado
        //         $('#servicio_' + servicioId).prop('checked', true);
        //     });
        // });

        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var searchValue = document.getElementById('searchInput').value;

            axios.get('{{ route('PagoServicio.create') }}', {
                    params: {
                        search: searchValue
                    }
                })
                .then(function(response) {
                    document.getElementById('tableContainer').innerHTML = response.data;
                    document.getElementById('clearButton').style.display = 'inline-flex';

                    addCheckboxListeners();
                })
                .catch(function(error) {
                    console.error(error);
                });
        });

        document.getElementById('clearButton').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            this.style.display = 'none';
            document.getElementById('searchForm').dispatchEvent(new Event('submit'));
        });
    </script>
@endsection
