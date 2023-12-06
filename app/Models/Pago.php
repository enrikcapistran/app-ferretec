<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    // Define the table associated with the model
    protected $table = 'pago';

    // Set the primary key
    protected $primaryKey = 'idPago';

    // Disable auto-increment if the primary key is not an integer
    public $incrementing = false;

    // Specify the data type of the primary key if it's not an integer
    protected $keyType = 'int';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = ['metodoDePago', 'idStatus'];

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
