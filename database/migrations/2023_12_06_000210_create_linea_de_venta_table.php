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
        Schema::create('lineaDeVenta', function (Blueprint $table) {
            $table->integer('idLineaDeVenta')->unsigned()->autoIncrement();
            $table->integer('idVenta')->unsigned();
            $table->integer('idProducto')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->decimal('precioUnitario', 10, 2);
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamps();
            $table->foreign('idVenta')->references('folio')->on('ventas');
            $table->foreign('idProducto')->references('idProducto')->on('productos');
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
        Schema::dropIfExists('linea_de_venta');
    }
};
