<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $audios = $client->audios->getList();
    var_dump($audios);

    //iterate through each audios item
    foreach($client->audios->getList()->getItems() as $audios) {
        dump($audios->id);
        dump($audios->name);
        dump($audios->reference);
        dump($audios->duration);
        dump($audios->description);
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
