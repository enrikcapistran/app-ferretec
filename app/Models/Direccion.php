<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    // Define the table associated with the model
    protected $table = 'direcciones';

    // Set the primary key
    protected $primaryKey = 'idDireccion';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'idUsuario',
        'calle',
        'colonia',
        'numero',
        'CP',
        'referencia',
        'telefono',
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
}
