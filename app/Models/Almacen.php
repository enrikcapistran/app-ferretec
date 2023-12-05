<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    // Define the table associated with the model
    protected $table = 'almacen';

    // Set the primary key
    protected $primaryKey = 'idAlmacen';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'nombreAlmacen',
        'calle',
        'colonia',
        'numero',
        'CP',
        'idStatus'
    ];

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
