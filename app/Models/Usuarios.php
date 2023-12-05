<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    // Define the table associated with the model
    protected $table = 'usuarios';

    // Set the primary key
    protected $primaryKey = 'idUsuario';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'correoElectronico',
        'contraseña',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombre',
        'fechaNacimiento',
        'idRol',
        'idStatus',
        'email_verified_at'
    ];

    // Hidden attributes
    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    // Relationship with Role model
    public function role()
    {
        return $this->belongsTo(Role::class, 'idRol');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
