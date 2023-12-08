<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
            <img class="w-full h-48" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
            <div class="px-6 py-4">
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                    {{ $producto->nombreProducto }}
                </h4>
                <p class="leading-normal text-gray-700">{{ $producto->descripcion }}.</p>
            </div>
            <div class="flex items-center justify-between p-4">
                <span class="text-xl text-green-600">${{ $producto->precioUnitario }}</span>
            </div>
            <div class="p-4">

                <form action="{{ route('carrito.agregar') }}" method="post">
                    @csrf
                    <input type="hidden" name="idProducto" value="{{ $producto->idProducto }}">
                    <input type="hidden" name="cantidad" value="1">
                    <button type="submit" class="block w-full px-4 py-2 text-center text-white bg-green-500 rounded hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Agregar a Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
