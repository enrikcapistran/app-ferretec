<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDeCompra extends Model
{
    // Define the table associated with the model
    protected $table = 'carritoDeCompra';

    // Set the primary key
    protected $primaryKey = 'idCarrito';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'idUsuario',
        'idStatus'
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

    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class, 'idCarrito');
    }
}
