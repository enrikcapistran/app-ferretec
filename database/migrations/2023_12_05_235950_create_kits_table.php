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
        Schema::create('kits', function (Blueprint $table) {
            $table->integer('idProducto')->unsigned();
            $table->integer('idSucursal')->unsigned();
            $table->integer('idUsuarioCreador')->unsigned();
            $table->integer('idUsuarioAutorizador')->unsigned()->nullable()->default(null);
            $table->tinyInteger('idStatus')->unsigned()->default(11);
            $table->timestamps();
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');
            $table->foreign('idUsuarioCreador')->references('idUsuario')->on('usuarios');
            $table->foreign('idUsuarioAutorizador')->references('idUsuario')->on('usuarios');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->primary('idProducto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kits');
    }
};
