<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $audio = new \Ossycodes\Nigeriabulksms\Objects\Audios();
    $audio->url =  'https://your_audio_less_than_2mb.mp3';
    $response = $client->audios->upload($audio);

    var_dump($response);

} catch (\Ossycodes\Nigeriabulksms\Exceptions\AuthenticateException $e) {
    // That means that your username and/or password is incorrect
    echo 'invalid credentials';
}
catch (\Ossycodes\Nigeriabulksms\Exceptions\BalanceException $e) {
    // That means that your balance is insufficient
    echo 'insufficient balance';
}
catch (\Ossycodes\Nigeriabulksms\Exceptions\RequestDeniedException $e) {
    // That means that you do not have permission to perform this action
    echo 'this action is not permitted';
}
catch (\Exception $e) {
    var_dump($e->getMessage());
}
