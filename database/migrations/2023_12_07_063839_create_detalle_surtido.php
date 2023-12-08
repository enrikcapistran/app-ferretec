<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSurtidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleSurtido', function (Blueprint $table) {
            $table->id('idSurtidoDetalle');
            $table->unsignedBigInteger('idSurtido');
            $table->unsignedBigInteger('idRefaccion');
            $table->unsignedInteger('cantidad');
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(now());
            $table->timestamp('actualizadoEn')->default(now())->onUpdate(now());
            $table->foreign('idSurtido')->references('idSurtido')->on('pedidoSurtido');
            $table->foreign('idRefaccion')->references('idProducto')->on('refacciones');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            $table->index(['idSurtido', 'idRefaccion']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleSurtido');
    }
}
