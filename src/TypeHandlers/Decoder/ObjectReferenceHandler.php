<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\Types\AbstractReferenceType;
use Eremin\SerEnDe\Types\ObjectReferenceType;

class ObjectReferenceHandler extends AbstractReferenceHandler
{
    public function getTypeChar(): string
    {
        return ObjectReferenceType::TYPE_LETTER;
    }

    public function createType(?ReferenceMap $referenceMap): AbstractReferenceType
    {
        return new ObjectReferenceType();
    }
}
