<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('cod_user');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('fecha_registro');
            $table->date('fecha_cambio_clave');
            $table->date('fecha_ultimo_ingreso');
            $table->integer('estado_usuario');
            $table->string('codigo_sesion');
            $table->integer('cod_tipo_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
