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
        Schema::create('kit_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kit_id');
            $table->unsignedBigInteger('producto_id');
            $table->timestamps();

            $table->foreign('kit_id')->references('id')->on('kits')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kit_producto');
    }
};
