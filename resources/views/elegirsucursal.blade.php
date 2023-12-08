<div id="elegirsucursal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-8 rounded-md">
        <h2 class="text-2xl font-bold mb-4">Selecciona una Sucursal</h2>
        <!-- Agrega aquí el código para mostrar las opciones de sucursales -->
        <ul>
            <li><a href="{{ route('elegir.sucursal', ['sucursal' => 'sucursal1']) }}">Sucursal 1</a></li>
            <li><a href="{{ route('elegir.sucursal', ['sucursal' => 'sucursal2']) }}">Sucursal 2</a></li>
            <li><a href="{{ route('elegir.sucursal', ['sucursal' => 'sucursal3']) }}">Sucursal 3</a></li>
            <li><a href="{{ route('elegir.sucursal', ['sucursal' => 'sucursal4']) }}">Sucursal 4</a></li>
        </ul>
    </div>
</div>