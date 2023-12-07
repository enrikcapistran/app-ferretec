<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Refaccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductosRefacciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Datos de muestra para 15 productos
        $products = [
            ['Batería de Coche', 'Batería de alta calidad para un rendimiento mejorado', 'images/products/bateria_coche.jpg', 120.00],
            ['Juego de Herramientas', 'Juego de herramientas completo para la reparación de coches', 'images/products/juego_herramientas.jpg', 80.00],
            ['Filtro de Aceite', 'Filtro de aceite duradero para la protección del motor', 'images/products/filtro_aceite.jpg', 15.50],
            ['Pastillas de Freno', 'Pastillas de freno de alto rendimiento para la seguridad', 'images/products/pastillas_freno.jpg', 45.00],
            ['Bujías', 'Bujías eficientes para un mejor encendido', 'images/products/bujias.jpg', 22.30],
            ['Filtro de Aire', 'Filtro de aire para mejorar la respiración del motor', 'images/products/filtro_aire.jpg', 18.20],
            ['Alternador', 'Alternador fiable para la generación de energía', 'images/products/alternador.jpg', 150.00],
            ['Correa de Distribución', 'Correa de distribución duradera para el tiempo del motor', 'images/products/correa_distribucion.jpg', 35.00],
            ['Radiador', 'Radiador eficiente para la refrigeración del motor', 'images/products/radiador.jpg', 110.00],
            ['Amortiguadores', 'Amortiguadores para una conducción suave', 'images/products/amortiguadores.jpg', 90.00],
            ['Líquido de Transmisión', 'Líquido de transmisión de alta calidad', 'images/products/liquido_transmision.jpg', 30.00],
            ['Sistema de Escape', 'Kit completo del sistema de escape', 'images/products/sistema_escape.jpg', 200.00, 12],
            ['Limpiaparabrisas', 'Limpiaparabrisas duraderos para una visión clara', 'images/products/limpiaparabrisas.jpg', 20.00],
            ['Faros', 'Faros brillantes y de larga duración', 'images/products/faros.jpg', 60.00],
            ['Inflador de Neumáticos', 'Inflador de neumáticos portátil para uso de emergencia', 'images/products/inflador_neumaticos.jpg', 25.00],
        ];

        foreach ($products as $index => $product) {
            Producto::create([
                'idProducto' => $index + 1,
                'nombreProducto' => $product[0],
                'descripcion' => $product[1],
                'imágen' => $product[2],
                'precioUnitario' => $product[3],
                'idTipoProducto' => 1,
            ]);

            // Crear entrada de Refaccion
            Refaccion::create([
                'idProducto' => $index + 1,
                'SKU' => 'SKU' . str_pad($index + 1, 5, "0", STR_PAD_LEFT),
            ]);
        }
    }
}
