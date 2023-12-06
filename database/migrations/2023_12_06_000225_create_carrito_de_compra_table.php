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
        Schema::create('carritoDeCompra', function (Blueprint $table) {
            $table->integer('idCarrito')->unsigned()->autoIncrement();
            $table->integer('idUsuario')->unsigned()->unique();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamps();
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            $table->foreign('idStatus')->references('idStatus')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_de_compra');
    }
};
