<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\DetallesPedidosSurtidos as DetalleSurtidoServicios;
use App\Models\Sucursal as SucursalServicios;
use App\Models\Producto as ProductosServicios;
use App\Models\InventarioSucursal;
use App\Models\Sucursal as sucursalModelo;
use App\Models\Modelos\SurtidoModelo;

class SurtidoController extends Controller
{


    public function index(Request $request)
    {
        $surtidoModelo = new SurtidoModelo();

        $folio = $request->input('folio');

        if ($folio) {
            $pedidoSurtido = $surtidoModelo->index()->where('idSurtido', $folio)->get();
        } else {
            $pedidoSurtido = $surtidoModelo->index()->get();
        }

        return view('admin.surtidos.index', compact('pedidoSurtido'));
    }



    public function create()
    {
        $productos = ProductosServicios::all()->where('idTipoProducto', '=', 1);
        $sucursales = SucursalServicios::all();

        return view('admin.surtidos.create', compact('productos'), compact('sucursales'));
    }


    
    public function guardarSurtido(Request $request)
    {
        $idSucursal = $request->input('idSucursal');
        $idRefaccion = $request->input('idRefaccion');
        $cantidad = $request->input('cantidades');
        $idSurtido = $request->input('idSurtido');

        $surtidoModelo = new SurtidoModelo();



        $surtidoModelo->guardarSurtido($idSucursal, $idRefaccion, $cantidad, $idSurtido);

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }
    


    public function edit($id)
    {
        $surtidoModelo = new SurtidoModelo();
        $detalleSurtidoModel = new DetalleSurtidoServicios();

        $data = $surtidoModelo->edit($id);

        if (!$data) {
            return redirect()->route('admin.surtidos.index')->with('success', 'No se encontraron datos.');
        }
        //dd($data);
        $detalleSurtido = $data['DetallesPedidosSurtidos'];
        $pedidoSurtido = $data['pedidoSurtido'];

        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }



    public function FinalizarRevicion(Request $request)
    {
        $GuardarInventario = new SurtidoController();

        $GuardarInventario->guardarSurtido($request);

        $idSurtido = $request->input('idSurtido');

        $surtidoModelo = new SurtidoModelo();

        return $surtidoModelo->FinalizarRevicion($idSurtido);
    }



/*
    public function finalizarSurtido(Request $request)
    {
        //dd($request);
        //$productos = $request->input('productos');

        $surtidoModelo = new SurtidoModelo();

        $idSurtido = $this->SurtidoModelo->crearSurtido($request);

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }

*/

















    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
