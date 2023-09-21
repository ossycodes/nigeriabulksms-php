<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class ReportsResponse
 */
class ReportsResponse extends Base
{
    /**
     * @var string
     */
    public $service;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $sender;

    /**
     * @var string
     */
    public $message;

    /**
     * @var int
     */
    public $mobile;

    /**
     * @var string
     */
    public $data;

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

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
