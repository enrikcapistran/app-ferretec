@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Resultados de la Búsqueda</h2>

        @if ($resultados->isEmpty())
            <p>No se encontraron resultados para la búsqueda.</p>
        @else
            <ul>
                @foreach ($resultados as $producto)
                    <li>
                        <h3>{{ $producto->nombreProducto }}</h3>
                        <p>{{ $producto->descripcion }}</p>
                        <p>Precio: ${{ $producto->precioUnitario }}</p>
                        {{-- Agrega más detalles según la estructura de tu modelo Producto --}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection