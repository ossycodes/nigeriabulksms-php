<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\ContactsResponse;
use Ossycodes\Nigeriabulksms\Objects\Contacts as ContactsObject;

/**
 * Class Contacts
 */
class Contacts extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->object = new ContactsObject();

        $this->setActionName('contacts');

        $this->setResponseObject(new ContactsResponse());

        parent::__construct($httpClient);
    }
}
