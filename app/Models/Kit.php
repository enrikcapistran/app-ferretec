<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',   
        'descripcion',
        'imagen',
        'precio',
        'stock',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'kit_producto');
    }
}
