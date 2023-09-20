<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\ProfileResponse;
use Ossycodes\Nigeriabulksms\Objects\Profile as ProfileObject;

/**
 * Class Profile
 */
class Profile extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new ProfileObject();

        $this->setActionName('profile');

        $this->setResponseObject(new ProfileResponse());

        parent::__construct($httpClient);
    }
}
