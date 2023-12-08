<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2"></div>

            <th scope="col" class="px-6 py-3 text-center bg-indigo-600 text-white font-bold uppercase">
                Folio {{ $pedidoSurtido->idSurtido }}
            </th>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID Refaccion</th>
                            <th scope="col" class="px-6 py-3">Cantidad que debio llegar</th>
                            <th scope="col" class="px-6 py-3">Cantidad que llego</th>
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
                                <form action="{{ route('admin.surtidos.guardarInventario') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="idSucursal" value="{{ $pedidoSurtido->idSucursal }}" />
                                    <input type="hidden" name="idRefaccion" value="{{ $detalle->idRefaccion }}" />

                                    <input type="number" name="cantidad" placeholder="Ingrese la cantidad" class=" text-black p-2 rounded-md" />
                                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                        Registrar
                                    </button>
                                    @else
                                    @endif
                    
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                <form method="POST" action="{{ route('admin.surtidos.finalizarSurtido') }}">
                    @csrf
                    <input type="hidden" name="idSurtido" value="{{ $pedidoSurtido->idSurtido }}" />
                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Finalizar Surtido
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
