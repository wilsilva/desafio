<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Payment;

class Card extends Model
{
    //

    protected $hidden = ['card_number', 'cvv', 'pivot'];
    protected $appends = ['credit_card_masked', 'cvv_masked' ];

    public function payment(){
        return $this->belongsToMany(Payment::class, 'payment_card', 'payment_id', 'card_id');
    }

    public function getCreditCardMaskedAttribute()
    {
        return '000.0000.000-00';
    }

    public function getCvvMaskedAttribute(){
        return 'xxx';
    }
}
