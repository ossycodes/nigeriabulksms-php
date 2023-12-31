<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $history = $client->history->getList();
    var_dump($history);

    //iterate through each history item
    foreach($client->history->getList()->getItems() as $history) {
        echo($history->message);
        echo($history->sender);
        echo($history->price);
        echo($history->unit);
        echo($history->length);
        echo($history->class);
        echo($history->send_date);
        echo($history->date);
    }

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
