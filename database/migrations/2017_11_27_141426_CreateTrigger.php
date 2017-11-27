<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::unprepared("CREATE TRIGGER `trg_insert_pay` AFTER UPDATE ON registros
        FOR EACH ROW
          BEGIN

               INSERT INTO pgto_cliente (registro, dt_pgto, nr_valor, created_at, updated_at) VALUES  (NEW.id, NOW(), NEW.vl_preco, NOW(), NOW() );
          END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared( "DROP TRIGGER `trg_insert_pay`" );
    }
}
