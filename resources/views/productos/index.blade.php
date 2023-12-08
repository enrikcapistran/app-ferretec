<x-guest-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">

            @foreach ($productos as $producto)
            <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-lg">
                <img class="w-32 h-32 object-cover" src="{{ Storage::url($producto->getImagen()) }}" alt="Image" />
                <div class="flex flex-col">
                    <h4 class="text-lg font-semibold text-green-600">{{ $producto->getNombreProducto() }}</h4>
                    <p class="text-gray-700">{{ Str::limit($producto->getDescripcion(), 100) }}</p>
                    <p class="text-gray-700">Stock:{{ Str::limit($producto->getStock(), 100) }}</p>
                    <div class="flex items-center space-x-2 mt-2">
                        <span class="text-base font-semibold text-green-600">${{ $producto->getPrecioUnitario() }}</span>
                        <a href="{{ route('productos.show', $producto->getIdProducto()) }}" class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none">
                            Ver Detalles
                        </a>
                        <form action="{{ route('carrito.agregar') }}" method="post">
                            @csrf
                            <input type="hidden" name="idProducto" value="{{ $producto->getIdProducto() }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="text-sm text-green-500 hover:text-green-700 focus:outline-none">
                                Agregar a Carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-guest-layout>
