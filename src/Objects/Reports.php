<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class Reports
 */
class Reports extends Base
{
    /**
     * @var string
     */
    public $amount;

    /**
     * @var null|string
     */
    public $reference;

    /**
     * @var string
     */
    public $date;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
