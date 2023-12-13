<x-guest-layout>
    <section class="py-8">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-10 ml-10">Resultados de la Búsqueda</h2>

            @if ($resultados->isEmpty())
                <p class="text-lg">No se encontraron resultados.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($resultados as $producto)
                        <div class="max-w-xs mx-auto mb-6 bg-white rounded-lg shadow-lg overflow-hidden">
                            <a href="{{ route('productos.show', $producto->idProducto) }}">
                                <img class="w-full h-48 object-cover object-center" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
                            </a>
                            <div class="px-6 py-4">
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="{{ route('productos.show', $producto->idProducto) }}" class="text-blue-500 hover:underline">
                                        {{ $producto->nombreProducto }}
                                    </a>
                                </h3>
                                <p class="text-gray-600">{{ $producto->descripcion }}</p>
                            </div>
                            <div class="flex items-center justify-between px-6 py-4 bg-gray-100">
                                <span class="text-lg font-semibold text-blue-500">${{ number_format($producto->precioUnitario, 2) }}</span>
                                <form action="{{ route('carrito.agregar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="btn-light-blue">
                                        Agregar a Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-guest-layout>

<style>
    .btn-light-blue {
        padding: 0.5rem 1rem;
        background-color: #4297d3; /* Lighter blue */
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .btn-light-blue:hover {
        background-color: #4a8acf; /* Adjust the hover color if needed */
    }
</style>
