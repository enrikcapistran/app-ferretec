<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelos\KitModelo;
use Illuminate\Http\Request;
use App\Models\Modelos\refaccionModelo;

class MaterializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kitModelo = new KitModelo();
        $productos = $kitModelo->obtenerKitsAprovados();

        return view('admin.materializacion.index', compact('productos'));
    }

    public function materializarShow(int $idKit)
    {
        $kitModelo = new KitModelo();

        $kit = $kitModelo->obtenerKitConDetalle($idKit);

        $refaccionModelo = new refaccionModelo();

        $refacciones = $refaccionModelo->getTodasRefacciones();

        $max = $kitModelo->maxKitsPosibles($idKit);

        return view('admin.materializacion.materializar', compact('kit', 'refacciones', 'max'));
    }

    public function guardarMaterializacion(Request $request)
    {
        $kitModelo = new KitModelo();

        if ($request->input('cantidad') > $kitModelo->maxKitsPosibles($request->input('idKit'))) {
            return redirect()->route('admin.materializacion.index')->with('error', 'No hay suficientes refacciones para materializar');
        }

        $kitModelo->materializarKit($request->input('idKit'), $request->input('cantidad'), $request->input('refaccion'));


        return redirect()->route('admin.materializacion.index')->with('success', 'Materializacion guardada con exito');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
