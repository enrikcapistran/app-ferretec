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
        Schema::create('productos', function (Blueprint $table) {
            $table->integer('idProducto')->unsigned()->autoIncrement();
            $table->string('nombreProducto', 100);
            $table->text('descripcion')->nullable();
            $table->text('imagen')->nullable();
            $table->decimal('precioUnitario', 10, 2);
            $table->tinyInteger('idTipoProducto')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizadoEn')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('idTipoProducto')->references('idTipoProducto')->on('tipoProducto');
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
        Schema::dropIfExists('productos2');
    }
};
