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
        'email',
        'password',
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
        'password',
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

    public function isAdmin()
    {
        return $this->idRol === 1;
    }

    public function isMarketing()
    {
        return $this->idRol === 2;
    }

    public function isAlmacenista()
    {
        return $this->idRol === 3;
    }

    public function isCajero()
    {
        return $this->idRol === 4;
    }

    public function isClienteNormal()
    {
        return $this->idRol === 5;
    }

    public function isClienteVip()
    {
        return $this->idRol === 6;
    }
}
