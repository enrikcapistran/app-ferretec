<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;
use App\Models\InventarioSucursal as InventarioSucursalServicios;
use Illuminate\Support\Facades\DB;





class DetalleSurtidoSerivicos 
{
    public function procesarInventario(Request $request)
    {
        $idSucursal = $request->input('idSucursal');
        $idRefaccion = $request->input('idRefaccion');
        $cantidad = $request->input('cantidad');
    
        try {
            \DB::beginTransaction();
    
            $detalleSurtidoExistente = InventarioSucursalServicios::where('idSucursal', $idSucursal)
                ->where('idProducto', $idRefaccion)
                ->first();
    
            if ($detalleSurtidoExistente) {
                $detalleSurtidoExistente->existencia += (int)$cantidad;
    
                DB::table('inventarioSucursales')
                    ->where('idSucursal', (int)$idSucursal)
                    ->where('idProducto', (int)$idRefaccion)
                    ->increment('existencia', (int)$cantidad);
            }
    
            \DB::commit();
    
            return back()->with('success', 'Detalles del surtido actualizados correctamente.');
        } catch (\Exception $e) {
            \DB::rollBack();
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

    public function edit($id)
    {
    }
}
