<x-guest-layout>
    <div class="flex items-center min-h-screen bg-gradient-to-r from-indigo-600 to-indigo-800">
        <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-center text-black">Realizar Pago</h2>
                <div class="w-full bg-gray-200 rounded-full">
                    <div
                        class="w-100 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                        Paso 2
                    </div>
                </div>
                <form method="POST" action="{{ route('pago.procesarPago') }}">
                    @csrf

                    <!-- Número de Tarjeta -->
                    <div class="mt-4">
                        <label for="numero_tarjeta" class="block text-sm font-medium text-gray-600 text-black">Número de Tarjeta (16 Dígitos)</label>
                        <input type="text" name="numero_tarjeta" id="numero_tarjeta"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" title="Debe contener 16 dígitos separados por guiones"
                            required oninput="formatCreditCard(event)" maxlength="19">
                    </div>

                    <!-- CVV -->
                    <div class="mt-4">
                        <label for="cvv" class="block text-sm font-medium text-gray-600 text-black">CVV (3 Dígitos)</label>
                        <input type="text" name="cvv" id="cvv"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            pattern="[0-9]{3}" title="Debe contener 3 dígitos numéricos"
                            required maxlength="3">
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div class="mt-4">
                        <label for="fecha_vencimiento" class="block text-sm font-medium text-gray-600 text-black">Fecha de Vencimiento (MM/AA)</label>
                        <input type="text" name="fecha_vencimiento" id="fecha_vencimiento"
                            class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-indigo-300"
                            pattern="(0[1-9]|1[0-2])/(2[2-9]|3[0-9])" title="Debe contener un mes y un año válidos"
                            required maxlength="5" oninput="formatExpiryDate(event)">
                    </div>

                    <!-- Otros campos relacionados con la tarjeta, según sea necesario -->

                    <div class="flex justify-center mt-8">
                        <button type="submit" class="px-8 py-4 text-xl font-bold text-white bg-gradient-blue rounded-full focus:outline-none zoom-in">
                            Finalizar Compra
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        @keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.zoom-in {
    transition: transform 0.3s ease-in-out;
}

.zoom-in:hover {
    transform: scale(1.05); /* Ajusta el valor según tu preferencia */
}

.bg-gradient-blue {
    background: linear-gradient(45deg, #05599e, #6574cd);
    background-size: 200% 200%;
    animation: gradientAnimation 3s infinite;
    transition: background-color 0.3s ease-in-out;
}

.bg-gradient-blue:hover {
    background-color: #276180; /* Color más oscuro al hacer hover */
    filter: brightness(1.1);
}
    </style>
    <script>
        function formatCreditCard(event) {
            // Elimina caracteres no numéricos
            let inputValue = event.target.value.replace(/\D/g, '');

            // Inserta guiones cada 4 dígitos
            inputValue = inputValue.replace(/(\d{4})/g, '$1-');

            // Elimina el guión final si existe
            inputValue = inputValue.replace(/-$/, '');

            // Limita a 16 dígitos
            inputValue = inputValue.substring(0, 19);

            // Actualiza el valor del campo
            event.target.value = inputValue;
        }

        function formatExpiryDate(event) {
            // Elimina caracteres no numéricos
            let inputValue = event.target.value.replace(/\D/g, '');

            // Inserta '/' después del segundo carácter
            if (inputValue.length > 2) {
                inputValue = inputValue.substring(0, 2) + '/' + inputValue.substring(2);
            }

            // Limita a 5 caracteres (MM/YY)
            inputValue = inputValue.substring(0, 5);

            // Actualiza el valor del campo
            event.target.value = inputValue;
        }
    </script>
</x-guest-layout>
