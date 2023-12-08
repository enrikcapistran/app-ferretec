<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleSurtido extends Model
{
    protected $table = 'detallesurtido';

    protected $primaryKey = 'idSurtidoDetalle';
    
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    protected $fillable = [
        'idSurtido',
        'idRefaccion',
        'cantidad',
    ];

    public function surtido()
    {
        return $this->belongsTo(PedidoSurtido::class, 'idSurtido');
    }

    public function refaccion()
    {
        return $this->belongsTo(Refaccion::class, 'idRefaccion');
    }
}
