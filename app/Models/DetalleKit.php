<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleKit extends Model
{
    // Define the table associated with the model
    protected $table = 'detalleKits';

    // Indicate that the model does not auto-incrementing
    public $incrementing = false;

    // Disable timestamps if they are not required
    public $timestamps = false;

    // Attributes that are mass assignable
    protected $fillable = [
        'idKit',
        'idRefaccion',
        'cantidad'
    ];

    // Relationship with Kit model
    public function kit()
    {
        return $this->belongsTo(Kit::class, 'idKit', 'idProducto');
    }

    // Relationship with Refaccion model
    public function refaccion()
    {
        return $this->belongsTo(Refaccion::class, 'idRefaccion', 'idProducto');
    }
}
