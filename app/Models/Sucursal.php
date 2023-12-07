<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    // Define the table associated with the model
    protected $table = 'sucursales';

    // Set the primary key
    protected $primaryKey = 'idSucursal';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'nombreSucursal',
        'calle',
        'colonia',
        'numero',
        'CP',
        'telefono',
        'idStatus'
    ];

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
