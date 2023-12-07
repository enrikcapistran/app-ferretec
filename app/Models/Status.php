<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // Define the table associated with the model
    protected $table = 'status';

    // Set the primary key
    protected $primaryKey = 'idStatus';

    // Specify the data type of the primary key if it's not an integer
    protected $keyType = 'int';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = ['nombreStatus'];
}
