<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\GroupsResponse;
use Ossycodes\Nigeriabulksms\Objects\Groups as GroupsObject;

/**
 * Class Groups
 */
class Groups extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new GroupsObject();

        $this->setActionName('groups');

        $this->setResponseObject(new GroupsResponse());

        parent::__construct($httpClient);
    }
}
