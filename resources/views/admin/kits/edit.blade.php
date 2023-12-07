<?php
// Uncomment if needed for debugging
// dd($kit, $producto, $sucursales, $detalle);
?>

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.kits.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Ver Kits
                </a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <form id="kitForm" method="PUT" action="{{ route('admin.kits.update', $kit->getIdProducto()) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="sm:col-span-6">
                        <label for="nombre" class="block text-sm font-medium text-gray-700"> Nombre </label>
                        <div class="mt-1">
                            <input type="text" id="nombre" name="nombre" value="{{$kit->getnombreProducto()}}" placeholder="Nombre del Kit" class="@error('nombre') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm" />
                            @error('nombre')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="imagen" class="block text-sm font-medium text-gray-700"> Imagen </label>
                        <div class="mt-1">
                            <input type="file" id="imagen" name="imagen" value="{{$kit->getImagen()}}" class="@error('imagen') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm" />
                            @error('imagen')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="precio" class="block text-sm font-medium text-gray-700"> Precio </label>
                        <div class="mt-1">
                            <input type="number" min="0.00" max="10000.00" value="{{$kit->getPrecioUnitario()}}" step="0.01" id="precio" name="precio" class="@error('precio') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm" />
                            @error('precio')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-6 pt-5">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <div class="mt-1">
                            <textarea id="descripcion" rows="3" name="descripcion" class="@error('descripcion') border-red-500 @enderror shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            {{$kit->getDescripcion()}}
                            </textarea>
                            @error('descripcion')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Sucursal Selection -->
                    <div class="sm:col-span-6 pt-5">
                        <label for="sucursal" class="block text-sm font-medium text-gray-700">Sucursal</label>
                        <div class="mt-1">
                            <select id="sucursal" name="sucursal" value={{$kit->getSucursal()->getIdSucursal()}} class="form-select block w-full mt-1">
                                @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->nombreSucursal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @error('sucursal')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror

                    <!-- Product Selection -->
                    <div class="sm:col-span-6 pt-5">
                        <label for="productSelect" class="block text-sm font-medium text-gray-700">Producto</label>
                        <div class="mt-1 flex">
                            <select id="productSelect" class="form-select block w-full mt-1">
                                <option value="">Seleccione un producto</option>
                                @foreach($refacciones as $refaccion)
                                <option value="{{ $refaccion->getIdProducto() }}">{{ $refaccion->getnombreProducto() }}</option>
                                @endforeach
                            </select>
                            <input type="number" id="productQuantity" placeholder="Cantidad" class="form-input ml-2">
                            <button type="button" onclick="addProduct()" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white ml-2">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <!-- Selected Products List -->
                    <div class="sm:col-span-6 pt-5">
                        <label class="block text-sm font-medium text-gray-700">Productos Seleccionados</label>
                        <ul id="selectedProductsList" class="list-disc pl-5 mt-2">

                            @foreach($kit->getDetallesKit() as $detalle)

                            @php
                            $producto = null;

                            foreach ($refacciones as $productoBuscar) {
                            if ($productoBuscar->getIdProducto() === $detalle->getIdRefaccion()) {
                            $producto = $productoBuscar;
                            break;
                            }
                            }
                            @endphp

                            @if($producto)
                            <li>
                                {{ $producto->getNombreProducto() }} - Cantidad: {{ $detalle->getCantidad() }}
                                <!-- Formulario para eliminar producto del kit -->
                                <form method="POST" action="{{ route('admin.kits.eliminarRefaccion', $detalle->getIdRefaccion()) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-red-500 hover:text-red-700 text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-6 p-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @error('productos')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>
</x-admin-layout>
