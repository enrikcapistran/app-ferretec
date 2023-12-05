<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
    // Define the table associated with the model
    protected $table = 'refacciones';

    // Set the primary key
    protected $primaryKey = 'idProducto';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Specify the data type of the primary key if it's not an integer
    protected $keyType = 'int';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'SKU',
        'idStatus'
    ];

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
