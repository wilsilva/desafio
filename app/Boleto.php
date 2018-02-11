<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Payment;

class Boleto extends Model
{
    //

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
