<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;


/**
 * Class Balance
 */
class Balance extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        // $this->object = new Objects\Balance();
        $this->setActionName('balance');

        parent::__construct($httpClient);
    }
}
