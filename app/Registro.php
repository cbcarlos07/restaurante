<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    //
    public function clientes(){
        return $this->belongsTo( 'App\Cliente', 'cliente', 'id' );
    }

    public function itens(){
        return $this->belongsTo( 'App\Item', 'item', 'id' );
    }
}
