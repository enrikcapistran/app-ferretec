<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
            <img class="w-full h-48" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
            <div class="px-6 py-4">
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-gray-800">
                    {{ $producto->nombreProducto }}
                </h4>
                <p class="leading-normal text-gray-600">{{ $producto->descripcion }}.</p>
            </div>
            <div class="flex items-center justify-between p-4">
                <span class="text-lg font-semibold text-blue-500">${{ number_format($producto->precioUnitario, 2) }}</span>
            </div>
            <div class="p-4">
                <form action="{{ route('carrito.agregar') }}" method="post">
                    @csrf
                    <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">
                    <input type="hidden" name="cantidad" value="1">
                    <button type="submit" class="btn-dark-blue">
                        Agregar a Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    /* Existing styles for buttons */
    .btn-blue {
        padding: 0.5rem 1rem;
        background-color: #3490dc;
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .btn-blue:hover {
        background-color: #2779bd;
    }

    .btn-dark-blue {
        padding: 0.5rem 1rem;
        background-color: #1a4d6e; /* Darker blue */
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .btn-dark-blue:hover {
        background-color: #153b54; /* Adjust the hover color if needed */
    }

    /* Updated styles for "Agregar a Carrito" button */
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
