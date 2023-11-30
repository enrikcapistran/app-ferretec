<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',   
        'descripcion',
        'imagen',
        'precio',
        'stock',
        'kit_id',
    ];

    public function kits()
    {
        return $this->belongsToMany(Kit::class);
    }
}
