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
        Schema::create('inventarioAlmacen', function (Blueprint $table) {
            $table->integer('idAlmacen')->unsigned();
            $table->integer('idRefaccion')->unsigned();
            $table->integer('existencia')->unsigned();
            $table->index(['idAlmacen', 'idRefaccion']);
            $table->foreign('idAlmacen')->references('idAlmacen')->on('almacen');
            $table->foreign('idRefaccion')->references('idProducto')->on('refacciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario_almacen');
    }
};
