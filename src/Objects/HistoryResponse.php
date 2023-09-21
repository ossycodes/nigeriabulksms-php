<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class HistoryResponse
 */
class HistoryResponse extends Base
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $price;

    /**
     * @var int
     */
    public $units;

    /**
     * @var string
     */
    public $length;

    /**
     * @var string
     */
    public $send_date;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $class;

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
