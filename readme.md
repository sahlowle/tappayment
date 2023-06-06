<p align="center"><img src="https://www.idloom.com/application/files/3016/7585/3832/TapLogo_Gray_H.png" alt="Laravel Tap Payment"></p>

# Laravel Tap Payment

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devinweb/laravel-paytabs.svg?style=flat-square)](https://packagist.org/packages/devinweb/laravel-paytabs)
[![Total Downloads](https://img.shields.io/packagist/dt/devinweb/laravel-paytabs.svg?style=flat-square)](https://packagist.org/packages/devinweb/laravel-paytabs)
<a href="https://github.styleci.io/repos/534237521"><img src="https://github.styleci.io/repos/534237521/shield?branch=master" alt="StyleCI Shield"></a>
[![codecov](https://codecov.io/gh/devinweb/laravel-paytabs/branch/master/graph/badge.svg?token=11LZHKWQL4)](https://codecov.io/gh/devinweb/laravel-paytabs)
![GitHub Actions](https://github.com/devinweb/laravel-paytabs/actions/workflows/main.yml/badge.svg)


Laravel Tap Payment makes integration with payment gateway easier for Laravel developers, and that's by offering a wide range of functions to consume the tap transactions API.

## Requirements
This package requires php 7.4 or higher.

## Installation

You can install the package via composer:

```bash
composer require sahlowle/tappayment
```

# Setup and configuration
You can also publish the config file using
```bash
php artisan vendor:publish --tag="tap_payment.config"
```
After that, you can see the file in app/paytabs.php and update it. You might need to change the model variable to use your custom User model.

## Tap Keys

Before being able to use this package, you should configure your tap environment in your application's congig\tap_payment.php file.
```
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tap Payment Config
    
    */

    'base_url' => 'https://api.tap.company/v2/',

    'token' => 'your-key',

    'currency' => 'SAR',

    'redirect_url' => 'http://localhost:8000/redirect_url',
    
];
```

## Usage

### Create Charge Transaction 

first create charge transaction

```php
use Sahlowle\TapPayment\Tap;

    $body = [
        'amount'=> 200,
        'description'=> 'iphone 14 pro max',
        'first_name'=> 'Ahmed',
        'last_name'=> 'Ali',
        'email'=> 'ahmed@gmail.com',
        'country_code'=> 966,
        'phone_number'=> 0555551122,
    ];

    $response = Tap::charge($body);

    return redirect($response->transaction->url);

```
### get payment details
here you can get details of payment transaction and check payment status

```php
use Sahlowle\TapPayment\Tap;

$tap_id = request()->tap_id;

$response = Tap::getCharge($tap_id);
    
if ($response->status == "CAPTURED"){
      return "successful payment";
}

```



response will be like this
```json
{
"id": "chg_TS06A5720231845i8D90606533",
"object": "charge",
"live_mode": false,
"customer_initiated": true,
"api_version": "V2",
"method": "GET",
"status": "CAPTURED",
"amount": 200,
"currency": "SAR",
"threeDSecure": true,
"card_threeDSecure": false,
"save_card": false,
"merchant_id": "",
"product": "GOSELL",
"statement_descriptor": "iphone 14 pro max",
"description": "iphone 14 pro max",
"metadata": {
"udf1": "test 1",
"udf2": "test 2"
},
"order": {
"id": "ord_Ddhv57231545uhb761r5Q40"
},
"transaction": {
"authorization_id": "098807",
"timezone": "UTC+03:00",
"created": "1686077202117",
"expiry": {
"period": 30,
"type": "MINUTE"
},
"asynchronous": false,
"amount": 200,
"currency": "SAR"
},
"reference": {
"track": "tck_TS05A5720231845Ka680606548",
"payment": "5706231845065483602",
"gateway": "123456789012345",
"acquirer": "315715098807",
"transaction": "txn_0001",
"order": "ord_0001"
},
"response": {
"code": "000",
"message": "Captured"
},
"security": {
"threeDSecure": {
"id": "3ds_TS02A4220231846Zl460606117",
"status": "Y"
}
},
"acquirer": {
"response": {
"code": "00",
"message": "Approved"
}
},
"gateway": {
"response": {
"code": "0",
"message": "Transaction Approved"
}
},
"card": {
"object": "card",
"first_six": "411111",
"scheme": "VISA",
"brand": "VISA",
"last_four": "1111"
},
"receipt": {
"id": "205806231845068295",
"email": false,
"sms": true
},
"customer": {
"id": "cus_TS05A4320231846Rh4u0606555",
"first_name": "Ahmed",
"last_name": "Ali",
"email": "ahmed@gmail.com",
"phone": {
"country_code": "966",
"number": "95867474"
}
},
"merchant": {
"country": "AE",
"currency": "AED",
"id": "18829646"
},
"source": {
"object": "token",
"type": "CARD_NOT_PRESENT",
"payment_type": "CREDIT",
"payment_method": "VISA",
"channel": "INTERNET",
"id": "tok_OocX342315464haQ6N75d607"
},
"redirect": {
"status": "SUCCESS",
"url": "http://localhost:8000/redirect_url"
},
"post": {
"status": "SUCCESS",
"url": "http://localhost:8000/redirect_url"
},
"activities": [
{
"id": "activity_TS06A4320231846Xj810606587",
"object": "activity",
"created": 1686077202117,
"status": "INITIATED",
"currency": "SAR",
"amount": 200,
"remarks": "charge - created"
},
{
"id": "activity_TS06A5520231846p2J10606181",
"object": "activity",
"created": 1686077215181,
"status": "CAPTURED",
"currency": "SAR",
"amount": 200,
"remarks": "charge - captured"
}
],
"auto_reversed": false
}
```

### Test Cards 
use card number and any future date

```php
Card Num : 4111 1111 1111 1111

Date : any future date

CVV : any cvv
```


## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email sahlowle@gmail.com instead of using the issue tracker.

## Credits

- [Suhail Osman][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sahlowle/tappayment.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sahlowle/tappayment.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/sahlowle/tappayment/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/sahlowle/tappayment
[link-downloads]: https://packagist.org/packages/sahlowle/tappayment
[link-travis]: https://travis-ci.org/sahlowle/tappayment
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/sahlowle
[link-contributors]: ../../contributors
