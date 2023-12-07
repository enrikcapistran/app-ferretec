<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KitStoreRequest;
use App\Models\Producto;
use App\Models\Kit;
use App\Models\Sucursal;
use App\Models\DetalleKit;
use App\Models\Refaccion;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kits = Producto::all()->where('idTipoProducto', '=', 2)->where('idStatus', '=', 11);

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
        //
        $productos = Producto::all()->where('idTipoProducto', '=', 1);
        //dd($productos);
        $sucursales = Sucursal::all();


        return view('admin.kits.create', compact('productos'), compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KitStoreRequest $request)
    {
        //dd($request);
        $image = $request->file('imagen')->store('public/kits');

        //dd($request);


        $producto = Producto::create([
            'nombreProducto' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $image,
            'precioUnitario' => $request->precio,
            'idTipoProducto' => 2,
            'idStatus' => 11,
        ]);

        //dd($producto);

        $usuario = auth()->user();

        //dd($usuario);

        $kit = Kit::create([
            'idProducto' => $producto->idProducto,
            'idSucursal' => $request->sucursal,
            'idUsuarioCreador' => $usuario->idUsuario,
            'idUsuarioAutorizador' => null,
            'idStatus' => 11,
        ]);

        $detallesKit = $request->productos;

        //dd($kit);
        for ($i = 0; $i < count($detallesKit); $i++) {
            $detalleKit = DetalleKit::create([
                'idKit' => $kit->idProducto,
                'idRefaccion' => $detallesKit[$i]['idProducto'],
                'cantidad' => $detallesKit[$i]['cantidad'],
            ]);
        }

        return redirect()->route('admin.kits.index')->with('success', 'Kit Guardado Correctamente.');
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
    public function edit(Kit $kit)
    {
        $producto = Producto::findOrFail($kit->idProducto);

        $refacciones = Producto::all()->where('idTipoProducto', '=', 1);

        //include refacciones in the kit
        $detallesKit = DetalleKit::all()->where('idKit', '=', $kit->idProducto);



        $sucursales = Sucursal::all();

        return view('admin.kits.edit', compact('kit', 'producto', 'detallesKit', 'sucursales', 'refacciones'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        // Delete associated productos directly
        //$kit->productos()->delete();

        // Logic delete kit
        $kit->update([
            'idStatus' => 2,
        ]);

        // Logic delete producto
        $kit->producto()->update([
            'idStatus' => 2,
        ]);

        return redirect()->route('admin.kits.index')->with('danger', 'Kit Eliminado.');
    }
}
