<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    // Define the table associated with the model
    protected $table = 'detalleCarrito';

    // Indicate that the model does not use auto-incrementing
    public $primaryKey = 'idDetalleCarrito';

    // Disable timestamps if they are not required
    public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'idDetalleCarrito',
        'idCarrito',
        'idProducto',
        'cantidad'
    ];

    // Relationship with CarritoDeCompra model
    public function carritoDeCompra()
    {
        return $this->belongsTo(CarritoDeCompra::class, 'idCarrito');
    }

    // Relationship with Producto model
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
