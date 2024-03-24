@extends('Panza')
@section('Panza')
<h1 class="text-gray-800 font-semibold uppercase text-xl border-b pb-1">Crear Examen</h1>


<div class="grid md:grid-cols-2 md:gap-x-2 mt-4">

    <div class="p-2 md:border-r pr-4">
        <div class="w-full">
            <label for="tema" class="text-sm font-semibold block text-gray-700">Tema</label>
            <input type="text" name="tema" id="tema" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full ">
        </div>

        <div class="mt-4">
            <label for="descripcion" class="text-sm font-semibold block text-gray-700">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="w-full h-[150px] rounded">
        </div>
    </div>

</div>

@endsection