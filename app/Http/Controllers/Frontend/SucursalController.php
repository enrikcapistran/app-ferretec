<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function elegirSucursal(Request $request)
    {
        // Validaciones y lógica para guardar la sucursal seleccionada
        $request->validate([
            'sucursal' => 'required|in:sucursal1,sucursal2,sucursal3,sucursal4',
        ]);

        // Guarda la sucursal en la sesión
        session(['sucursalSeleccionada' => $request->input('sucursal')]);

        // Redirecciona a la ruta que desees después de elegir la sucursal
        return redirect()->route('/'); // Reemplaza 'nombre_de_la_ruta' con la ruta real
    }
}