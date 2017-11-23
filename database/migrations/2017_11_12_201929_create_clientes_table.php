<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_cliente');
            $table->string('nr_cracha')->nullable();
            $table->integer('empresa')->unsigned();
            $table->string('nr_cep',8);
            $table->string('nr_casa');
            $table->string('ds_complemento');
            $table->date('dt_cadastro');
            $table->string('email')->unique();
            $table->string('senha');
            $table->char('sn_senha_atual',1);
            $table->foreign('empresa')->references('id')->on('empresas');
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
        Schema::drop('clientes');
    }
}
