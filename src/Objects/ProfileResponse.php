<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class ProfileResponse
 */
class ProfileResponse extends Base
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $mobile;

    /**
     * @var string
     */
    public $sender;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
