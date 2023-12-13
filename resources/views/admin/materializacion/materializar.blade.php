<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kit Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-6">
                <!-- Kit Information -->
                <div class="mb-6 text-center">
                    <!-- Kit Image -->
                    <img src="{{ Storage::url($kit->getImagen()) }}" alt="{{ $kit->getnombreProducto() }}" class="mx-auto mb-4 w-1/2 h-auto rounded-lg shadow-lg">
                    <h3 class="text-xl font-medium text-gray-900">{{ $kit->getnombreProducto() }}</h3>
                    <p class="text-lg text-gray-700">{{ $kit->getDescripcion() }}</p>
                    <p class="text-lg text-gray-900 font-semibold">Precio: ${{ $kit->getPrecioUnitario() }}</p>
                </div>

                <!-- Kit Details -->
                <div class="mb-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Detalles:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                        <div class="border p-4 rounded-lg text-center">
                            <!-- Product Image -->
                            <img src="{{ Storage::url($producto->getImagen()) }}" alt="{{ $producto->getnombreProducto() }}" class="mx-auto mb-2 w-32 h-32 object-cover rounded-lg shadow-lg">
                            <p class="text-lg text-gray-800 font-semibold">{{ $producto->getnombreProducto() }}</p>
                            <p class="text-lg text-gray-600">Cantidad: {{ $detalle->getCantidad() }}</p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Materializar Form -->
                <div class="text-center mt-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Numero de kits a materializar:</h4>
                    <form action="{{route('admin.materializar.guardar')}}" method="POST" class="inline-block">
                        @csrf
                        <input type="hidden" name="idKit" value="{{ $kit->getIdProducto() }}">
                        <input type="number" name="cantidad" class="border rounded-md p-2 text-lg" min="0" max="{{ $max }}" style="width: 100px;">
                        <button type="submit" class="bg-blue-500 text-white rounded-md p-2 ml-2 text-lg">Materializar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
