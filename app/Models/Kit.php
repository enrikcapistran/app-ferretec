<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    // Define the table associated with the model
    protected $table = 'kits';

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
        'idSucursal',
        'idUsuarioCreador',
        'idUsuarioAutorizador',
        'idStatus'
    ];

    // Relationship with Producto model
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    // Relationship with Sucursal model
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    // Relationship with Usuario model (Creador)
    public function usuarioCreador()
    {
        return $this->belongsTo(Usuario::class, 'idUsuarioCreador');
    }

    // Relationship with Usuario model (Autorizador)
    public function usuarioAutorizador()
    {
        return $this->hasOne(Usuario::class, 'idUsuario', 'idUsuarioAutorizador');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    // Function to retrieve all DetalleKit entries referencing this Kit
    public function detalleKits()
    {
        return $this->hasMany(DetalleKit::class, 'idKit', 'idProducto');
    }
}
