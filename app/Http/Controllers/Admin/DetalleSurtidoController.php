<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;
use App\Models\InventarioSucursal as InventarioSucursalServicios;
use App\Models\Modelos\DetalleSurtidoModelo;





class DetalleSurtidoController extends Controller
{







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
