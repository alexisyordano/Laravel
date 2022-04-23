<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreregistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregistros', function (Blueprint $table) {
            $table->id('id_registro');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('pais');
            $table->string('nacionalidad');
            $table->date('fecha_nacimiento');
            $table->string('modalidad');
            $table->string('nombre_r');
            $table->date('fecha_primer_pago');
            $table->string('monto');
            $table->string('n_banco');
            $table->string('t_cuenta');
            $table->string('anombre');
            $table->string('ncuenta');
            $table->string('identificador')->unique();
            $table->integer('creado');
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
        Schema::dropIfExists('preregistros');
    }
}
