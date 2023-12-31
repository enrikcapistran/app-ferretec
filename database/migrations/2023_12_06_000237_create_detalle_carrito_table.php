<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleCarrito', function (Blueprint $table) {
            $table->id('idDetalleCarrito');
            $table->integer('idCarrito')->unsigned();
            $table->integer('idProducto')->unsigned();
            $table->tinyInteger('cantidad')->unsigned();
            $table->foreign('idCarrito')->references('idCarrito')->on('carritoDeCompra')->onDelete('cascade');
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->index(['idCarrito', 'idProducto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleCarrito');
    }
};
