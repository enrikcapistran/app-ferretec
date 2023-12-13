<x-guest-layout>
    <div class="flex items-center min-h-screen bg-gradient-to-r from-indigo-600 to-indigo-800">
        <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-center text-black">Realizar Pago</h2>
                <div class="w-full bg-gray-200 rounded-full">
                    <div
                        class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                        Paso 1</div>
                </div>
                <form method="POST" action="{{ route('pago.step-two') }}">
                    @csrf

                    <!-- Nombre Completo -->
                    <div class="mt-4">
                        <label for="nombre_completo" class="block text-sm font-medium text-gray-600 text-black">Nombre Completo</label>
                        <input type="text" name="nombre_completo" id="nombre_completo"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            required>
                    </div>

                    <!-- Calle y Número -->
                    <div class="mt-4">
                        <label for="calle_numero" class="block text-sm font-medium text-gray-600 text-black">Calle y Número</label>
                        <input type="text" name="calle_numero" id="calle_numero"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            required>
                    </div>

                    <!-- Colonia -->
                    <div class="mt-4">
                        <label for="colonia" class="block text-sm font-medium text-gray-600 text-black">Colonia</label>
                        <input type="text" name="colonia" id="colonia"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            required>
                    </div>

                    <!-- Grid para Código Postal y Fecha de Entrega -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="codigo_postal" class="block text-sm font-medium text-gray-600 text-black">Código Postal</label>
                            <input type="text" name="codigo_postal" id="codigo_postal"
                                class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                                pattern="[0-9]{5}" title="Debe contener exactamente 5 números" required>
                        </div>

                        <!-- Fecha de Entrega -->
                        <div>
                            <label for="fecha_entrega" class="block text-sm font-medium text-gray-600 text-black">Fecha de Entrega</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" min="{{ now()->toDateString() }}"
                                value="{{ now()->toDateString() }}"
                                class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                                required>
                        </div>
                    </div>

                    <div class="flex justify-center mt-8">
                        <button type="submit"
                            class="px-8 py-4 text-xl font-bold text-white bg-green-600 rounded-full hover:bg-green-700 focus:outline-none">
                            Siguiente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
