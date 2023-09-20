<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class Profile
 */
class Profile extends Base
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
