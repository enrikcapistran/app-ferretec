<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoDeCompraTable extends Migration
{
    public function up()
    {
        Schema::create('carritoDeCompra', function (Blueprint $table) {
            $table->integer('idCarrito')->primary()->unsigned();
            $table->integer('idUsuario')->unsigned();
            $table->integer('idSucursal')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamps();


            // Definir las llaves foráneas
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            $table->foreign('idStatus')->references('idStatus')->on('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carritoDeCompra');
    }
}
