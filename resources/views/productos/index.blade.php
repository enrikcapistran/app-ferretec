<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($productos as $producto)
            <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                <img class="w-full h-48" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
                <div class="px-6 py-4">
                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                        {{ $producto->nombre }}
                    </h4>
                    <p class="leading-normal text-gray-700">{{ $producto->descripcion }}.</p>
                </div>
                <div class="flex items-center justify-between p-4">
                    <span class="text-xl text-green-600">${{ $producto->precio }}</span>
                </div>
                <div class="p-4">
                    <a href="{{ route('productos.show', $producto->idProducto) }}" class="block w-full px-4 py-2 text-center text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                        Ver Detalles
                    </a>
                </div>
        </div>
        @endforeach
    </div>
    </div>
</x-guest-layout>
