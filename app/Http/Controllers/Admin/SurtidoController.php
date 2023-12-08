<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;
use App\Models\Sucursal as SucursalServicios;
use App\Models\Producto as ProductosServicios;
use App\Models\InventarioSucursal;
use App\Models\DetalleSurtido;
use App\Models\Sucursal as sucursalModelo;


class SurtidoController extends Controller
{


    public function index(Request $request)
    {
        $pedidoSurtido = SurtidosServicios::query();

        $folio = $request->input('folio');
        if ($folio) {
            $pedidoSurtido->where('idSurtido', $folio);
        }

        $pedidoSurtido = $pedidoSurtido->get();

        return view('admin.surtidos.index', compact('pedidoSurtido'));
    }


    public function create()
    {
        $productos = ProductosServicios::all()->where('idTipoProducto', '=', 1);
        $sucursales = SucursalServicios::all();

        return view('admin.surtidos.create', compact('productos'), compact('sucursales'));
    }

    public function guardarInventario(Request $request, $idSurtido)
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




    public function show(Request $request, $id)
    {
        dd($request);
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


    public function update(Request $request, $id)
    {
        //
    }

    public function finalizarSurtido(Request $request)
    {
        $validatedData = $request->validate([
            'sucursal' => 'required',
            'productos.*.idProducto' => 'required',
            'productos.*.cantidad' => 'required|integer',
        ]);

        $surtido = SurtidosServicios::create([
            'idSucursal' => $request->sucursal,
        ]);

        foreach ($request->productos as $producto) {
            DetalleSurtido::create([
                'idSurtido' => $surtido->id,
                'idProducto' => $producto['idProducto'],
                'cantidad' => $producto['cantidad'],
            ]);
        }

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
