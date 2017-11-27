<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'cliente' )->unsigned()->index();
            $table->integer( 'item' )->unsigned()->index();
            $table->decimal( 'vl_preco',10,2 );
            $table->char( 'sn_pago',1 );
            $table->integer( 'qt_compra' )->unsigned();
            $table->foreign( 'cliente' )->references( 'id' )->on('clientes') ;
            $table->foreign( 'item' )->references( 'id' )->on('item') ;
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
        Schema::drop('registros');
    }
}
