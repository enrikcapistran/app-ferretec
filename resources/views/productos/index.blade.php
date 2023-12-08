<x-guest-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">
            @foreach ($productos->chunk(2) as $productosRow)
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @foreach ($productosRow as $producto)
                        <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-lg">
                            <img class="w-32 h-32 object-cover" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
                            <div class="flex flex-col">
                                <h4 class="text-lg font-semibold text-green-600">{{ $producto->nombreProducto }}</h4>
                                <p class="text-gray-700">{{ Str::limit($producto->descripcion, 100) }}</p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="text-base font-semibold text-green-600">${{ $producto->precioUnitario }}</span>
                                    <a href="{{ route('productos.show', $producto->idProducto) }}" class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none">
                                        Ver Detalles
                                    </a>
                                    <a href="{{ route('carrito.agregar', $producto->idProducto) }}" class="text-sm text-green-500 hover:text-green-700 focus:outline-none">
                                        Agregar al Carrito
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $productos->links() }}
        </div>
    </div>
</x-guest-layout>  
