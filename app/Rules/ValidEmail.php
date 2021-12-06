<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param $argument
     */
    public $argument;
    public function __construct($argument)
    {
       $this->argument = $argument;
    }


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
            'emails' => $this->argument
        ];

        $rules = [
            'emails.*' => ['required','email' ]
        ];

        $validator = Validator::make($argument, $rules);

        if ($validator->fails() === true) {
//            dd($validator->errors()->all());
            foreach ($validator->errors()->all() as $error) {
               echo  $error;
            }
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
       // return 'The validation error message.';
    }
}
