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
        Schema::create('almacen', function (Blueprint $table) {
            $table->integer('idAlmacen')->unsigned()->autoIncrement();
            $table->string('nombreAlmacen', 50);
            $table->string('calle', 50);
            $table->string('colonia', 50);
            $table->integer('numero')->unsigned();
            $table->integer('CP')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('almacen');
    }
};
