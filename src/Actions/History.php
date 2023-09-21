<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\HistoryResponse;
use Ossycodes\Nigeriabulksms\Objects\History as HistoryObject;

/**
 * Class History
 */
class History extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new HistoryObject();

        $this->setActionName('history');

        $this->setResponseObject(new HistoryResponse());

        parent::__construct($httpClient);
    }
}
