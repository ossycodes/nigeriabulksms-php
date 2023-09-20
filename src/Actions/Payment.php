<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\PaymentResponse;
use Ossycodes\Nigeriabulksms\Objects\Payment as PaymentObject;

/**
 * Class Payment
 */
class Payment extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new PaymentObject();

        $this->setActionName('payments');

        $this->setResponseObject(new PaymentResponse());

        parent::__construct($httpClient);
    }
}
