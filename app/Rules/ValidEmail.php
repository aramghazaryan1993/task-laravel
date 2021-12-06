<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class ValidEmail
 * @package App\Rules
 */
class ValidEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $argument = [
            'emails' => $value
        ];

        $rules = [
            'emails.*' => ['required','email']
        ];

        $validator = Validator::make($argument, $rules);

        if ($validator->fails()) {
            return 0;
        }else{
            return 1;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Error Email';
    }
}
