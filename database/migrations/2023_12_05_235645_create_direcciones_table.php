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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->integer('idDireccion')->unsigned()->autoIncrement();
            $table->integer('idUsuario')->unsigned();
            $table->string('calle', 30);
            $table->string('colonia', 30);
            $table->integer('numero')->unsigned();
            $table->integer('CP')->unsigned();
            $table->string('referencia', 50);
            $table->string('telefono', 10);
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizadoEn')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('direcciones');
    }
};
