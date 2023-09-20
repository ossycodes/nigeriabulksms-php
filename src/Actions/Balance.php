<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Objects\Balance as BalanceObject;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\BalanceResponse;

/**
 * Class Balance
 */
class Balance extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new BalanceObject();

        $this->setActionName('balance');

        $this->setResponseObject(new BalanceResponse());

        parent::__construct($httpClient);
    }
}
