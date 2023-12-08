<?php

namespace App\Models\Modelos;

use Illuminate\Http\Request;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\Clases\PedidoDeSurtido;
use App\Models\DetalleSurtido;
use App\Models\Sucursal as sucursalModelo;
use Carbon\Carbon;


class SurtidoModelo
{

    protected ?SurtidoModelo $SurtidoModelo;

    private SurtidosServicios $SurtidosServicios;


    public function __construct(Kit $SurtidoModelo = null)
    {
        $this->SurtidosServicios = new SurtidosServicios();

    }

    public function index()
    {
        $pedidoSurtido = SurtidosServicios::query();
        return $pedidoSurtido;
    }


    
    public function guardarInventario(Request $request, $idSurtido, $cantidadLlegoData )
    {

        $cantidadLlegoData = $request->input('cantidadLlego');

        if (!is_array($cantidadLlegoData)) {
            return redirect()->route('admin.surtidos.index')->with('success', 'No se proporcionaron datos.');
        }

        foreach ($cantidadLlegoData as $idRefaccion => $cantidadLlego) {
            $inventario = InventarioSucursal::where('idSucursal', $idSurtido)
                ->where('idProducto', $idRefaccion)
                ->first();

            if ($inventario) {
                $inventario->existencia += $cantidadLlego;
                $inventario->save();
            } else {
            }
        }

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }


    public function edit($id)
    {
        $pedidoSurtido = SurtidosServicios::find($id);

        if (!$pedidoSurtido) {
            return redirect()->route('ruta_de_error');
        }

        $detalleSurtido = DetalleSurtido::where('idSurtido', $id)->get();

        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('admin.surtidos.index')->with('success', 'No se encontraron datos.');
        }

        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }



    public function FinalizarRevicion($idSurtido)
    {
        $pedidoSurtido = SurtidosServicios::find($idSurtido);
    
        if (!$pedidoSurtido) {
            return redirect()->route('ruta_de_error');
        }
        
        $pedidoSurtido->update(['idStatus' => 2]);
        $pedidoSurtido->fechaDeRecibido = Carbon::now();

        $detalleSurtido = DetalleSurtido::where('idSurtido', $idSurtido)->get();
    
        return redirect()->route('admin.surtidos.index')->with('success', 'No se encontraron datos.');
    }
    
    
    public function crearSurtido(Request $request)
    {
        $surtido = new SurtidosServicios();
        $surtido->idSucursal = $request->input('idSucursal');
        $surtido->idAlmacen = 1;
        $surtido->save();
    
        $idSurtido = $surtido->id;
    
        foreach ($productos as $producto) {
            $detalleSurtido = new DetalleSurtido();
            $detalleSurtido->idSurtido = $idSurtido;
            $detalleSurtido->idProducto = $producto['idProducto'];
            $detalleSurtido->cantidad = $producto['cantidad'];
            $detalleSurtido->save();
        }

        return $idSurtido;
    }


}