<?php

namespace Worawitj\Validation;

class ThaiIdCard
{
    public function validate($value,$request)
    {

        if(!$request){
            $id_card_type = 1;
        }
        if(!empty($request['id_card_type'])){
            $id_card_type = $request['id_card_type'];  // Retrieve status
        } else {
            $id_card_type = 1;
        }

        $valid = true;
        if ($id_card_type == '1') {
            $value .= '';
            if (strlen($value) !== 13) {
                $valid = false;
            } else {
                for ($sum = 0, $i = 0; $i < 12; $i++) {
                    $sum += (int)($value[$i]) * (13 - $i);
                }
                $validate = (11 - ($sum % 11)) % 10 === (((int)substr($value, 12, 1)));
                if(!$validate){
                    $valid = false;
                }
            }
        } elseif ($id_card_type == '2') {
            // Do Nothing.
        } else {
            $valid = false;
        }

        return $valid;


    }
}
