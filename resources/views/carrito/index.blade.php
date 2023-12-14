<x-guest-layout>
    <section class="py-12">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-700">Carrito de Compras</h2>

            @if (session('carrito') && count($carrito->getDetalles()) > 0)
            <div class="mt-8">
                <table class="w-2/3 text-left bg-white rounded-lg shadow-md mx-auto">
                    <thead class="bg-blue-800">
                        <tr>
                            <th class="px-6 py-4 text-lg font-bold text-white">Producto</th>
                            <th class="px-6 py-4 text-lg font-bold text-white">Precio Unitario</th>
                            <th class="px-6 py-4 text-lg font-bold text-white">Cantidad</th>
                            <th class="px-6 py-4 text-lg font-bold text-white">Total</th>
                            <th class="px-6 py-4 text-lg font-bold text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carrito->getDetalles() as $detalleCarrito)
                        <tr>
                            <td class="px-6 py-6 border-b">
                                <div class="flex items-center">
                                    <img class="w-20 h-20 mr-4 rounded" src="{{ Storage::url($detalleCarrito->getProducto()->getImagen()) }}" alt="Imagen">
                                    <span class="text-lg">{{ $detalleCarrito->getProducto()->getNombreProducto() }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 border-b text-lg">${{ number_format($detalleCarrito->getProducto()->getPrecioUnitario(), 2) }}</td>
                            <td class="px-6 py-6 border-b text-lg">
                                <form action="{{ route('carrito.actualizar', $detalleCarrito->getProducto()->getIdProducto()) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="cantidad" min="1" value="{{ $detalleCarrito->getCantidad() }}" class="w-16 px-2 py-1 text-center border rounded">
                            </td>
                            <td class="px-6 py-6 border-b text-lg">${{ number_format($detalleCarrito->getProducto()->getPrecioUnitario() * $detalleCarrito->getCantidad(), 2) }}</td>
                            <td class="px-6 py-6 border-b">
                                <button type="submit" class="text-lg text-blue-600  hover:underline">Actualizar</button>
                                </form>
                                <form action="{{ route('carrito.quitar', $detalleCarrito->getProducto()->getIdProducto()) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-lg text-red-600 hover:underline ml-4">Eliminar</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="px-6 py-6 font-bold text-right uppercase">Total</td>
                            <td class="px-6 py-6 font-bold text-lg">${{ number_format($carrito->getTotal(), 2) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-8 w-2/3 mx-auto">
                @auth
                    <a href="{{ route('pago.step-one') }}" class="px-8 py-4 text-xl font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none mr-10">
                        Proceder al Pago
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 text-xl font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none mr-10">
                        Proceder al Pago
                    </a>
                @endauth
            </div>

            
            
            @else
            <p class="text-center text-lg mt-6">Tu carrito de compras está vacío.</p>
            @endif
        </div>
    </section>
</x-guest-layout>
