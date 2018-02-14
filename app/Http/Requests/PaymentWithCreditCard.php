<?php

namespace DesafioTecnicoMoip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentWithCreditCard extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'buyer_id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
            'card.holder_name' => 'required',
            'card.card_number' => 'required',
            'card.expiration_date' => 'required',
            'card.cvv' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Favor preencher o campo :attribute.',
        ];
    }

    public function attributes(){
        return [
            'type' => 'Tipo de Pagamento',
            'amount' => 'Preço',
            'card.holder_name' => 'Nome no Cartão de Crédito',
            'card.card_number' => 'Número do Cartão de Crédito',
            'card.expiration_date' => 'Data de Vencimento',
            'card.cvv' => 'Código Verificador',
       ];
    }
}
