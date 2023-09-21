<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $groups = $client->groups->getList();
    var_dump($groups);

    //iterate through each groups item
    foreach($client->groups->getList()->getItems() as $group) {
        echo($group->id);
        echo($group->name);
        echo($group->description);
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
