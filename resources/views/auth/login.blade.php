<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600">
        <div class="bg-white p-8 shadow-md rounded-md w-full sm:w-96">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="text-center text-2xl font-semibold text-white bg-indigo-800 p-4">
                ¡Bienvenido!
            </div>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-100 border-2 border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-100 border-2 border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="flex items-center text-gray-700">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500 focus:outline-none" name="remember">
                        <span class="ml-2 text-sm">{{ __('Recuerdame') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-indigo-600 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="bg-indigo-500 hover:bg-indigo-600">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
