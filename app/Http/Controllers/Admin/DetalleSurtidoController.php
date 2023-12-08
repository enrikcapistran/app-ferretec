<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;
use App\Models\InventarioSucursal as InventarioSucursalServicios;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Services\DetalleSurtidoSerivicos;





class DetalleSurtidoController extends Controller
{
    public function guardarInventario (Request $request)
    {
        $idSucursal = $request->input('idSucursal');
        $idRefaccion = $request->input('idRefaccion');
        $cantidad = $request->input('cantidad');
    
        try {
    
            InventarioSucursalServicios::where('idSucursal', $idSucursal)
            ->where('idProducto', $idRefaccion)
            ->increment('existencia', (int)$cantidad);

            return back()->with('success', 'Detalles del surtido actualizados correctamente.');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Error al actualizar los detalles del surtido: ' . $e->getMessage());
        }
    }
    
    
    
    


    public function index()
    {
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        dd($request);

        $detalleSurtido = DetalleSurtidoServicios::where('idSurtido', $id)->get();

        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('ruta_de_error');
        }
        return $this->index($id);
    }


    public function edit($id)
    {
    }
}
