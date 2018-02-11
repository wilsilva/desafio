<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Boleto;
use DesafioTecnicoMoip\Buyer;
use DesafioTecnicoMoip\Card;

class Payment extends Model
{
    //


    public function boletos(){
        return $this->hasMany(Boleto::class, 'payment_id');
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function cards(){
        return $this->belongsToMany(Card::class, 'payment_card', 'card_id', 'payment_id');
    }
}
