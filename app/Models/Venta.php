<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Define the table associated with the model
    protected $table = 'ventas';

    // Set the primary key
    protected $primaryKey = 'folio';

    // Attributes that are mass assignable
    protected $fillable = [
        'idSucursal',
        'idEmpleado',
        'idCliente',
        'idPago',
        'fechaVenta',
        'totalPago',
        'idStatus'
    ];

    // Relationship with Sucursal model
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    // Relationship with Usuario model (Empleado)
    public function empleado()
    {
        return $this->belongsTo(Usuario::class, 'idEmpleado');
    }

    // Relationship with Usuario model (Cliente)
    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'idCliente');
    }

    // Relationship with Pago model
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'idPago');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
