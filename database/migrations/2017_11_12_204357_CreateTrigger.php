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
        DB::unprepared(
            "CREATE TRIGGER `trg_insert_pay` AFTER UPDATE ON registros
                    FOR EACH ROW
                      BEGIN

                           INSERT INTO pgto_clientes VALUES (NULL, NEW.id, NOW(), NEW.vl_preco );
                      END"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
