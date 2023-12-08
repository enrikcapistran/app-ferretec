<?php

namespace App\Http\Controllers\Admin;


//CLASES
use App\Models\Clases\Kit;
use App\Http\Controllers\Controller;

//MODELOS
use App\Models\Modelos\kitModelo;
use App\Models\Modelos\sucursalModelo;
use App\Models\Modelos\RefaccionModelo;

use Illuminate\Http\Request;

class KitController extends Controller
{

    //Responde a '/kit/iniciar' 'kits.iniciar'
    public function iniciarNuevoKit()
    {
        $modelo = new kitModelo();

        $modelo->iniciarNuevoKit();

        return redirect('admin/kits/create');
    }

    //Responde a '/kit/añadirRefaccion' 'kits.addRefaccion'
    public function añadirRefacciones(Request $request)
    {
        try {
            $modelo = new kitModelo();
            $boolean = $modelo->añadirRefaccion($request->idRefaccion, $request->cantidad);

            if ($boolean) {
                return redirect()->back()->with('success', 'Producto agregado al kit.');
            } else {
                return redirect()->back()->with('danger', 'Producto duplicado en el kit.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Error al agregar el producto al kit.');
        }
    }

    public function setInformacion(Request $request)
    {

        $modelo = new kitModelo();

        $image = $request->file('imagen')->store('public/kits');

        $modelo->setInformacion($request->nombreProducto, $request->descripcion, $request->precioUnitario, $image, $request->sucursal);

        return redirect()->back()->with('success', 'Informacion actualizada.');
    }

    public function finalizarNuevoKit()
    {

        $modelo = new kitModelo();

        $modelo->grabarKit();


        return redirect('/admin/kits')->with('success', 'Kit grabado.');
    }

    public function eliminarRefaccion(string $idRefaccion)
    {
        try {
            $modelo = new kitModelo();

            $modelo->eliminarRefaccion($idRefaccion);


            return redirect()->back()->with('success', 'Producto eliminado del kit.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Error al eliminar el producto del kit.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $modelo = new kitModelo();

        $kits = $modelo->obtenerKitsEnDiseño();

        //
        return view('admin.kits.index', compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursalModelo = new sucursalModelo();
        $sucursales = $sucursalModelo->getTodasSucursales();

        $refaccionesModelo = new RefaccionModelo();
        $refacciones = $refaccionesModelo->getTodasRefacciones();

        $kit = session()->get('kit');

        return view('admin.kits.create', compact('refacciones', 'sucursales', 'kit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $idKit)
    {

        $kitModelo = new kitModelo();
        $kit = $kitModelo->obtenerKitConDetalle($idKit);

        session()->put('kit', $kit);

        $sucursalModelo = new sucursalModelo();
        $sucursales = $sucursalModelo->getTodasSucursales();

        $refaccionesModelo = new RefaccionModelo();
        $refacciones = $refaccionesModelo->getTodasRefacciones();

        return view('admin.kits.edit', compact('kit', 'refacciones', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        /*
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'stock' => 'required',
        ]);
        */


        $producto = $kit->producto();

        if ($request->hasFile('imagen')) {
            // Storage::delete($producto->imagen);
            $imagen = $request->file('imagen')->store('public/productos');
        }

        $producto->update([
            'nombreProducto' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precioUnitario' => $request->precio,
            'idStatus' => 11,
        ]);

        $kit->update([
            'idSucursal' => $request->sucursal,
        ]);

        if ($request->has('productos')) {
            // Sync selected productos with the kit
            $kit->productos()->sync($request->productos);
        } else {
            // If no productos are selected, detach all existing productos
            $kit->productos()->detach();
        }

        return redirect()->route('admin.kits.index')->with('success', 'Kit Actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idKit
     * @return \Illuminate\Http\Response
     */
    public function eliminarKit(int $idKit)
    {


        $modelo = new kitModelo();

        $kit = $modelo->obtenerKitConDetalle($idKit);

        $modelo->eliminarDiseñoKit($kit);

        return redirect()->route('admin.kits.index')->with('danger', 'Diseño Kit Eliminado.');
    }
}
