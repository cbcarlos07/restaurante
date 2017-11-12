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
        Schema::create('pgto_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registro')->unsigned();
            $table->date('dt_pgto');
            $table->decimal('nr_valor',10,2);
            $table->foreign('registro')->references('id')->on('registros');
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
        Schema::drop('pgto_clientes');
    }
}
