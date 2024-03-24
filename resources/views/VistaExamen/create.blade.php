@extends('Panza')
@section('Panza')
<h1 class="text-gray-800 font-semibold uppercase text-xl border-b pb-1">Crear Examen</h1>


<div class="grid md:grid-cols-2 md:gap-x-2 mt-4">

    <div class="p-2 md:border-r">
        <div class="w-full">
            <label for="" class="text-sm font-semibold block text-gray-700">Tema</label>
            <input type="text" name="tema" id="tema" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full ">
        </div>

        <div class="mt-4">
            <label for="" class="text-sm font-semibold block text-gray-700">Descripcion</label>

        </div>
    </div>

</div>

@endsection