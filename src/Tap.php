<?php

namespace Sahlowle\TapPayment;

use Sahlowle\TapPayment\Services\TapPaymentService;

class Tap
{
    
    /*
    |--------------------------------------------------------------------------
    | Create Charge Payment
    |--------------------------------------------------------------------------
    */
    public static function charge($data)
    {
        $body = TapPaymentService::getBody($data);
        
        $request = TapPaymentService::makeRequest();

        $response =  $request->post('/v2/charges',$body);

        return $response->object();
    }

    /*
    |--------------------------------------------------------------------------
    | Verify Payment
    |--------------------------------------------------------------------------
    */
    public static function getCharge($charge_id)
    {
        $request = TapPaymentService::makeRequest();

        $url = "/v2/charges/".$charge_id;

        $response =  $request->get($url);
        
        return $response->object();
    }
}