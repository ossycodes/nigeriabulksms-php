<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\PaymentsResponse;
use Ossycodes\Nigeriabulksms\Objects\Payments as PaymentsObject;

/**
 * Class Payments
 */
class Payments extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new PaymentsObject();

        $this->setActionName('payments');

        $this->setResponseObject(new PaymentsResponse());

        parent::__construct($httpClient);
    }
}
