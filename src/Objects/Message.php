<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use Ossycodes\Nigeriabulksms\Exceptions\MessageLimitException;

/**
 * Class Message
 */
class Message extends Base
{
    public const BODY_LIMIT = 160;

    /**
     * @var string
     */
    public $sender;

    /**
     * @var string
     */
    public $body;

    /**
     * @var string|array
     */
    public $recipients;

    /**
     * @var string
     */
    public $type;

    /**
     * @return string
     */
    public function getBody()
    {
        if(!$this->isTextMessage()) {
            return $this->body;
        }

        $body = htmlspecialchars(preg_replace('/\s+/', ' ', strip_tags($this->body)));

        if(strlen($body) > self::BODY_LIMIT) {
            throw new MessageLimitException('body of message must be less than 160 characters');
        }

        return $body;
    }

    /**
     * @return string
     */
    public function getRecipients()
    {
        if(\is_array($this->recipients)) {
            return implode(',', $this->recipients);
        }

        return $this->recipients;
    }

    /**
     * @return null|string
     */
    public function getSender()
    {
        return $this->sender ?? null;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * check if message is of type `text`
     *
     * @return bool
     */
    private function isTextMessage()
    {
        return $this->type === 'text';
    }
}
