<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioAlmacen extends Model
{
    // Define the table associated with the model
    protected $table = 'inventarioAlmacen';

    // Indicate that the model does not use auto-incrementing
    public $incrementing = false;

    // Disable timestamps if they are not required
    public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'idAlmacen',
        'idRefaccion',
        'existencia'
    ];

    // Relationship with Almacen model
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'idAlmacen');
    }

    // Relationship with Refaccion model
    public function refaccion()
    {
        return $this->belongsTo(Refaccion::class, 'idRefaccion', 'idProducto');
    }
}
