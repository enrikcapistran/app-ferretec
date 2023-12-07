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
        Schema::create('detalleKits', function (Blueprint $table) {
            $table->integer('idKit')->unsigned();
            $table->integer('idRefaccion')->unsigned();
            $table->smallInteger('cantidad')->unsigned();
            $table->foreign('idKit')->references('idProducto')->on('kits');
            $table->foreign('idRefaccion')->references('idProducto')->on('refacciones');
            $table->index(['idKit', 'idRefaccion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_kits');
    }
};
