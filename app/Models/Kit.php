<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(Producto::class);
    }
}
