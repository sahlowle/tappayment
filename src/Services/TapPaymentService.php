<?php

namespace Sahlowle\TapPayment\Services;

use Illuminate\Support\Facades\Http;


class TapPaymentService
{

    /*
    |--------------------------------------------------------------------------
    | Make Request
    |--------------------------------------------------------------------------
    */
    public static function makeRequest()
	{

        $base_url = config('tap_payment.base_url','https://api.tap.company/v2');

        $bearerToken = config('tap_payment.token');

		$request = Http::baseUrl($base_url)->asJson()->withToken($bearerToken);

		return $request;
	}
    /*
    |--------------------------------------------------------------------------
    | Create Charge Payment
    |--------------------------------------------------------------------------
    */

    public static function charge($data)
    {
        $body = self::getBody($data);

        $url = "https://api.tap.company/v2/charges";

        $bearerTest = "sk_test_fBjUei2mQFrRDkVgxGbESyPv";
        $bearerLive = "sk_live_ykx4XiBSslwI5UCu0TZM3QgA";
        
        $response = Http::withToken($bearerTest)->post($url,$body);

        return $response->object();
 
    }
    
    /*
    |--------------------------------------------------------------------------
    | get Settings
    |--------------------------------------------------------------------------
    */
    public static function getBody($data)
    {
        $body = [];

        $body = 
        [
            "amount" => $data['amount'], 
            "currency" =>  config('tap_payment.currency'), 
            "threeDSecure" => true, 
            "save_card" => false, 
            "description" => $data['description'],
            "statement_descriptor" =>  $data['description'], 
            "metadata" => [
                "udf1" => "test 1", 
                "udf2" => "test 2" 
            ], 
            "reference" => [
            "transaction" => "txn_0001", 
            "order" => "ord_0001"],
            "receipt" => [
            "email" => false, 
            "sms" => true 
            ], 
            "customer" => [
            "first_name" => $data['first_name'], 
            "middle_name" => "", 
            "last_name" => $data['last_name'], 
            "email" =>  $data['email'], 
            "phone" => [
                "country_code" => $data['country_code'], 
                "number" =>  $data['phone_number']
                ] 
            ], 
            "merchant" => [
                "id" => "" 
            ], 
            "source" => [
                "id" => "src_card" 
            ],
            "post" => [
                 "url" => config('tap_payment.redirect_url')
                ],
                "redirect" => [
                    "url" =>  config('tap_payment.redirect_url')
                    ] 
        ];

        return $body;
    }

}
