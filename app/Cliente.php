<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //

    public function empresas(){
        return $this->belongsTo('App\Empresa','empresa', 'id');
    }
}
