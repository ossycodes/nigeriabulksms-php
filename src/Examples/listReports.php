<?php

require_once(__DIR__ . '/../autoload.php');

$config = \Ossycodes\Nigeriabulksms\Configuration::getDefaultConfiguration()
            ->setUsername('YOUR_USERNAME')
            ->setPassword('YOUR_PASSWORD')
            ->setTimeout(10) //optional defaults to 10
            ->setConnectionTimeout(2); //optional defaults to 2

$client = new \Ossycodes\Nigeriabulksms\Client($config);

try {
    $reports = $client->reports->getList();
    var_dump($reports);

    //iterate through each report item
    foreach($client->reports->getList()->getItems() as $report) {
        dump($report->service);
        dump($report->reference);
        dump($report->status);
        dump($report->sender);
        dump($report->status);
        dump($report->message);
        dump($report->mobile);
        dump($report->data);
        dump($report->price);
        dump($report->units);
        dump($report->length);
        dump($report->send_date);
        dump($report->date);
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
