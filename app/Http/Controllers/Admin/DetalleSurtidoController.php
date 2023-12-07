<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;


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

    public function show($id)
    {
        $detalleSurtido = DetalleSurtido::where('idSurtido', $id)->get();
    
        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('ruta_de_error');
        }
            return $this->index($id);
    }
    

    public function edit($id)
    {

    }
}
