<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Refaccion;
use Illuminate\Http\Request;

use App\Models\Pago;
use App\Models\LineaDeVenta;
use App\Models\Modelos\pagoModelo;

class RealizarPagoController extends Controller
{
    //
    public function stepOne(Request $request){
        $pago = $request->session()->get('pago');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addMonth();
        return view('pago.step-one', compact('pago', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request){
        $validated = $request->validate([
            'calle' => ['required'],
            'colonia' => ['required'],
            'cp' => ['required', 'email'],
            'fecha_entrega' => ['required', 'date', new DateBetween, new TimeBetween],
            //'tel_number' => ['required'],
            //'guest_number' => ['required'],
        ]);

        if(empty($request->session()->get('pago'))){
            $pago = new Pago();
            $pago->fill($validated);
            $request->session()->put('pago', $pago);
        } else{
            $pago = $request->session()->get('pago');
            $pago->fill($validated);
            $request->session()->put('pago', $pago);
        }

        return to_route('pago.step.two');
    }

    public function stepTwo(Request $request)
    {
        $pago = $request->session()->get('pago');
        /*$res_table_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation) {
            return $value->res_date->format('Y-m-d') == $reservation->res_date->format('Y-m-d');
        })->pluck('table_id');
        $tables = Table::where('status', TableStatus::Disponible)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_table_ids)->get();*/
        return view('pago.step-two', compact('pago'));
    }

    public function storeStepTwo(Request $request){
        /*$validated = $request->validate([
            'table_id' => ['required']
        ]);
        $pago = $request->session()->get('pago');
        $pago->fill($validated);
        $pago->save();
        $request->session()->forget('pago');*/
        
        return to_route('gracias');
    }

}