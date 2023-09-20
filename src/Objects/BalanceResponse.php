<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class BalanceResponse
 */
class BalanceResponse extends Base
{
    /**
     * @var string
     */
    public $balance;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $symbol;

    /**
     * @var string
     */
    public $country;

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
