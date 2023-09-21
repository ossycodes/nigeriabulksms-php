<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class MessageResponse
 */
class MessageResponse extends Base
{
    /**
     * @var string
     */
    public $status;

    /**
     * @var int
     */
    public $count;

    /**
     * @var int
     */
    public $price;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
