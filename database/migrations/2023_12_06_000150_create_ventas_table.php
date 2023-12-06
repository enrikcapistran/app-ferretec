<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->integer('folio')->unsigned()->autoIncrement();
            $table->integer('idSucursal')->unsigned();
            $table->integer('idEmpleado')->unsigned();
            $table->integer('idCliente')->unsigned();
            $table->tinyInteger('idPago')->unsigned();
            $table->timestamp('fechaVenta')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('totalPago', 10, 2)->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamps();
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursales');
            $table->foreign('idEmpleado')->references('idUsuario')->on('usuarios');
            $table->foreign('idCliente')->references('idUsuario')->on('usuarios');
            $table->foreign('idPago')->references('idPago')->on('pago');
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
        Schema::dropIfExists('ventas');
    }
};
