<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;
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


    /*
    public function guardarInventario(Request $request, $idSurtido)
    {
        dd($request);
        $surtidoModelo = new SurtidoModelo();

        $pedidoSurtido = $surtidoModelo->guardarInventario($idSurtido, $request->cantidadLlegoData);

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }
    */


    public function edit($id)
    {
        $surtidoModelo = new SurtidoModelo();
        $detalleSurtidoModel = new DetalleSurtidoServicios();

        $data = $surtidoModelo->edit($id);

        if (!$data) {
            return redirect()->route('ruta_de_error');
        }

        $detalleSurtido = $data['detalleSurtido'];
        $pedidoSurtido = $data['pedidoSurtido'];

        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }


    public function FinalizarRevicion(Request $request, $idSurtido)
    {
        $surtidoModelo = new SurtidoModelo();

        return $surtidoModelo->FinalizarRevicion($request, $idSurtido);
    }




    public function finalizarSurtido(Request $request)
    {
        //dd($request);
        //$productos = $request->input('productos');

        $surtidoModelo = new SurtidoModelo();

        $idSurtido = $this->SurtidoModelo->crearSurtido($request);

        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }



















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
