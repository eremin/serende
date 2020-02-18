<?php

namespace Eremin\SerEnDe;

use Eremin\SerEnDe\Types\AbstractType;

class ReferenceMap
{
    private $map = [];

    public function addType(AbstractType $type)
    {
        $this->map[] = $type;
    }

    public function getByIndex(int $index): AbstractType
    {
        if (isset($this->map[$index - 1])) {
            return $this->map[$index - 1];
        }
        throw new \RuntimeException("no map with index $index was found");
    }

    public function getIndexOfType(AbstractType $type): ?int
    {
        foreach ($this->map as $key => $value) {
            if ($value === $type) {
                return $key + 1;
            }
        }

        return null;
    }
}
