<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KitStoreRequest;
use App\Models\Kit;
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
        //Obtener todos los modelos de Categoría
        $kits = Kit::all();

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
        return view('admin.kits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KitStoreRequest $request)
    {
        //
        $image = $request->file('image')->store('public/kits');

        Kit::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);

        return to_route('admin.kits.index')->with('success', 'Kit Guardado Correctamente.');
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
        //
        return view('admin.kits.edit', compact('kit'));
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
        //
        $request->validate([
            "name" => 'required',
            "description" => 'required'
        ]);
        $image = $kit->image;
        if($request->hasFile('image')){
            Storage::delete($kit->image);
            $image = $request->file('image')->store('public/kits');
        }

        $kit->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image 
        ]);

        return to_route('admin.kits.index')->with('success', 'Kit Actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        //
        Storage::delete($kit->image);
        $kit->menus()->detach();
        $kit->delete();

        return to_route('admin.kits.index')->with('danger', 'Kit Eliminado.');
    }
}
