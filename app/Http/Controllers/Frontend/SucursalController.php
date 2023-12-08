<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Modelos\sucursalModelo;

class SucursalController extends Controller
{
    // Otros métodos del controlador...

    /**
     * Muestra el formulario para elegir la sucursal.
     *
     * @return \Illuminate\View\View
     */
    public function mostrarFormularioEleccion()
    {
        return view(''); // Reemplaza 'nombre_de_tu_vista' con el nombre real de tu vista
    }

    /**
     * Maneja la elección de la sucursal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function seleccionarSucursal(int $idSucursal)
    {
        $sucursalModelo = new sucursalModelo();
        // Lógica para guardar la sucursal en la sesión
        $sucursal = $sucursalModelo->obtenerSucursal($idSucursal);

        session()->put('sucursal', $sucursal);

        // Devuelve la información de la sucursal seleccionada
        return redirect()->back();
    }
}
