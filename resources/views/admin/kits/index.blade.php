<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-3xl text-center font-bold text-gray-800 dark:text-gray-200">Kits en diseño</h1>

            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.kits.iniciar') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg
                text-white">
                    Nuevo Kit
                </a>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Imagen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="'col" class="relative py-3 px-6">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $kits as $kit )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $kit->getNombreProducto() }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img src="{{ Storage::url($kit->getImagen()) }}" class="w-16 h-16 rounded">
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${{ number_format($kit->getPrecioUnitario(), 2) }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.kits.update', $kit->getIdProducto()) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                        Editar
                                    </a>
                                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white" method="POST" action="{{ route('admin.kits.eliminarKit', $kit->getIdProducto()) }}" onsubmit="return confirm('¿Desea eliminar este menú?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
