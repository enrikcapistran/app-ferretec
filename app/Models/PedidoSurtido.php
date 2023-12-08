<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoSurtido extends Model
{
    protected $table = 'pedidoSurtido';
    protected $primaryKey = 'idSurtido';
    const CREATED_AT = 'fechaDePedido';
    const UPDATED_AT = 'fechaDeRecibido';

    protected $fillable = [
        'idAlmacen',
        'idSucursal',
        'idStatus',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'idAlmacen');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursal');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleSurtido::class, 'idSurtido');
    }
}
