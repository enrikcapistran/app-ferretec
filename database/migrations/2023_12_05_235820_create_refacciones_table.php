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
        Schema::create('refacciones', function (Blueprint $table) {
            $table->integer('idProducto')->unsigned();
            $table->string('SKU', 20)->unique();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizadoEn')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->primary('idProducto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refacciones');
    }
};
