<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('detallesPedidosSurtidos', function (Blueprint $table) {
            $table->integer('idSurtido')->unsigned();
            $table->integer('idRefaccion')->unsigned();
            $table->integer('cantidad');
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(now());
            $table->timestamp('actualizadoEn')->default(now())->onUpdate(now());
            $table->foreign('idSurtido')->references('idSurtido')->on('pedidoSurtido');
            $table->foreign('idRefaccion')->references('idProducto')->on('refacciones');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->index(['idSurtido', 'idRefaccion']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('detallesPedidosSurtidos');
    }
};
