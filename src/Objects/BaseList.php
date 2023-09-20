<?php

namespace Ossycodes\Nigeriabulksms\Objects;

/**
 * Class BaseList
 */
class BaseList extends Base
{
    public $items = [];

    public function getItems(): array
    {
        return $this->items;
    }
}
