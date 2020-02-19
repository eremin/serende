<?php

namespace Eremin\SerEnDe\Types;

abstract class AbstractReferenceType extends AbstractType
{
    /**
     * @var AbstractType
     */
    private $referencedType;

    public function getReferencedType(): AbstractType
    {
        return $this->referencedType;
    }

    public function setReferencedType(AbstractType $referencedType): self
    {
        $this->referencedType = $referencedType;

        return $this;
    }
}
