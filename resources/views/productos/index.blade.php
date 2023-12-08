<x-guest-layout>
    <div class="container px-6 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach ($productos as $producto)
                <a href="{{ route('productos.show', $producto->idProducto) }}" class="max-w-xs mb-8">
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <img class="w-full h-48 object-cover" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                {{ $producto->nombreProducto }}
                            </h4>
                            <p class="leading-normal text-gray-700">{{ $producto->descripcion }}.</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-xl text-green-600">${{ $producto->precioUnitario }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                            <a href="{{ route('productos.show', $producto->idProducto) }}" class="block w-1/2 text-center text-blue-500 hover:text-blue-700 focus:outline-none">
                                Ver Detalles
                            </a>
                            <a href="{{ route('carrito.agregar', $producto->idProducto) }}" class="block w-1/2 text-center text-green-500 hover:text-green-700 focus:outline-none">
                                Agregar al Carrito
                            </a>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $productos->links() }}
        </div>
    </div>
</x-guest-layout>
