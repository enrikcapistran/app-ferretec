<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Refaccion;
use Illuminate\Http\Request;

use App\Models\Pago;
use App\Models\LineaDeVenta;
use App\Models\Modelos\pagoModelo;

class pagoController extends Controller
{
    //
    public function pagar()
    {
        $pagoModelo = new pagoModelo();
        $pagoModelo->pagar();

        return redirect('/')->with('success', 'Pago realizado con éxito');
    }
}
