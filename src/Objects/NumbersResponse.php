<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class NumbersResponse
 */
class NumbersResponse extends Base
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $count;

    /**
     * @var string
     */
    public $description;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
