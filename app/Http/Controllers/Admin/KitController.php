<?php

namespace App\Http\Controllers\Admin;

//import de la clase Kit
use App\Models\Clases\Kit;

use App\Http\Controllers\Controller;
use App\Http\Requests\KitStoreRequest;
use App\Models\Producto;
use App\Models\Model;
use App\Models\DetalleKit;
use App\Models\Sucursal;
use App\Models\Refaccion;
use Illuminate\Support\Facades\Log;
use App\Models\Modelos\kitModelo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // try {
        $modelo = new kitModelo();

        $modelo->setInformacion($request->nombreProducto, $request->descripcion, $request->precioUnitario, $request->imagen, $request->sucursal);

        return redirect()->back()->with('success', 'Informacion actualizada.');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('danger', 'Error al actualizar la informacion.');
        //}
    }

    public function finalizarNuevoKit()
    {
        //try {
        //code...
        $modelo = new kitModelo();

        $modelo->grabarKit();
        //} catch (\Throwable $th) {
        //throw $th;
        //}

        return redirect('/admin/kits')->with('success', 'Kit grabado.');
    }

    public function eliminarRefaccion(string $idRefaccion)
    {
        try {
            $modelo = new kitModelo();

            $boolean = $modelo->eliminarRefaccion($idRefaccion);

            if ($boolean) {
                return redirect()->back()->with('success', 'Producto eliminado del kit.');
            } else {
                return redirect()->back()->with('danger', 'Error al eliminar el producto del kit.');
            }
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


        $productos = Producto::all()->where('idTipoProducto', '=', 1);
        $sucursales = Sucursal::all();
        $kit = session()->get('kit');

        return view('admin.kits.create', compact('productos', 'sucursales'), compact('kit'));
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
