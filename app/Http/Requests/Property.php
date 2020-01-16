<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Property extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'O título é obrigatório',
            'description.required' => 'A descrição é obrigatória',
            'price.required' => 'O preço é obrigatório',
            'address.required' => 'O endereço é obrigatório',
            'neighborhood.required' => 'O bairro é obrigatório',
            'city.required' => 'A cidade é obrigatória',
            'state.required' => 'O estado é obrigatório',
            'postcode.required' => 'O CEP é obrigatório',
        ];
    }
}
