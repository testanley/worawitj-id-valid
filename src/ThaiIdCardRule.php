<?php

namespace Worawitj\Validation;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class ThaiIdCardRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    public function __construct(string $message = null,Request $request)
    {
        $this->message = $message;
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        return (new ThaiIdCard)->validate($value,$this->request);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return $this->message?:"Please Check Your IdCard";
    }
}
