<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\BoolType;

class BoolHandler implements TypeHandlerInterface
{
    public function getTypeChar(): string
    {
        return BoolType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $raw = $string->readOne(); // bool value always one byte
        $string->assertNextOne(';');

        $type = BoolType::createReferenced($referenceMap);
        $type->rawContent = $raw;

        return $type;
    }
}
