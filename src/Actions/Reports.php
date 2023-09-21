<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\ReportsResponse;
use Ossycodes\Nigeriabulksms\Objects\Reports as ReportsObject;

/**
 * Class Reports
 */
class Reports extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new ReportsObject();

        $this->setActionName('reports');

        $this->setResponseObject(new ReportsResponse());

        parent::__construct($httpClient);
    }
}
