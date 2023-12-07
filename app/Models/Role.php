<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Define the table associated with the model
    protected $table = 'roles';

    // Set the primary key
    protected $primaryKey = 'idRol';

    // Disable auto-increment if the primary key is not an integer
    public $incrementing = false;

    // Specify the data type of the primary key if it's not an integer
    protected $keyType = 'int';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = ['tipoDeUsuario'];
}
