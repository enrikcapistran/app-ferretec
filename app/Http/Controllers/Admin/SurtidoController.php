<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PedidoSurtido as SurtidosServicios;
use App\Models\DetalleSurtido;


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
        //
    }

    public function guardarInventario(Request $request, $idSurtido)
    {
        $cantidadLlegoData = $request->input('cantidadLlego');
    
        if (!is_array($cantidadLlegoData)) {
            // Manejar el caso en el que no se recibió un array correctamente
            // (por ejemplo, redirigir con un mensaje de error)
        }
    
        foreach ($cantidadLlegoData as $idRefaccion => $cantidadLlego) {
            InventarioSucursal::create([
                'idSucursal' => $idSurtido,
                'idProducto' => $idRefaccion,
                'existencia' => $cantidadLlego,
            ]);
        }
    
        return redirect()->route('admin.surtidos.index')->with('success', 'Surtido de Sucursal Guardado Correctamente.');
    }
    


    public function show($id)
    {
       
    }
    

    public function edit($id)
    {
        $pedidoSurtido = SurtidosServicios::find($id);
    
        if (!$pedidoSurtido) {
            return redirect()->route('ruta_de_error');
        }
    
        $detalleSurtido = DetalleSurtido::where('idSurtido', $id)->get();
    
        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('ruta_de_error');
        }
    
        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }
    

    public function update(Request $request, $id)
    {
        //
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
