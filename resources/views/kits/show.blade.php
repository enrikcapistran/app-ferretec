<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="max-w-xs mx-auto mb-2 rounded-lg shadow-lg">
            <img class="w-full h-48" src="{{ Storage::url($kit->imagen) }}" alt="{{ $kit->nombre }}" />
            <div class="px-6 py-4">
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                    {{ $kit->nombre }}</h4>
                <p class="leading-normal text-gray-700">{{ $kit->descripcion }}
                </p>
            </div>
            <div class="flex items-center justify-between p-4">
                <span class="text-xl text-green-600">${{ $kit->precio }}</span>
                <span class="text-xl text-green-600">Stock: {{ $kit->stock }}</span>
            </div>
            @if($kit->productos->isNotEmpty())
            <div class="px-6 py-4">
                <h5 class="text-lg font-semibold">Productos:</h5>
                <ul>
                    @foreach ($kit->productos as $producto)
                    <li>{{ $producto->nombre }} - {{ $producto->descripcion }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</x-guest-layout>
