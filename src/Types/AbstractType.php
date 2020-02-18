<?php


namespace Eremin\SerEnDe\Types;


use Eremin\SerEnDe\ReferenceMap;

abstract class AbstractType
{
    public $rawContent;

    /**
     * @param ReferenceMap|null $referenceMap
     * @return static
     */
    public static function createReferenced(?ReferenceMap $referenceMap): self
    {
        $type = new static();
        if (null !== $referenceMap) {
            $referenceMap->addType($type);
        }

        return $type;
    }

    protected function setValueHelper($value)
    {
        $serialized = \serialize($value);

        $this->rawContent = \substr($serialized, 2, -1);

        return $this;
    }
}
