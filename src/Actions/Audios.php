<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\AudiosResponse;
use Ossycodes\Nigeriabulksms\Objects\Audios as AudiosObject;

/**
 * Class Audios
 */
class Audios extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new AudiosObject();

        $this->setActionName('audios');

        $this->setResponseObject(new AudiosResponse());

        parent::__construct($httpClient);
    }
}
