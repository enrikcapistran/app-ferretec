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
        Schema::create('kitsPendientes', function (Blueprint $table) {
            $table->integer('idSucursal')->unsigned();
            $table->integer('idKit')->unsigned();
            $table->smallInteger('existenciaFaltante')->unsigned();
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');
            $table->foreign('idKit')->references('idProducto')->on('kits');
            $table->index(['idSucursal', 'idKit']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kits_pendientes');
    }
};
