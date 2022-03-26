<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_users', function (Blueprint $table) {
            $table->id('id_datos');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->string('nacionalidad');
            $table->string('pais');
            $table->string('nombre_referido');
            $table->date('f_primer_pago');
            $table->integer('monto');
            $table->string('identificador')->unique();  
            $table->integer('id_user')->unique();
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
        Schema::dropIfExists('_datos_users');
    }
}
