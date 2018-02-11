<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Payment;

class Card extends Model
{
    //

    public function payments(){
        return $this->belongsToMany(Payment::class, 'payment_card', 'payment_id', 'card_id');
    }
}
