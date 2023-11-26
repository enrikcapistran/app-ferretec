<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

    public function refaccions(){
        return $this->BelongsToMany(Refaccion::class, 'kit_refaccion');
    }
}
