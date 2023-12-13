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
        return $query->where('idTipoProducto', 2)->where('idStatus', 2);
    }

    // Verificar si es Kit o Prod Individual
    public static function buscar($query)
    {
        return self::where('nombreProducto', 'like', '%' . $query . '%')
            ->orWhere('descripcion', 'like', '%' . $query . '%')
            ->orderByRaw("CASE WHEN nombreProducto LIKE '{$query}%' THEN 1 ELSE 2 END")
            ->orderBy('nombreProducto')
            ->get();
    }
}
