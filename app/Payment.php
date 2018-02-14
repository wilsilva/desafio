<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use DesafioTecnicoMoip\Boleto;
use DesafioTecnicoMoip\Buyer;
use DesafioTecnicoMoip\Card;

class Payment extends Model
{
    const CARD = 'card';
    const BOLETO = 'BOLETO';

    protected $appends = ['status_payment'];

    public function boleto(){
        return $this->hasMany(Boleto::class, 'payment_id');
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function card(){
        return $this->belongsToMany(Card::class, 'payment_card', 'payment_id', 'card_id');
    }

    public function getStatusPaymentAttribute()
    {
        if($this->type == self::CARD){
            return 'Pagamento realizado com sucesso!'; 
        }else if ($this->type == self::BOLETO){
            return 'Aguardando pagamento do boleto.';
        }
    }
}
