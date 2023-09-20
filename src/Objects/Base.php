<?php

namespace Ossycodes\Nigeriabulksms\Objects;

use stdClass;

/**
 * Class Base
 */
class Base
{
    /**
     * @param stdClass $object
     * @return self
     */
    public function loadFromStdclass(stdClass $object)
    {
        foreach ($object as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $this;
    }
}
