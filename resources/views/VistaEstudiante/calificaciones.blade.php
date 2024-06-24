<x-navbar />

<div class="container mx-auto py-8 px-4 md:px-6">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Calificaciones</h1>
    <button id="downloadPdfBtn" class="flex items-center justify-center text-sm font-medium text-white bg-yellow-400 hover:bg-yellow-500 transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 h-10 px-4 rounded-md">
      Descargar PDF
  </button>
  </div>
  <div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full divide-y divide-gray-200" id="calificacionesTable">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Examen</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Materia</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grupo</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Docente</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Calificación</th>
          <th scope="col" class="px-6 py-3"></th> <!-- Columna para el botón -->
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">Parcial 1</td>
          <td class="px-6 py-4 text-sm text-gray-700">2023-05-01 10:00 AM</td>
          <td class="px-6 py-4 text-sm text-gray-700">Base de Datos 1</td>
          <td class="px-6 py-4 text-sm text-gray-700">SB</td>
          <td class="px-6 py-4 text-sm text-gray-700">Prof. Juana Pérez</td>
          <td class="px-6 py-4 text-sm text-gray-700">85</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <button class="flex items-center justify-center text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 h-8 px-4 rounded-md">
              Ver Examen
            </button>
          </td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">Examen Final</td>
          <td class="px-6 py-4 text-sm text-gray-700">2023-06-15 2:00 PM</td>
          <td class="px-6 py-4 text-sm text-gray-700">Estructura de Datos</td>
          <td class="px-6 py-4 text-sm text-gray-700">SG</td>
          <td class="px-6 py-4 text-sm text-gray-700">Prof. Juan Gómez</td>
          <td class="px-6 py-4 text-sm text-gray-700">92</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <button class="flex items-center justify-center text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 h-8 px-4 rounded-md">
              Ver Examen
            </button>
          </td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">Parcial 2</td>
          <td class="px-6 py-4 text-sm text-gray-700">2023-04-20 9:30 AM</td>
          <td class="px-6 py-4 text-sm text-gray-700">Calculo 2</td>
          <td class="px-6 py-4 text-sm text-gray-700">SA</td>
          <td class="px-6 py-4 text-sm text-gray-700">Prof. María Rodríguez</td>
          <td class="px-6 py-4 text-sm text-gray-700">78</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <button class="flex items-center justify-center text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 h-8 px-4 rounded-md">
              Ver Examen
            </button>
          </td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">Examen Oral</td>
          <td class="px-6 py-4 text-sm text-gray-700">2023-03-10 11:00 AM</td>
          <td class="px-6 py-4 text-sm text-gray-700">Calculo 3</td>
          <td class="px-6 py-4 text-sm text-gray-700">SB</td>
          <td class="px-6 py-4 text-sm text-gray-700">Prof. Ana Sánchez</td>
          <td class="px-6 py-4 text-sm text-gray-700">90</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <button class="flex items-center justify-center text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 h-8 px-4 rounded-md">
              Ver Examen
            </button>
          </td>
        </tr>
        <tr class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">Parcial 1</td>
          <td class="px-6 py-4 text-sm text-gray-700">2023-09-05 1:30 PM</td>
          <td class="px-6 py-4 text-sm text-gray-700">Fisica 2</td>
          <td class="px-6 py-4 text-sm text-gray-700">SG</td>
          <td class="px-6 py-4 text-sm text-gray-700">Prof. Carlos Díaz</td>
          <td class="px-6 py-4 text-sm text-gray-700">82</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <button class="flex items-center justify-center text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 h-8 px-4 rounded-md">
              Ver Examen
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


  @include('components.footer')

