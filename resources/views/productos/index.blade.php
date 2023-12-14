<x-guest-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($productos as $producto)
                <div class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-lg">
                    <img class="w-32 h-32 object-cover" src="{{ Storage::url($producto->getImagen()) }}" alt="Image" />
                    <div class="flex flex-col flex-grow">
                        <h4 class="text-xl font-extrabold text-gray-800">{{ $producto->getNombreProducto() }}</h4>
                        <p class="text-gray-600">{{ Str::limit($producto->getDescripcion(), 100) }}</p>
                        <p class="text-gray-600">Stock: {{ $producto->getStock() }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <div>
                                <span class="text-lg font-semibold text-blue-500">${{ number_format($producto->getPrecioUnitario(), 2) }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('productos.show', $producto->getIdProducto()) }}" class="btn-light-blue">
                                    Ver Detalles
                                </a>
                                <form action="{{ route('carrito.agregar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="idProducto" value="{{ $producto->getIdProducto() }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="btn-dark-blue">
                                        Agregar a Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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

    /* Updated styles for "Ver Detalles" button */
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