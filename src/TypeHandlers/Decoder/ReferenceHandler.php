<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\Types\AbstractReferenceType;
use Eremin\SerEnDe\Types\ReferenceType;

class ReferenceHandler extends AbstractReferenceHandler
{
    public function getTypeChar(): string
    {
        return ReferenceType::TYPE_LETTER;
    }

    public function createType(?ReferenceMap $referenceMap): AbstractReferenceType
    {
        return new ReferenceType();
    }
}
