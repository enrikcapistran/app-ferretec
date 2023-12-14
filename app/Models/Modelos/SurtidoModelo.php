<?php

namespace App\Models\Modelos;

use App\Models\Clases\PedidoDeSurtido;
use App\Models\DetallesPedidosSurtidos;
use App\Models\Sucursal as sucursalModelo;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\InventarioSucursal as inventarioSucursalServicios;


class SurtidoModelo
{

    protected ?SurtidoModelo $SurtidoModelo;
    private inventarioSucursalServicios $inventarioSucursalServicios;
    private SurtidosServicios $SurtidosServicios;


    public function __construct(Kit $SurtidoModelo = null)
    {
        $this->SurtidosServicios = new SurtidosServicios();
        $this->inventarioSucursalServicios = new inventarioSucursalServicios();

    }

    public function index()
    {
        $pedidoSurtido = SurtidosServicios::query();
        return $pedidoSurtido;
    }



    public function guardarSurtido($idSucursal, $idRefacciones, $cantidades)
    {
        try {
            if (count($idRefacciones) !== count($cantidades)) {
                return 'Los arreglos no tienen la misma longitud.';
            }
    
            foreach ($idRefacciones as $index => $idRefaccion) {
                $cantidad = $cantidades[$index];
    
                $inventario = $this->inventarioSucursalServicios
                    ->where('idSucursal', $idSucursal)
                    ->where('idProducto', $idRefaccion)
                    ->first();
    
                if ($inventario) {
                    $inventarioSucursal = $this->inventarioSucursalServicios
                        ->where('idSucursal', $idSucursal)
                        ->where('idProducto', $idRefaccion)
                        ->update([
                            'existencia' => $inventario->existencia + $cantidad
                        ]);
                } else {
                    $this->inventarioSucursalServicios->create([
                        'idSucursal' => $idSucursal,
                        'idProducto' => $idRefaccion,
                        'existencia' => $cantidad,
                        'stockMaximo' => 100,
                        'stockMinimo' => 10,
                    ]);
                }
            }
    
            return 'Surtido guardado correctamente.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    


    public function edit($id)
    {
        $pedidoSurtido = SurtidosServicios::find($id);

        if (!$pedidoSurtido) {
            return redirect()->route('admin.surtidos.index')->with('error', 'No se encontraron datos.');
        }

        $DetallesPedidosSurtidos = DetallesPedidosSurtidos::where('idSurtido', $id)->get();

        if ($DetallesPedidosSurtidos->isEmpty()) {
            return redirect()->route('admin.surtidos.index')->with('error', 'No se encontraron datos.');
        }

        return view('admin.surtidos.edit', compact('DetallesPedidosSurtidos', 'pedidoSurtido'));
    }



    public function FinalizarRevicion($id)
    {
        $pedidoSurtido = SurtidosServicios::findOrFail($id);

        //dd($pedidoSurtido);

        if (!$pedidoSurtido) {
            return redirect()->route('admin.surtidos.index')->with('falied', 'Error al Finalizar.');
        }

        $pedidoSurtido->update(['idStatus' => 2]);

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }






    public function crearSurtido(Request $request)
    {
        $surtido = new Surtido();
        $surtido->idSucursal = $request->input('sucursal');
        $surtido->save();

        $idSurtido = $surtido->id;

        foreach ($productos as $producto) {
            $DetallesPedidosSurtidos = new DetallesPedidosSurtidos();
            $DetallesPedidosSurtidos->idSurtido = $idSurtido;
            $DetallesPedidosSurtidos->idProducto = $producto['idProducto'];
            $DetallesPedidosSurtidos->cantidad = $producto['cantidad'];
            $DetallesPedidosSurtidos->save();
        }

        return $idSurtido;
    }









}
