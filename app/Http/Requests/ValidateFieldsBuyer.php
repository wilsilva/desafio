<?php

namespace DesafioTecnicoMoip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFieldsBuyer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:buyers',
            'cpf' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Favor preencher o campo :attribute.',
            'email.unique'  => 'Este e-mail já se encontra cadastrado em nossa base de dados.'
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
