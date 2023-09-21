<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\NumbersResponse;
use Ossycodes\Nigeriabulksms\Objects\Numbers as NumbersObject;

/**
 * Class Numbers
 */
class Numbers extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new NumbersObject();

        $this->setActionName('numbers');

        $this->setResponseObject(new NumbersResponse());

        parent::__construct($httpClient);
    }
}
