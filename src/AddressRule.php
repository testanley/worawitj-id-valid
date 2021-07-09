<?php

namespace Worawitj\Validation;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class AddressRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */

    public function __construct(string $message = null,Request $request,string $validate_type = null)
    {
        $this->message = $message;
        $this->request = $request;
        $this->validate_type = $validate_type;
    }

    public function passes($attribute, $value)
    {
        $response =  (new AddressValidate)->validate($value,$this->request,$this->validate_type);
//        dd($response);
        if(!$response['success']){
            if($response['result_code'] == "01"){
                $this->message = $response['msg'];
            } else if($response['result_code'] == "99"){
//                $this->message = $response['msg'];

            }
        }
        return $response['success'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return $this->message?:"Please Check Your Data";
    }
}
