<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservations = Reservation::all();

        //
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Disponible)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        //
        $table = Table::findOrFail($request->table_id);
        if($request->guest_number > $table->guest_number){
            return back()->with('warning', 'Seleccione una mesa con más lugares.');
        }

        $request_date = Carbon::parse($request->res_date);
        
        // Verificar que no coincida el mismo día en caso de la mesa estar reservada.
        foreach($table->reservations as $reservation){
            if($reservation->res_date->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'La mesa está ocupada en la fecha especificada.');
            }
        }

        Reservation::create($request->validated());

        return to_route('admin.reservations.index')->with('success', 'Reservación Guardada Correctamente.');
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
    public function edit(Reservation $reservation)
    {
        //
        $tables = Table::where('status', TableStatus::Disponible)->get();
        return view ('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {
        //
        $table = Table::findOrFail($request->table_id);
        if($request->guest_number > $table->guest_number){
            return back()->with('warning', 'Seleccione una mesa con más lugares.');
        }

        $request_date = Carbon::parse($request->res_date);
        
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();

        // Verificar que no coincida el mismo día en caso de la mesa estar reservada.
        foreach($reservations as $reservation){
            if($reservation->res_date->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'La mesa está ocupada en la fecha especificada.');
            }
        }

        $reservation->update($request->validated());

        return to_route('admin.reservations.index')->with('success', 'Reservación Actualizada Correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
        $reservation->delete();
        return to_route('admin.reservations.index')->with('danger', 'Reservación Eliminada.');

    }
}