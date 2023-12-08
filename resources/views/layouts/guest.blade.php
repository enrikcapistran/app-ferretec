<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <!-- Ventana Modal para Seleccionar Sucursal -->
    @if(!session('sucursal'))
    <div id="modal" class="fixed inset-0 z-10 bg-black bg-opacity-50 flex items-center justify-center">
        <!-- Contenido de la Modal -->
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Selecciona una Sucursal</h2>
            <div class="grid grid-cols-2 gap-4">
                <!-- Opciones de Sucursales -->
                <a href="{{route('seleccionar-sucursal',1)}}" class="py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none">Sucursal Norte</a>
                <a href="{{route('seleccionar-sucursal',2)}}" class="py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none">Sucursal Este</a>
                <a href="{{route('seleccionar-sucursal',3)}}" class="py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none">Sucursal Sur</a>
                <a href="{{route('seleccionar-sucursal',4)}}" class="py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none">Sucursal Oeste</a>
            </div>
        </div>
    </div>
    @endif
    <div class="bg-white shadow-md sticky top-0 w-full" x-data="{ isOpen: false }">
        <nav class="container px-12 py-8 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="/">
                    FerreTec
                </a>
                <!-- Mobile menu button -->
                <div @click="isOpen = !isOpen" class="flex md:hidden">
                    <button type="button" class="text-gray-800 hover:text-gray-400 focus:outline-none focus:text-gray-400" aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isOpen ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                @if(session('sucursal'))
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-md hover:text-blue-700 pl-8" href="{{ route('sucursal.clear') }}">{{session('sucursal')->getNombreSucursal()}}</a>
                @endif
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="/">Inicio</a>
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('productos.index') }}">Productos</a>
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('carrito.index') }}">Carrito de Compra</a>

                @auth
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('admin.index') }}">Iniciar Sesión</a>
                @endauth


                @auth
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a class="text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 md:text-2xl hover:text-blue-700" href="{{ route('register') }}">Registro</a>
                @endauth
            </div>
        </nav>
    </div>
    <div class="min-h-screen font-sans text-gray-900 antialiased mt-0">
        {{ $slot }}
    </div>
    <footer class="bg-gray-800 border-t border-gray-200">
        <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
            <div class="flex justify-center mt-4 lg:mt-0">
                <a>
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                        <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
