<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDeCompra extends Model
{
    // Define the table associated with the model
    protected $table = 'carritoDeCompra';

    // Set the primary key
    protected $primaryKey = 'idCarrito';

    // Custom timestamp column names
    const CREATED_AT = 'creadoEn';
    const UPDATED_AT = 'actualizadoEn';

    // Attributes that are mass assignable
    protected $fillable = [
        'idUsuario',
        'idStatus'
    ];

    // Relationship with Usuario model
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    // Relationship with Status model
    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class, 'idCarrito');
    }

    public function agregar(Producto $producto)
    {
        // Aquí puedes agregar la lógica para agregar el producto al carrito
        // Por ejemplo, puedes usar la sesión para almacenar los productos en el carrito

        $carrito = session()->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        if (isset($carrito[$producto->id])) {
            // Incrementar la cantidad si ya está en el carrito
            $carrito[$producto->id]['cantidad']++;
        } else {
            // Agregar el producto al carrito
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('carrito', $carrito);

        // Puedes redirigir a la página del producto o a la página del carrito, según tus necesidades
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }
}
