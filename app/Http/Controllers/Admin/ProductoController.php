<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoStoreRequest;
use App\Models\Producto as ProductoServicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = ProductoServicios::all();
        return view('admin.productos.index', compact('productos'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoStoreRequest $request)
    {
        // Obtén la ruta donde se almacenará la imagen
        $imagen = $request->file('imagen')->store('public/productos');
    
        // Crea un nuevo producto con los datos proporcionados
        ProductoServicios::create([
            'nombreProducto' => $request->nombreProducto,
            'descripcion' => $request->descripcion,
            'imagen' => $imagen,
            'precioUnitario' => $request->precioUnitario,
            //'stock' => $request->stock,
            'idTipoProducto' => 1, //DUDA
            'idStatus' => 1, //DUDA
        ]);
    
        // Redirige a la vista de índice o realiza alguna acción después de crear el producto
        return redirect()->route('admin.productos.index')->with('success', 'Producto Guardado Correctamente.');
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
        $producto = ProductoServicios::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductoServicios $producto)
    {
        //
        //$producto = ProductoServicios::findOrFail($producto->idProducto);
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoServicios $producto)
    {
        //
        $request->validate([
            'nombreProducto' => 'required',
            'descripcion' => 'required',
            'precioUnitario' => 'required',
            //'stock' => 'required',
        ]);
        $imagen = $producto->imagen;
        if ($request->hasFile('imagen')) {
            Storage::delete($producto->imagen);
            $imagen = $request->file('imagen')->store('public/productos');
        }

        $producto->update([
            'nombreProducto' => $request->nombreProducto,
            'descripcion' => $request->descripcion,
            'imagen' => $imagen,
            'precioUnitario' => $request->precioUnitario,
            //'stock' => $request->stock,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto Actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoServicios $producto)
    {
        //
        Storage::delete($producto->imagen);
        $producto->kits()->detach();
        $producto->delete();

        return to_route('admin.productos.index')->with('danger', 'Producto Eliminado.');
    }
}
