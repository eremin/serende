<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\FloatType;

class FloatHandler implements TypeHandlerInterface
{
    public function getTypeChar(): string
    {
        return FloatType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $raw = $string->readUntil(';');

        $type = FloatType::createReferenced($referenceMap);
        $type->rawContent = $raw;

        return $type;
    }
}
