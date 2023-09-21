<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class GroupsResponse
 */
class GroupsResponse extends Base
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
     * @var string
     */
    public $description;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
