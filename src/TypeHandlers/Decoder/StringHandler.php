<?php

namespace Eremin\SerEnDe\TypeHandlers\Decoder;

use Eremin\SerEnDe\ReferenceMap;
use Eremin\SerEnDe\SerializedString;
use Eremin\SerEnDe\Types\AbstractType;
use Eremin\SerEnDe\Types\StringType;

class StringHandler implements TypeHandlerInterface
{

    public function getTypeChar(): string
    {
        return StringType::TYPE_LETTER;
    }

    public function parseType(SerializedString $string, ?ReferenceMap $referenceMap): AbstractType
    {
        $string->assertNextOne(':');
        $length = (int)$string->readUntil(':');
        $string->assertNextOne('"');
        $raw = $string->readByLength($length);
        $string->assertNextOne('"');
        $string->assertNextOne(';');

        $type = StringType::createReferenced($referenceMap);
        $type->rawContent = $raw;

        return $type;
    }
}
