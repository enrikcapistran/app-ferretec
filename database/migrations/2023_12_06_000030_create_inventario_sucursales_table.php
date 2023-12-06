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
        Schema::create('inventarioSucursales', function (Blueprint $table) {
            $table->integer('idSucursal')->unsigned();
            $table->integer('idProducto')->unsigned();
            $table->integer('existencia')->unsigned();
            $table->integer('stockMaximo')->unsigned();
            $table->integer('stockMinimo')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->index(['idSucursal', 'idProducto']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario_sucursales');
    }
};
