<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service\ProductoService;
use App\Models\Model\Producto;

class ProductoModelo
{
    public function index()
    {
    $productosServicios = ProductoServicio::index();
    $Producto = [];

    foreach ($productosServicios as $value) {
        $Producto[] = new Producto($value->idProducto, $value->nombreProductos, $value->descripcion, $value->imagen, $value->precioUnitario, $value->idTipoProducto,$value->idStatus);
    }
    return $Producto;
}

    public function store(Request $request)
    {
        $Producto = $this->crearClientePorRequest($request);
        ProductoServicio::store($Producto);
    }

    public function actualizar($id, array $data)
    {   
        ProductoServicio::actualizar($data, $id);
        return new Producto(
            $idProducto,
            $data['nombreProductos'],
            $data['descripcion'],
            $data['imagen'],
            $data['precioUnitario'],
            $data['idTipoProducto'],
            $data['idStatus']
        );        
    }

    public function borrar(string $id)
    {
        ProductoServicio::delete($id);
    }


    public function buscar($id)
    {
       // $result = DB::select('SELECT * FROM clientes WHERE id = ?', [$id]);

        if (count($result) > 0) {
            $Producto = $result[0];
            return new Producto($Producto->idProducto, $Producto->nombreProductos, $Producto->descripcion, $Producto->imagen, $Producto->precioUnitario, $Producto->idTipoProducto,$Producto->idStatus);
        } else {
            return null;
        }
    }
}
