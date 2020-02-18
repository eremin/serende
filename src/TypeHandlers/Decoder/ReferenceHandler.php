<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\ReferenceType;

class ReferenceHandler implements TypeHandlerInterface
{
    public function getTypeChar(): string
    {
        return ReferenceType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $raw = $string->readUntil(';');

        $type = ReferenceType::createReferenced($referenceMap);
        $type->rawContent = $raw;
        $type->setReferencedType($referenceMap->getByIndex($raw));

        return $type;
    }
}
