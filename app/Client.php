<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Buyer;
class Client extends Model
{
    //

    public function buyer(){
        return $this->hasMany(Buyer::class, 'client_id');
    }
}
