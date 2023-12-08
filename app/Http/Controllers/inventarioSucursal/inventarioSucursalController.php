<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventarioSucursalesStoreRequest;
use App\Models\InventarioSucursales;
use Illuminate\Http\Request;

class InventarioSucursalesController extends Controller
{
    public function index()
    {
        $inventarioSucursales = InventarioSucursales::all();
        return view('admin.inventario_sucursales.index', compact('inventarioSucursales'));
    }

    public function create()
    {
        return view('admin.inventario_sucursales.create');
    }

    public function store(InventarioSucursalesStoreRequest $request)
    {
        InventarioSucursales::create($request->validated());
        return redirect()->route('admin.inventarioSucursales.index')->with('success', 'Inventario de Sucursal Guardado Correctamente.');
    }

    public function show($id)
    {
        $inventarioSucursal = InventarioSucursales::findOrFail($id);
        return view('admin.inventario_sucursales.show', compact('inventarioSucursal'));
    }

    public function edit(InventarioSucursales $inventarioSucursal)
    {
        return view('admin.inventario_sucursales.edit', compact('inventarioSucursal'));
    }

    public function update(Request $request, InventarioSucursales $inventarioSucursal)
    {
        $request->validate([
            'idSucursal' => 'required|exists:sucursales,idSucursal',
            'idProducto' => 'required|exists:productos,idProducto',
            'existencia' => 'required|integer|min:0',
            'stockMaximo' => 'required|integer|min:0',
            'stockMinimo' => 'required|integer|min:0',
            'idStatus' => 'required|exists:status,idStatus',
        ]);

        $inventarioSucursal->update($request->validated());
        return redirect()->route('admin.inventario_sucursales.index')->with('success', 'Inventario de Sucursal Actualizado Correctamente.');
    }

    public function destroy(InventarioSucursales $inventarioSucursal)
    {
        $inventarioSucursal->delete();
        return redirect()->route('admin.inventario_sucursales.index')->with('danger', 'Inventario de Sucursal Eliminado.');
    }
}
