<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractReferenceType;
use Eremin\SerEnDe\Types\AbstractType;

abstract class AbstractReferenceHandler implements TypeHandlerInterface
{
    abstract public function getTypeChar(): string;

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $raw = $string->readUntil(';');

        $type = $this->createType($referenceMap);
        $type->rawContent = $raw;
        $type->setReferencedType($referenceMap->getByIndex($raw));

        return $type;
    }

    abstract protected function createType(?ReferenceMap $referenceMap): AbstractReferenceType;
}
