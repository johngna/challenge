<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DespesaRequest extends FormRequest
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
            
            'data' => 'required',
            'valor' => 'required',
            'descricao' => [
                'required', 
                Rule::unique('despesas')
                ->where(function ($query){
                    return $query->whereMonth('data', date( 'm', strtotime($this->data)));
                })
                      
               ]
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Em que dia você quer lançar essa despesa?',
            'valor.required' => 'Qual o valor?',
            'descrição.required' => 'Você precisa descrever a que esta despesa se refere.',
            'descrição.unique' => 'Você já lançou uma despesa nesse mês com  exatamente essa mesma descrição!',
        ];
    }
}
