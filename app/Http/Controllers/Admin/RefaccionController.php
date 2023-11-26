<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefaccionStoreRequest;
use App\Models\Refaccion;
use App\Models\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RefaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $refaccions = Refaccion::all();

        //
        return view('admin.refaccions.index', compact('refaccions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kits = Kit::all();

        return view('admin.refaccions.create', compact('kits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefaccionStoreRequest $request)
    {
        //
        $image = $request->file('image')->store('public/refaccions');

        $refaccion = Refaccion::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price,
        ]);

        if($request->has('kits')){
            $refaccion->kits()->attach($request->kits);
        }

        return to_route('admin.refaccions.index')->with('success', 'Refacción Guardado Correctamente.');
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
    public function edit(Refaccion $refaccion)
    {
        //
        $kits = Kit::all();
        return view('admin.refaccions.edit', compact('refaccions', 'kit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refaccion $refaccion)
    {
        //
        $request->validate([
            "name" => 'required',
            "description" => 'required',
            "price" => 'required'
        ]);
        $image = $refaccion->image;
        if($request->hasFile('image')){
            Storage::delete($refaccion->image);
            $image = $request->file('image')->store('public/refaccions');
        }

        $refaccion->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image 
        ]);

        if($request->has('kits')){
            $refaccion->kits()->sync($request->kits);
        }

        return to_route('admin.refaccions.index')->with('success', 'Menú Actualizado Correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refaccion $refaccion)
    {
        //
        Storage::delete($refaccion->image);
        $refaccion->refaccions()->detach();
        $refaccion->delete();
        
        return to_route('admin.refaccions.index')->with('danger', 'Refacción Eliminada.');
    }
}
