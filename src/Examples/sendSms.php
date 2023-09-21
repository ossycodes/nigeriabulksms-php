<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
    ->setUsername('YOUR_USERNAME')
    ->setPassword('YOUR_PASSWORD')
    ->setTimeout(10) //optional defaults to 10
    ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $message = new \Ossycodes\Nigeriabulksms\Objects\TextMessage();
    $message->sender = 'YOUR_SENDER_NAME'; //check the dashboard to see your sender name [here](https://portal.nigeriabulksms.com/bulksms/)
    $message->recipients = '2342222222222';
    $message->body =  'body of text message goes in here'; //should be less than 160 characters
    $response = $client->message->send($message);
    var_dump($response);
    $response->status;
    $response->count;
    $response->price;
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
