<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioSucursal extends Model
{
    // Define the table associated with the model
    protected $table = 'inventarioSucursales';

    // Indicate that the model does not use auto-incrementing
    public $incrementing = false;

    // Primary key definition for composite keys (optional)
    protected $primaryKey = ['idSucursal', 'idProducto'];

    // Disable timestamps if they are not required
    public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'idSucursal',
        'idProducto',
        'existencia',
        'stockMaximo',
        'stockMinimo',
        'idStatus'
    ];

    // Relationship with Sucursal model
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    // Relationship with Producto model
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
