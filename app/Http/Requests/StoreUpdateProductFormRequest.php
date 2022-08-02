<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'quantity' => [
                'required',
                'integer',
            ],

            'description' =>[
                'required',
                'string',
                'max:40',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'price' => [
                'required',
                'numeric',
            ],

            'sale_price' => [
                'required',
                'numeric',
            ],
            
            'photo' => [
                'nullable',
                'file',
                'mimes:jpeg,jpg,png,svg'
            ]
        ];

        if ($this->method() == 'PUT') {
            
        }

        return $rules;
    }
}