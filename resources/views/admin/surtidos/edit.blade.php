<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end m-2 p-2">
            </div>

            <th scope="col" class="px-6 py-3 text-center bg-indigo-600 text-white font-bold uppercase">
                Folio {{ $pedidoSurtido->idSurtido }}
            </th>

            <form action="{{ route('admin.surtidos.guardarInventario', ['idSurtido' => $pedidoSurtido->idSurtido]) }}" method="post">
                @csrf
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID Refaccion
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cantidad que debio llegar
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cantidad que llego
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalleSurtido as $detalle)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $detalle->idRefaccion }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $detalle->cantidad }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="number" pattern="\d*" name="cantidadLlego[{{ $detalle->idRefaccion }}]" placeholder="Ingrese la cantidad" class="bg-black text-white p-2 rounded-md" />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Guardar
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
