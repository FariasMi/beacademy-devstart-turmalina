<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUpdateUserFormRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => "required|string|max:255",
            'cpf' => "required|unique:users,cpf,{$this->id},id",
            'phone' => "required|phone_br_ddd|unique:users,phone,{$this->id},id",
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$this->id},id"],

        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'confirmed', Rules\Password::defaults()];
            $rules['cpf'] = ["nullable"];
        }

        return $rules;
    }
}