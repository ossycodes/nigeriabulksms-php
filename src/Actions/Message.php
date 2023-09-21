<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\MessageResponse;
use Ossycodes\Nigeriabulksms\Objects\Message as MessageObject;

/**
 * Class Message
 */
class Message extends Base
{
    public function __construct(HttpClient $httpClient)
    {
        $this->setActionName('message');

        $this->setResponseObject(new MessageResponse());

        parent::__construct($httpClient);
    }

    public function send(MessageObject $message)
    {
        [, , $body] = $this->httpClient->performHttpRequest(
            $this->actionName,
            array_filter([
                'sender'        => $message->getSender(),
                'message'       => $message->getBody(),
                'mobiles'       => $message->getRecipients(),
            ]),
        );

        return $this->processRequest($body);
    }
}
