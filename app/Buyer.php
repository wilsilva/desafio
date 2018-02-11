<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Client;

class Buyer extends Model
{
    //

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
