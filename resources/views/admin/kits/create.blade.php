<!-- v2 -->

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Kit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulario para actualizar nombre, descripción, imagen y precioUnitario del kit -->
            <form method="POST" action="{{ route('admin.kits.setInfo') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campos para nombre, descripción, imagen y precioUnitario -->
                <div class="sm:col-span-6">
                    <label for="nombreProducto" class="block text-sm font-medium text-gray-700"> Nombre </label>
                    <div class="mt-1">
                        <input type="text" id="nombreProducto" name="nombreProducto" value="{{$kit->getNombreProducto()}}" placeholder="Nombre del Kit" class="@error('nombreProducto') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm">
                        @error('nombreProducto')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="imagen" class="block text-sm font-medium text-gray-700"> Imagen </label>
                    <div class="mt-1">
                        <input type="file" id="imagen" name="imagen" class="@error('imagen') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm" />
                        @error('imagen')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="precioUnitario" class="block text-sm font-medium text-gray-700"> Precio unitario </label>
                    <div class="mt-1">
                        <input type="number" value="{{$kit->getPrecioUnitario()}}" min="0.00" max="10000.00" step="0.01" id="precioUnitario" name="precioUnitario" class="@error('precioUnitario') border-red-500 @enderror block w-full transition duration-150 ease-in-out sm:text-sm" />
                        @error('precioUnitario')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-6 pt-5">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <div class="mt-1">
                        <textarea id="descripcion" rows="3" name="descripcion" class="@error('descripcion') border-red-500 @enderror shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{$kit->getDescripcion()}}</textarea>
                        @error('descripcion')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Sucursal Selection -->
                <div class="sm:col-span-6 pt-5">
                    <label for="sucursal" class="block text-sm font-medium text-gray-700">Sucursal</label>
                    <div class="mt-1">
                        <select id="sucursal" name="sucursal" class="form-select block w-full mt-1">
                            @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->idSucursal }}" {{ $kit->getSucursal() && $kit->getSucursal()->getIdSucursal() == "idSucursal" ? 'selected' : '' }}>
                                {{ $sucursal->nombreSucursal }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botón para guardar la información del kit -->
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                        Guardar Detalles del Kit
                    </button>
                </div>
            </form>

            <!-- Formulario para añadir refacciones al kit -->
            <form method="POST" action="{{ route('admin.kits.addRefaccion') }}" class="mt-8">
                @csrf

                <!-- Campos para seleccionar refacción y cantidad -->
                <div class="sm:col-span-6 pt-5">
                    <label for="productSelect" class="block text-sm font-medium text-gray-700">Producto</label>
                    <div class="mt-1 flex">
                        <select id="productSelect" name="idRefaccion" class="form-select block w-full mt-1">
                            <option value="">Seleccione un producto</option>
                            @foreach($refacciones as $producto)
                            <option value="{{ $producto->getIdProducto() }}">{{ $producto->getNombreProducto() }}</option>
                            @endforeach
                        </select>

                        <input type="number" id="productQuantity" name="cantidad" placeholder="Cantidad" class="form-input ml-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                            Añadir Refacción
                        </button>
                    </div>
                </div>


            </form>


            <!-- Selected Products List -->
            <div class="sm:col-span-6 pt-5">
                <label class="block text-sm font-medium text-gray-700">Productos Seleccionados</label>
                <ul class="list-disc pl-5 mt-2">
                    
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





            <!-- Botón para finalizar el kit -->
            <form method="POST" action="{{ route('admin.kits.finalizar') }}" class="mt-8">
                @csrf
                @method('post')

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                        Finalizar Kit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
