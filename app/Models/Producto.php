<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Define the table associated with the model
    protected $table = 'productos';

    // Set the primary key
    protected $primaryKey = 'idProducto';

    protected $keyType = 'int';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'nombreProducto',
        'descripcion',
        'imagen',
        'precioUnitario',
        'idTipoProducto',
        'idStatus'
    ];

    // Relationship with TipoProducto model
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'idTipoProducto');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    // Verificar si es Kit o Prod Individual
    public function scopeSeleccionarSoloKits($query)
    {
        return $query->where('idTipoProducto', 2)->where('idStatus', 13);   
    }
}
