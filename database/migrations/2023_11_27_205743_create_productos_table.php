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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('imagen');
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('kit_id')->nullable(); // Foreign key
            $table->timestamps();

            $table->foreign('kit_id')->references('id')->on('kits')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
