<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="max-w-xs mx-auto mb-2 rounded-lg shadow-lg">
            <img class="w-full h-48" src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" />
            <div class="px-6 py-4">
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                    {{ $producto->nombre }}</h4>
                <p class="leading-normal text-gray-700">
                    {{ $producto->descripcion }}
                </p>
            </div>
            <div class="flex items-center justify-between p-4">
                <span class="text-xl text-green-600">${{ $producto->precio }}</span>
                <span class="text-xl text-green-600">Stock: {{ $producto->stock }}</span>
            </div>
        </div>
    </div>
</x-guest-layout>
