<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDeCompra extends Model
{
    // Define the table associated with the model
    protected $table = 'carritoDeCompra';

    // Indicar que la llave primaria es compuesta
    protected $primaryKey = 'idCarrito';

    public $incrementing = true;

    // Desactivar el uso de timestamps
    public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'idUsuario',
        'idSucursal',
        'idStatus',
    ];

    // Relationship with Usuario model
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    // Relationship with Sucursal model
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    // Relationship with DetalleCarrito model
    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class, 'idCarrito');
    }

    // Custom method to obtain a specific cart
    public function obtenerCarrito(int $idUsuario, int $idSucursal)
    {
        return CarritoDeCompra::where('idUsuario', $idUsuario)
            ->where('idSucursal', $idSucursal)
            ->where('idStatus', 1)
            ->first();
    }
}
