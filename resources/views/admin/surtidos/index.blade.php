<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            </div>
            
            <div class="mb-4">
                <form action="{{ route('admin.surtidos.index') }}" method="GET">
                    <label for="folio" class="sr-only">Buscar por folio</label>
                    <input type="text" id="folio" name="folio" placeholder="Buscar por folio" class="px-4 py-2 border border-gray-300 rounded-md" value="{{ request('folio') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Buscar</button>
                </form>
            </div>
            
            @if($pedidoSurtido->isNotEmpty())
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <!-- Encabezado de la tabla y filas de datos -->
                    </table>
                </div>
            @else
                <p>No se encontraron resultados para el folio {{ request('folio') }}</p>
            @endif
            


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Folio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sucursal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de pedido
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de Entrega
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estatus
                            </th>
                            <th scope="'col" class="relative py-3 px-6">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $pedidoSurtido as $pedidoSurtido )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pedidoSurtido->idSurtido }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ Str::limit($pedidoSurtido->idSucursal) }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pedidoSurtido->fechaDePedido }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pedidoSurtido->fechaDeRecibido }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @switch($pedidoSurtido->idStatus)
                                    @case(3)
                                        Pendiente
                                        @break
                                    @case(4)
                                        Revisado
                                        @break
                                    @default
                                        Error estatus
                                @endswitch
                            </td>

                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.surtidos.edit', $pedidoSurtido->idSurtido) }}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                        Revisar
                                    </a>                     
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
