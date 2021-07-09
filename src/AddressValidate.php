<?php

namespace Worawitj\Validation;

class AddressValidate
{
    public function validate($value,$request,$validate_type)
    {

        $res = $this->validate_pvn_amp_dst($request);
//        dd($res);
        if(!$res['success']){
            return $res;
        }

        $raw_data = "";
        $valid = true;
        $err_msg = "validate pass";
        $result_code = "00";
        switch ($validate_type){
            case 'TH' :
//                $pattern = "/^[ก-๙\s]+$/";
                $pattern = "/(*UTF8)^[ก-๙]+$/";
                break;
            case 'EN' :
                $pattern = "/(*UTF8)^[a-zA-Z\s]+$/";
                break;
            case 'DIGIT' :
                $pattern = "/^([0-9]+)$/";
                break;
            case 'DIGIT_SYMBOL' :
                $pattern = "/^([0-9-\/ ]+)$/";
                break;
        }
//lad($value,preg_match_all($pattern, $value,$matches));

        if(preg_match_all($pattern, $value,$matches) === 0){
            $valid = false;
            $err_msg = "validate fail";
            $result_code = "99";
        }

        return ['success'=>$valid,'result_code'=>$result_code,'msg'=>$err_msg];

    }

    private function validate_pvn_amp_dst($request = null){

        if(empty($request)){
            return ['success'=>false,'result_code'=>'01','msg'=>'request data is missing'];
        }

        $validate = true;
        $error_msg = "validate Pvn Amp Dst Pass";

        if(empty($request['customer_address_province_name_th']) && empty($request['customer_address_province_name_en'])){
            $validate = false;
            $error_msg .= "Please Check Your Customer Addres Province Name";
        }

        if(empty($request['customer_address_amphur_th']) && empty($request['customer_address_amphur_en'])){
            $validate = false;
            if(!empty($error_msg)){
                $error_msg .= ",";
            }
            $error_msg .= "Please Check Your Customer Addres Amphur Name";
        }

        if(empty($request['customer_address_tumbon_th']) && empty($request['customer_address_tumbon_en'])){
            $validate = false;
            if(!empty($error_msg)){
                $error_msg .= ",";
            }
            $error_msg .= "Please Check Your Customer Addres Tumbon Name";
        }

        if($request['send_policy_same_address_flag'] == "N"){
            if(empty($request['send_policy_address_province_name_th']) && empty($request['send_policy_address_province_name_en'])){
                $validate = false;
                if(!empty($error_msg)){
                    $error_msg .= ",";
                }
                $error_msg .= "Please Check Your Send Policy Addres Province Name";
            }

            if(empty($request['send_policy_address_amphur_th']) && empty($request['send_policy_address_amphur_en'])){
                $validate = false;
                if(!empty($error_msg)){
                    $error_msg .= ",";
                }
                $error_msg .= "Please Check Your Send Policy Addres Amphur Name";
            }

            if(empty($request['send_policy_address_tumbon_th']) && empty($request['send_policy_address_tumbon_en'])){
                $validate = false;
                if(!empty($error_msg)){
                    $error_msg .= ",";
                }
                $error_msg .= "Please Check Your Send Policy Addres Tumbon Name";
            }
        }


        return ['success'=>$validate,'result_code'=>'01','msg'=>$error_msg];

    }
}
