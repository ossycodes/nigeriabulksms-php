# The official PHP library for Nigeriabulksms API



This repository contains the open source PHP client for Nigeriabulksms's API. Documentation can be found at: https://nigeriabulksms.com/sms-gateway-api-in-nigeria/

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ossycodes/nigeriabulksms-php.svg?style=flat-square)](https://packagist.org/packages/ossycodes/nigeriabulksms-php)
[![Total Downloads](https://img.shields.io/packagist/dt/ossycodes/nigeriabulksms-php.svg?style=flat-square)](https://packagist.org/packages/ossycodes/nigeriabulksms-php)
![GitHub Actions](https://github.com/ossycodes/nigeriabulksms-php/actions/workflows/main.yml/badge.svg)

## Requirements

- [Sign up](http://portal.nigeriabulksms.com/register/?referral=15292322) for a free Nigeriabulksms account
- after signing up, your username and password will be used for authenticating with the APIs
- Nigeriabulksms API client for PHP requires PHP >= 7.4.

## Installation

#### Composer installation

- [Download composer](https://getcomposer.org/doc/00-intro.md#installation-nix)
- Run `composer require ossycodes/nigeriabulksms-php`.

#### Manual installation

When you do not use Composer. You can git checkout or download [this repository](https://github.com/ossycodes/nigeriabulksms-php/archive/master.zip) and include the Nigeriabulksms API client manually.


## Usage

We have put some self-explanatory examples in the [src/Examples](https://github.com/ossycodes/nigeriabulksms-php/tree/master/src/Examples) directory, but here is a quick breakdown on how it works. First, you need to set up a **Nigeriabulksms\Client**. Be sure to replace **YOUR_USERNAME** and **YOUR_PASSWORD** with your real credentials.

```php
require 'autoload.php';

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

```

That's easy enough. Now we can query the server for information. Lets use getting your balance overview as an example:

```php
try {

    // Get your balance
    $balance = $client->balance->read();

    var_dump($balance);
    
} catch (\Ossycodes\Nigeriabulksms\Exceptions\AuthenticateException $e) {

    // That means that your username and/or password is incorrect
    echo 'invalid credentials';

}
catch (\Ossycodes\Nigeriabulksms\Exceptions\BalanceException $e) {

    // That means that your balance is insufficient
    echo 'insufficient balance';

}
catch (\Exception $e) {
 
 var_dump($e->getMessage());

}
```


Sending Text SMS Message

```php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
    ->setUsername('YOUR_USERNAME')
    ->setPassword('YOUR_PASSWORD')
    ->setTimeout(10) //optional defaults to 10
    ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {

    $message = new \Ossycodes\Nigeriabulksms\Objects\TextMessage();
    $message->sender = 'YOUR_SENDER_NAME';
    $message->recipients = '2342222222222';
    $message->body =  'body of text message goes in here'; //should be less than 160 characters
    
    //send the text sms message
    $response = $client->message->send($message);
    
    var_dump($response);

} catch (\Ossycodes\Nigeriabulksms\Exceptions\AuthenticateException $e) {

    // That means that your username and/or password is incorrect
    echo 'invalid credentials';

} catch (\Ossycodes\Nigeriabulksms\Exceptions\BalanceException $e) {

    // That means that your balance is insufficient
    echo 'insufficient balance';

} catch (\Ossycodes\Nigeriabulksms\Exceptions\RequestDeniedException $e) {

    // That means that you do not have permission to perform this action
    echo 'this action is not permitted';

} catch (\Exception $e) {

    var_dump($e->getMessage());

}

```

## Documentation

Complete documentation, instructions, and examples are available at:
[https://nigeriabulksms.com/sms-gateway-api-in-nigeria//](https://nigeriabulksms.com/sms-gateway-api-in-nigeria/)

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email osaigbovoemmanuel1@gmail.com instead of using the issue tracker.

## Credits

-   [Osaigbovo Emmanuel](https://github.com/ossycodes)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## How do I say Thank you?

Please buy me a cup of coffee https://www.paypal.com/paypalme/osaigbovoemmanuel , Leave a star and follow me on [Twitter](https://twitter.com/ossycodes) .
