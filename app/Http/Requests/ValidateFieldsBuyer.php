<?php

namespace DesafioTecnicoMoip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFieldsBuyer extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'client_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:buyers|email',
            'cpf' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Favor preencher o campo :attribute.',
            'email.unique'  => 'Este e-mail já se encontra cadastrado em nossa base de dados.',
            'email.email' => 'Favor informar um email válido.'
        ];
    }

    public function attributes(){
        return [
            'name' => 'Nome',
            'email' => 'E-mail',
            'cpf' => 'CPF'
        ];
    }
}
