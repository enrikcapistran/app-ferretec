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
        Schema::create('pedidoSurtido', function (Blueprint $table) {
            $table->integer('idSurtido')->unsigned()->autoIncrement();
            $table->integer('idAlmacen')->unsigned();
            $table->integer('idSucursal')->unsigned();
            $table->timestamp('fechaDePedido')->default(now());
            $table->timestamp('fechaDeRecibido')->default(now());
            $table->tinyInteger('idStatus')->unsigned()->default(1);

            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->foreign('idAlmacen')->references('idAlmacen')->on('almacen');
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidoSurtido');
    }
};
