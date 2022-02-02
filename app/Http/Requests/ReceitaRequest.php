<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReceitaRequest extends FormRequest
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
                Rule::unique('receitas')
                ->where(function ($query){
                    return $query->whereMonth('data', date( 'm', strtotime($this->data)));
                })
                      
               ]
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Em que dia você quer lançar essa receita?',
            'valor.required' => 'Qual o valor?',
            'descrição.required' => 'Você precisa descrever a que esta receita se refere.',
            'descrição.unique' => 'Você já lançou uma receita nesse mês com  exatamente essa mesma descrição!',
        ];
    }
}

