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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('idUsuario')->unsigned()->autoIncrement();
            $table->string('correoElectronico', 60)->unique();
            $table->string('contraseña', 255);
            $table->string('apellidoPaterno', 15);
            $table->string('apellidoMaterno', 15);
            $table->string('nombre', 30);
            $table->date('fechaDeNacimiento');
            $table->tinyInteger('idRol')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('creadoEn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizadoEn')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('idRol')->references('idRol')->on('roles');
            $table->foreign('idStatus')->references('idStatus')->on('status');
            // Add other necessary foreign key constraints
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
