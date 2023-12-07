<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('idUsuario')->unsigned()->autoIncrement();
            $table->string('email', 60)->unique();
            $table->string('password', 255);
            $table->string('apellidoPaterno', 15);
            $table->string('apellidoMaterno', 15);
            $table->string('nombre', 30);
            $table->date('fechaNacimiento');
            $table->tinyInteger('idRol')->unsigned();
            $table->tinyInteger('idStatus')->unsigned()->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('creadoEn')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizadoEn')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('idRol')->references('idRol')->on('roles');
            $table->foreign('idStatus')->references('idStatus')->on('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
