<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePgtoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pgto_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'registro' )->unsigned();
            $table->date( 'dt_pgto' );
            $table->decimal( 'nr_valor' );
            $table->foreign( 'registro' )->references('id')->on('registros');
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
        Schema::drop('pgto_cliente');
    }
}
