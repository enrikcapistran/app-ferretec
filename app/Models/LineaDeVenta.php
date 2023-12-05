<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaDeVenta extends Model
{
    // Define the table associated with the model
    protected $table = 'lineaDeVenta';

    // Set the primary key
    protected $primaryKey = 'idLineaDeVenta';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'idVenta',
        'idProducto',
        'cantidad',
        'precioUnitario',
        'idStatus'
    ];

    // Relationship with Venta model
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta', 'folio');
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
