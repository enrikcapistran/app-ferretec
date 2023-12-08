<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;


class DetalleSurtidoController extends Controller
{

    public function guardarInventario(Request $request)
    {
        dd($request);

        return redirect()->back()->with('success', 'Inventario actualizado.');
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
