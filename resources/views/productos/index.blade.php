<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">

            @foreach ($productos as $producto)
            <a href="{{ route('productos.show', $producto->id) }}">
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($producto->imagen) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $producto->nombre }}</h4>
                        <p class="leading-normal text-gray-700">{{ $producto->descripcion }}.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">${{ $producto->precio }}</span>
                    </div>
                </div>
            </a>
            @endforeach



            @foreach ($kits as $kit)
            <a href="{{ route('kits.show', $kit->id) }}">
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($kit->imagen) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $kit->nombre }}</h4>
                        <p class="leading-normal text-gray-700">{{ $kit->descripcion }}.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">${{ $kit->precio }}</span>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</x-guest-layout>
