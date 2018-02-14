<?php

namespace DesafioTecnicoMoip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentWithBoleto extends FormRequest
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
       ];
    }
}
