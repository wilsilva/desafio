<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Client;

class Buyer extends Model
{
    //
    protected $hidden = ['cpf'];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
