<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class Audios
 */
class Audios extends Base
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
    public $reference;

    /**
     * @var string
     */
    public $duration;

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
