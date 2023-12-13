<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Refaccion;
use Illuminate\Http\Request;

use App\Models\Pago;
use App\Models\LineaDeVenta;
use App\Models\Modelos\pagoModelo;

class PagoController extends Controller
{
    //
    public function pagar()
    {
        $pagoModelo = new pagoModelo();
        $pagoModelo->pagar();

        return redirect('/')->with('success', 'Pago realizado con éxito');
    }

    public function stepOne()
{
    return view('pago.step-one');
}

    public function stepTwo()
    {
        return view('pago.step-two');
    }

    public function procesarPago(Request $request)
    {
        $pagoModelo = new pagoModelo();
        $pagoModelo->pagar();

        return redirect('/')->with('success', 'Compra Realizada Exitosamente');
    }

}
