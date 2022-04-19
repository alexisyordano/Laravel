  
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("id_user");
            $table->integer("id_solicitud");
            $table->integer("id_bono");
            $table->integer("cicle");
            $table->integer('dias');
            $table->date("date_mov");
            $table->date("date_sistema");
            $table->date("date_close");
            $table->date("date_pay");
            $table->integer("monto");
            $table->integer("p_intereses");
            $table->integer("m_intereses");
            $table->integer("saldo");
            $table->integer("id_line");
            $table->integer("solicitud");
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
        Schema::dropIfExists('transactions');
    }
}
