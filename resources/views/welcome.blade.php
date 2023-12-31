<x-guest-layout>
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-44 mx-auto text-center bg-center bg-no-repeat bg-cover md:max-w-none" style="background-image: url('https://irp.cdn-website.com/b8e4de53/DESKTOP/jpg/755.jpg')">
        <h1 class="mt-20 text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-black to-blue-700 hover:text-blue-700 md:text-5xl sm:leading-none">
            Bienvenido a FerreTec
        </h1>
        <div class="mx-auto mt-2 text-gray-600 md:text-lg lg:text-xl">
            Con la calidad y precio que buscas
        </div>
        <div class="mt-8">
            <a href="/productos" type="button" class="px-6 py-3 text-lg font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-500 focus:outline-none transition-all duration-300 ease-in-out transform hover:scale-105">
                Ver Productos
            </a>
        </div>
    </div>
    
    <!-- End Main Hero Content -->
    <!-- Inicio Seccion Promociones Kits -->
    
    @php
    //dd(auth()->user()->isAdmin())
    @endphp

    <!-- Section for different user roles -->
    @if(auth()->check())
    @if(auth()->user()->isAdmin())
    <!-- Admin Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Panel de Administrador</h2>
            <!-- Contenido específico para administradores -->
            <!-- ... -->
        </div>
    </section>
    @elseif(auth()->user()->isCajero())
    <!-- Cashier Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Panel de Cajero</h2>
            <!-- Contenido específico para cajeros -->
            <!-- ... -->
        </div>
    </section>
    @elseif(auth()->user()->isClienteNormal())
    <!-- Normal Client Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Panel de Cliente Normal</h2>
            <!-- Contenido específico para clientes normales -->
            <!-- ... -->
        </div>
    </section>
    @elseif(auth()->user()->isClienteVip())
    <!-- VIP Client Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Panel de Cliente VIP</h2>
            <!-- Contenido específico para clientes VIP -->
            <!-- ... -->
        </div>
    </section>
    @elseif(auth()->user()->isMarketing())
    <!-- Marketing Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Panel de Marketing</h2>
            <!-- Contenido específico para el departamento de marketing -->
            <!-- ... -->
        </div>
    </section>
    @endif
    @endif

    <section class="py-20 bg-gray-50">
        <div class="container items-center max-w-6xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-6">
            <div class="flex flex-wrap items-center -mx-3">
                <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
                    <div class="w-full lg:max-w-md">
                        <h2 class="mb-4 text-2xl font-bold">Encuentra los artículos de ferretería que tus proyectos necesitan</h2>


                        <p class="mb-4 font-medium tracking-tight text-gray-400 xl:mb-6"></p>
                        <ul>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">Ferretería en general,
                                    Artículos para la agricultura y acuacultura,
                                    Mangueras y conexiones hidráulicas</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-gray-500">Pinturas,
                                    Baterías,
                                    Tornillería,
                                    Materiales para plomería,
                                    Bandas industriales</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">Aceites para diésel,
                                    Conexiones,
                                    Filtros,
                                    Herramientas en general</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img class="mx-auto sm:max-w-sm lg:max-w-full" src="https://crm.aftgrupo.com/documentacion/70/43881.jpg" alt="feature image"></div>
            </div>
        </div>
    </section>

    <section class="pt-4 pb-12 bg-gray-800">
        <div class="my-16 text-center">
            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                Testimonios </h2>
            <p class="text-xl text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. soluta sapient</p>
        </div>
        <div class="grid gap-2 lg:grid-cols-3 content-center">
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg content-center">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Cliente1</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full" src="https://cdn.pixabay.com/photo/2018/01/04/21/15/young-3061652__340.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Cliente2</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full" src="https://cdn.pixabay.com/photo/2018/01/18/17/48/purchase-3090818__340.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">Cliente3</h2>
                    <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores
                        deserunt
                        ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis
                        pariatur
                        minus consequuntur!</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">John Doe</a>
                </div>
            </div>

        </div>
    </section>
    <script>
        // Mostrar la modal al cargar la página
        window.onload = function() {
            document.getElementById('modal').style.display = 'flex';
        };

    </script>

</x-guest-layout>
<style>
    .btn-light-blue {
        padding: 0.5rem 1rem;
        background-color: #4297d3; /* Lighter blue */
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .btn-light-blue:hover {
        background-color: #4a8acf; /* Ajusta el color al pasar el ratón si es necesario */
    }
</style>