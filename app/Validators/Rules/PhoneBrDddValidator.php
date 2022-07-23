<?php

namespace App\Validators\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * @author Wallace Maxters <wallacemaxters@gmail.com>
 */
class PhoneBrDddValidator implements Rule {
    /**
     * Valida o formato do celular junto com o ddd
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value) {
        return preg_match("/^\(?\d{2}\)?\s?\d{5}\-?\d{4}$/", $value) > 0;
    }

    public function message() {
        return 'Telefone inválido.';
    }
}
